<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import BadgeCategory from "@/Components/BadgeCategory.vue";
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
</script>

<template>
    <Head title="Kelas" />

    <AuthenticatedLayout>
        <div class="container py-12">
            <!-- Hero -->
            <div class="grid grid-cols-2 gap-8 items-center">
                <div class="col">
                    <h1 class="text-4xl font-bold text-neutral-100 mb-2">
                        Ayo Kapten! <br />Saatnya meluncurkan kapalmu ⛵️
                    </h1>
                    <p class="text-[1.3125rem] text-neutral-80 mb-6">
                        Siapkan layar dan ikuti arus pengetahuan pemrograman.
                        Bersama kita akan menjelajahi dunia teknologi dengan
                        cara yan interaktif. Pilih rute yang kamu inginkan, dan
                        ayo berlayar menuju petualangan baru!
                    </p>
                    <div class="flex gap-2 items-center">
                        <TextInput
                            type="text"
                            name="search"
                            id="search"
                            class="w-2/3"
                            placeholder="Telusuri kelas, teknologi, "
                            v-model="search"
                        />
                        <button
                            @click="handleSearch"
                            class="bg-primary text-white text-xl border-b-4 border-primary-hover px-6 py-3 rounded-xl"
                        >
                            Cari
                        </button>
                    </div>
                </div>
                <div class="col">
                    <img
                        src="../../../images/banner.png"
                        class="w-full h-[25rem] object-cover hidden lg:block"
                        alt=""
                    />
                </div>
            </div>
        </div>

        <!-- Search Based on Category -->
        <div class="bg-primary-surface py-12">
            <div class="container">
                <h1 class="text-[1.75rem] font-bold mb-3">
                    Cari berdasarkan Kategori
                </h1>
                <BadgeCategory
                    :icons="FrontendIcon"
                    backgroundColor="#FF7A00"
                    category="Frontend"
                    fontSize="text-lg"
                    imageSize="size-5"
                    paddingY="py-[0.38rem]"
                />
            </div>
        </div>

        <!-- List Course -->
        <div class="container py-12">
            <h1 class="text-[2.3125rem] text-neutral-100 font-bold mb-3">
                Baru Rilis
            </h1>
            <div class="grid grid-cols-4 gap-6">
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
        </div>

        <!-- Popular Course -->
        <div class="container py-12">
            <h1 class="text-[2.3125rem] text-neutral-100 font-bold mb-3">
                Kelas paling populer
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
        <div class="container pt-12">
            <div class="mb-6 max-w-[32.5rem] mx-auto">
                <h1 class="text-[2.3125rem] text-neutral-100 font-bold">
                    Lorem Ipsum dolor sit Amet!
                </h1>
                <p class="text-[1.3125rem] text-neutral-70">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Ut enim ad minim veniam,
                </p>
            </div>
            <img
                :src="DataIcon"
                class="w-3/4 mx-auto object-cover h-52"
                alt=""
            />
        </div>
    </AuthenticatedLayout>
</template>
