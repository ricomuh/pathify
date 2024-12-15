<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import ContentBottom from "@/Components/ContentBottom.vue";
import BoxCourse from "@/Components/BoxCourse.vue";
import {
    Carousel,
    CarouselContent,
    CarouselItem,
    CarouselNext,
    CarouselPrevious,
} from "@/Components/ui/carousel";
import Autoplay from "embla-carousel-autoplay";

// carousel
const plugin = Autoplay({
    delay: 2000,
    stopOnMouseEnter: true,
    stopOnInteraction: false,
});

const banner = [
    "/media/illustrations/banner-course.png",
    "/media/illustrations/banner-course2.png",
    "/media/illustrations/banner-course3.png",
];

import { ref, watch } from "vue";

// get data
const props = defineProps({
    latestCourses: Array,
    popularCourses: Array,
    categories: Array,
    courses: Array,
});

// search function
const form = useForm({
    query: new URLSearchParams(window.location.search).get("query") || "",
});

const selectedCategories = ref([]);

const handleSearch = () => {
    const query = form.query;
    const categories = selectedCategories.value.join(",");

    // Construct URL with query parameters
    const params = new URLSearchParams();
    if (query) params.append("query", query);
    if (categories) params.append("categories", categories);

    const url = `${window.location.pathname}?${params.toString()}`;

    // Update the URL without reloading the page
    window.history.pushState({}, "", url);

    form.get(
        route("courses.search", {
            query,
            categories,
        }),
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        }
    );

    console.log("Selected categories:", selectedCategories.value);
};

const toggleCategory = (name) => {
    if (selectedCategories.value.includes(name)) {
        selectedCategories.value = selectedCategories.value.filter(
            (catName) => catName !== name
        );
    } else {
        selectedCategories.value.push(name);
    }
    handleSearch();
};

const isSelected = (name) => selectedCategories.value.includes(name);

let searchTimeout = null;

watch(
    () => form.query,
    () => {
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }
        searchTimeout = setTimeout(() => {
            handleSearch();
        }, 1000);
    }
);
</script>

<template>
    <Head title="Kelas" />

    <AuthenticatedLayout>
        <!-- Hero -->
        <div class="container pb-12 pt-24">
            <Carousel
                class="relative w-full"
                :plugins="[plugin]"
                @mouseenter="plugin.stop"
                @mouseleave="
                    [plugin.reset(), plugin.play(), console.log('Running')]
                "
            >
                <CarouselContent>
                    <CarouselItem v-for="(value, index) in banner" :key="index">
                        <div class="p-1">
                            <img :src="value" class="w-full mx-auto" alt="" />
                        </div>
                    </CarouselItem>
                </CarouselContent>
                <CarouselPrevious />
                <CarouselNext />
            </Carousel>
        </div>
        <!-- Search Based on Category -->
        <div class="container">
            <div class="flex justify-between items-center mb-6 flex-wrap">
                <h1 class="text-2xl-plus font-bold text-neutral-100">
                    Filter berdasarkan Kategori
                </h1>
                <p class="text-xl-plus text-neutral-80">
                    {{ props.latestCourses.length }} Kelas ditemukan
                </p>
            </div>
            <div
                class="flex gap-3 flex-wrap w-full overflow-x-auto items-center"
            >
                <div
                    v-for="category in props.categories"
                    :key="category.id"
                    class="form-group flex-shrink-0"
                >
                    <input
                        type="checkbox"
                        :name="category.name"
                        :id="`category${category.id}`"
                        class="hidden"
                        :checked="isSelected(category.name)"
                        @change="toggleCategory(category.name)"
                    />
                    <label
                        :for="`category${category.id}`"
                        :class="[
                            'py-2 px-4 text-nowrap cursor-pointer text-lg rounded-2xl border-[1.4px] flex gap-2 items-center tracking-[0.00406rem]',
                            isSelected(category.name)
                                ? `text-white`
                                : 'bg-neutral-10 text-neutral-60 border-neutral-50',
                        ]"
                        :style="
                            isSelected(category.name)
                                ? {
                                      backgroundColor: category.color,
                                      borderColor: category.color,
                                  }
                                : null
                        "
                    >
                        <i
                            :class="[
                                category.icon_image,
                                isSelected(category.name)
                                    ? 'text-white'
                                    : 'text-neutral-60',
                            ]"
                            class="text-lg"
                        ></i>
                        {{ category.name }}
                    </label>
                </div>
            </div>
        </div>

        <!-- List Course -->
        <div class="container pt-6 pb-12">
            <div class="flex flex-wrap gap-2 justify-between items-center mb-6">
                <h1 class="text-4xl-plus text-neutral-100 font-bold">
                    Semua Kelas
                </h1>
                <div
                    class="flex gap-1 items-center py-3 px-4 rounded-xl border-2 border-neutral-40 bg-neutral-10 w-96"
                >
                    <img src="/media/icons/search.svg" alt="" />
                    <input
                        type="search"
                        v-model="form.query"
                        class="outline-none !h-max py-0 px-0 border-0 bg-neutral-10 shadow-none !ring-0 w-full"
                        placeholder="Mau belajar apa hari ini?"
                    />
                </div>
            </div>
            <div
                class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3"
            >
                <BoxCourse
                    v-for="(course, index) in props?.latestCourses"
                    :key="index"
                    :iconBadge="course.categories[0].icon_image"
                    :backgroundBadge="course.categories[0].color"
                    :categoryClass="course.categories[0].name"
                    :title="course.title"
                    :teacher="course.mentor.fullname"
                    :teachersJob="course.mentor.mentor_detail.profession"
                    :avatar="course.mentor.profile_picture"
                    :level="course.level"
                    :slug="course.slug"
                    :thumbnail="course.thumbnail"
                />
            </div>
        </div>

        <!-- Popular Course -->
        <div class="container pb-12">
            <h1 class="text-4xl-plus text-neutral-100 font-bold mb-6">
                Kelas paling populer
            </h1>
            <div
                class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3"
            >
                <BoxCourse
                    v-for="(course, index) in props.popularCourses"
                    :key="index"
                    :iconBadge="course.categories[0].icon_image"
                    :backgroundBadge="course.categories[0].color"
                    :categoryClass="course.categories[0].name"
                    :title="course.title"
                    :teacher="course.mentor.fullname"
                    :teachersJob="course.mentor.mentor_detail?.profession"
                    :avatar="course.mentor.profile_picture"
                    :level="course.level"
                    :slug="course.slug"
                    :thumbnail="course.thumbnail"
                />
            </div>
        </div>

        <!-- Content -->
        <div class="container">
            <ContentBottom />
        </div>
    </AuthenticatedLayout>
</template>
