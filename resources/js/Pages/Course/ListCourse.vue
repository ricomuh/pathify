<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import FrontendIcon from "../../../images/icons/fe.svg";
import CyberIcon from "../../../images/icons/cyber.svg";
import MobileIcon from "../../../images/icons/mobile.svg";
import DesignIcon from "../../../images/icons/ui.svg";
import DevOpsIcon from "../../../images/icons/devops.svg";
import GameIcon from "../../../images/icons/game.svg";
import DataIcon from "../../../images/banner.png";
import BoxCourse from "@/Components/BoxCourse.vue";
import { router } from "@inertiajs/vue3";

import { ref } from "vue";

const props = defineProps({
    latestCourses: Array,
    popularCourses: Array,
    categories: Array,
});
// search function
const search = ref("");
const handleSearch = () => {
    if (search.value.trim() !== "") {
        router.get("/courses/search", { query: search.value });
    }
};

// dummy data
const courses = [
    {
        iconBadge: FrontendIcon,
        backgroundBadge: "#FF7A00",
        categoryClass: "Frontend",
        title: 'Pengantar Dunia Komputer : “Hello World!"',
        teacher: "Flora Shafiqa Riyadi, M.Kom",
        teachersJob: "Mobile Apps Developer",
        avatar: DataIcon,
        level: 2,
        slug: "pengantar-dunia-komputer-hello-world",
    },
    {
        iconBadge: CyberIcon,
        backgroundBadge: "#EA1C00",
        categoryClass: "Cyber Security",
        title: 'Pengantar Dunia Komputer : “Hello World!"',
        teacher: "Flora Shafiqa Riyadi, M.Kom",
        teachersJob: "Mobile Apps Developer",
        avatar: DataIcon,
        level: 1,
        slug: "pengantar-dunia-komputer-hello-world",
    },
    {
        iconBadge: MobileIcon,
        backgroundBadge: "#00CD52",
        categoryClass: "Mobile Development",
        title: "Pengantar Pemrograman Mobile Development",
        teacher: "Flora Shafiqa Riyadi, M.Kom",
        teachersJob: "Mobile Apps Developer",
        avatar: DataIcon,
        level: 3,
        slug: "pengantar-dunia-komputer-hello-world",
    },
    {
        iconBadge: DesignIcon,
        backgroundBadge: "#00987D",
        categoryClass: "UI/UX Design",
        title: 'Pengantar Dunia Komputer : “Hello World!"',
        teacher: "Flora Shafiqa Riyadi, M.Kom",
        teachersJob: "Mobile Apps Developer",
        avatar: DataIcon,
        level: 2,
        slug: "pengantar-dunia-komputer-hello-world",
    },
    {
        iconBadge: DevOpsIcon,
        backgroundBadge: "#53A700",
        categoryClass: "DevOps",
        title: 'Pengantar Dunia Komputer : “Hello World!"',
        teacher: "Flora Shafiqa Riyadi, M.Kom",
        teachersJob: "Mobile Apps Developer",
        avatar: DataIcon,
        level: 1,
        slug: "pengantar-dunia-komputer-hello-world",
    },
    {
        iconBadge: GameIcon,
        backgroundBadge: "#7705AD",
        categoryClass: "Game Development",
        title: 'Pengantar Dunia Komputer : “Hello World!"',
        teacher: "Flora Shafiqa Riyadi, M.Kom",
        teachersJob: "Mobile Apps Developer",
        avatar: DataIcon,
        level: 3,
        slug: "pengantar-dunia-komputer-hello-world",
    },
];

// categories
const categories = ref([
    {
        id: 1,
        name: "Web Development",
        icon: "media/icons/category.svg",
    },
    { id: 2, name: "UI / UX Design", icon: "media/icons/category.svg" },
    { id: 3, name: "Data Science", icon: "media/icons/category.svg" },
    { id: 4, name: "Mobile Development", icon: "media/icons/category.svg" },
    { id: 5, name: "Cyber Security", icon: "media/icons/category.svg" },
]);

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
        <div class="container py-12">
            <img
                src="media/illustrations/banner-course.png"
                class="mx-auto"
                alt=""
            />
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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-[2.3125rem] text-neutral-100 font-bold">
                    Semua Kelas
                </h1>
                <div
                    class="flex gap-1 items-center py-3 px-4 rounded-xl border-2 border-neutral-40 bg-neutral-10 w-96"
                >
                    <img src="media/icons/search.svg" alt="" />
                    <input
                        type="search"
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
            <div class="mb-6 max-w-[32.5rem] mx-auto">
                <h1
                    class="text-[2.3125rem] leading-[2.775rem] text-neutral-100 font-bold"
                >
                    Belajar tanpa batas ruang dan waktu
                </h1>
                <p class="text-xl text-neutral-70">
                    Nikmati pengalaman belajar tanpa batasan ruang dan waktu.
                    Nikmati keseruan luar biasa dari kami
                </p>
                <i data-lucide="x"></i>
            </div>
            <img
                :src="DataIcon"
                class="w-3/4 mx-auto object-cover h-52"
                alt=""
            />
        </div>
    </AuthenticatedLayout>
</template>
