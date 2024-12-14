<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
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
    "/media/illustrations/banner-course.png",
    "/media/illustrations/banner-course.png",
];

import { ref } from "vue";

// get data
const props = defineProps({
    latestCourses: Array,
    popularCourses: Array,
    categories: Array,
});

// search function
const search = ref("");

// categories
const selectedCategories = ref([]);

const toggleCategory = (id) => {
    if (selectedCategories.value.includes(id)) {
        selectedCategories.value = selectedCategories.value.filter(
            (catId) => catId !== id
        );
    } else {
        selectedCategories.value.push(id);
    }
};

const isSelected = (id) => selectedCategories.value.includes(id);
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
                <h1 class="text-[1.75rem] font-bold text-neutral-100">
                    Filter berdasarkan Kategori
                </h1>
                <p class="text-[1.3125rem] text-neutral-80">
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
                        :checked="isSelected(category.id)"
                        @change="toggleCategory(category.id)"
                    />
                    <label
                        :for="`category${category.id}`"
                        :class="[
                            'py-2 px-4 text-nowrap cursor-pointer text-lg rounded-2xl border-[1.4px] flex gap-2 items-center tracking-[0.00406rem]',
                            isSelected(category.id)
                                ? `text-white`
                                : 'bg-neutral-10 text-neutral-60 border-neutral-50',
                        ]"
                        :style="
                            isSelected(category.id)
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
                                isSelected(category.id)
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
                <h1 class="text-[2.3125rem] text-neutral-100 font-bold">
                    Semua Kelas
                </h1>
                <div
                    class="flex gap-1 items-center py-3 px-4 rounded-xl border-2 border-neutral-40 bg-neutral-10 w-96"
                >
                    <img src="/media/icons/search.svg" alt="" />
                    <input
                        type="search"
                        v-model="search"
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
            <h1 class="text-[2.3125rem] text-neutral-100 font-bold mb-6">
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
