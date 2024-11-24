<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head } from "@inertiajs/vue3";
import FrontendIcon from "../../../images/icons/fe.svg";
import CyberIcon from "../../../images/icons/cyber.svg";
import MobileIcon from "../../../images/icons/mobile.svg";
import DesignIcon from "../../../images/icons/ui.svg";
import DevOpsIcon from "../../../images/icons/devops.svg";
import GameIcon from "../../../images/icons/game.svg";
import DataIcon from "../../../images/banner.png";
import BoxCourse from "@/Components/BoxCourse.vue";

import { ref } from "vue";

const search = ref("");

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
    { id: 1, name: "Web Development" },
    { id: 2, name: "UI / UX Design" },
    { id: 3, name: "Data Science" },
    { id: 4, name: "Mobile Development" },
    { id: 5, name: "Cyber Security" },
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
        <div class="container">
            <!-- Search -->
            <div class="py-12">
                <div class="mb-8 flex gap-2 justify-center items-center">
                    <TextInput
                        type="text"
                        name="search"
                        id="search"
                        class="w-full max-w-[25.125rem]"
                        placeholder="Telusuri kelas, teknologi, "
                        v-model="search"
                    />
                    <button
                        class="bg-primary text-white text-xl border-b-4 border-primary-hover px-6 py-3 rounded-xl"
                    >
                        Cari
                    </button>
                </div>
                <div class="flex gap-4 flex-wrap items-center justify-center">
                    <div
                        v-for="category in categories"
                        :key="category.id"
                        class="form-group"
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
                                'py-2 px-4 cursor-pointer rounded-3xl border-2',
                                isSelected(category.id)
                                    ? 'bg-primary-surface text-primary border-primary-border'
                                    : 'bg-neutral-10 text-neutral-70 border-neutral-50',
                            ]"
                        >
                            {{ category.name }}
                        </label>
                    </div>
                </div>
            </div>
            <!-- List Course -->
            <div class="grid grid-cols-4 py-12 gap-6">
                <BoxCourse
                    v-for="(course, index) in courses"
                    :key="index"
                    :iconBadge="course.iconBadge"
                    :backgroundBadge="course.backgroundBadge"
                    :categoryClass="course.categoryClass"
                    :title="course.title"
                    :teacher="course.teacher"
                    :teachersJob="course.teachersJob"
                    :avatar="course.avatar"
                    :level="course.level"
                    :slug="course.slug"
                />
            </div>

            <!-- Recommendation Course -->
            <div class="py-12">
                <h1 class="text-[2.3125rem] text-neutral-100 font-bold mb-3">
                    Mungkin Anda tertarik
                </h1>
                <div class="grid grid-cols-4 gap-6">
                    <BoxCourse
                        v-for="(course, index) in courses.slice(0, 4)"
                        :key="index"
                        :iconBadge="course.iconBadge"
                        :backgroundBadge="course.backgroundBadge"
                        :categoryClass="course.categoryClass"
                        :title="course.title"
                        :teacher="course.teacher"
                        :teachersJob="course.teachersJob"
                        :avatar="course.avatar"
                        :level="course.level"
                        :slug="course.slug"
                    />
                </div>
            </div>

            <!-- Content -->
            <div class="pt-12">
                <div class="mb-6 max-w-[32.5rem] mx-auto">
                    <h1 class="text-[2.3125rem] text-neutral-100 font-bold">
                        Lorem Ipsum dolor sit Amet!
                    </h1>
                    <p class="text-[1.3125rem] text-neutral-70">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua. Ut enim ad minim veniam,
                    </p>
                </div>
                <img
                    :src="DataIcon"
                    class="w-3/4 mx-auto object-cover h-52"
                    alt=""
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
