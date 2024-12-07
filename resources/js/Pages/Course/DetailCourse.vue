<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BadgeCategory from "@/Components/BadgeCategory.vue";
import Accordion from "@/Components/Accordion.vue";
import { Head } from "@inertiajs/vue3";
import PlaceholderImage from "../../../images/banner.png";
import FrontendIcon from "../../../images/icons/fe.svg";
import CyberIcon from "../../../images/icons/cyber.svg";
import MobileIcon from "../../../images/icons/mobile.svg";
import DesignIcon from "../../../images/icons/ui.svg";
import { computed, ref } from "vue";
import BoxCourse from "@/Components/BoxCourse.vue";
import CarouselReveiw from "@/Components/CarouselReveiw.vue";

const dummyCourse = ref({
    title: "Kotlin untuk Pengembangan Android dan Lainnya",
    description:
        "Belajar Kotlin, bahasa resmi untuk pengembangan Android dan platform lainnya, dengan materi yang relevan dan praktis.",
    category: "Pengembangan Android",
    classDescription: `
        <p>Kotlin merupakan bahasa utama yang digunakan dalam pengembangan Android saat ini. Hal ini karena manfaat yang diberikan seperti ringkas, cepat, dan aman. Selain itu, sifatnya yang interoperability membuat developer bisa beralih dari bahasa Java ke Kotlin dengan cepat. Tak ayal, Google pernah melaporkan hampir 80% dari 1000 aplikasi teratas di Play Store menggunakan Kotlin. Selain pengembangan Android, Kotlin dapat digunakan untuk berbagai macam pengembangan, baik itu server, back-end, maupun website.</p>
        <ul>
            <li>Materi relevan dengan tools dan framework yang banyak dipakai sekarang.</li>
            <li>Dengan menggunakan Kotlin, pengembangan aplikasi akan jauh lebih cepat.</li>
            <li>Pengembangan aplikasi menggunakan Kotlin bisa berjalan bersamaan dengan Java dalam satu project.</li>
            <li>Kotlin menjadi bahasa resmi yang direkomendasikan dalam pengembangan Android.</li>
            <li>Kotlin juga dapat digunakan untuk pengembangan platform selain seperti server, back-end, dan website.</li>
        </ul>
        <p>Kotlin merupakan bahasa utama yang digunakan dalam pengembangan Android saat ini. Hal ini karena manfaat yang diberikan seperti ringkas, cepat, dan aman. Selain itu, sifatnya yang interoperability membuat developer bisa beralih dari bahasa Java ke Kotlin dengan cepat. Tak ayal, Google pernah melaporkan hampir 80% dari 1000 aplikasi teratas di Play Store menggunakan Kotlin. Selain pengembangan Android, Kotlin dapat digunakan untuk berbagai macam pengembangan, baik itu server, back-end, maupun website.</p>
    `,
    requirements: [
        "Laptop dengan minimum RAM 8GB dan processor minimum Intel Core i3 (Rekomendasi Core i5 keatas)",
        "Laptop atau PC dengan Android Studio terinstal",
        "Koneksi internet stabil",
    ],
    forWho: [
        "Pengembang Android pemula",
        "Pengembang yang ingin beralih dari Java ke Kotlin",
        "Mahasiswa atau profesional yang ingin memperdalam Kotlin",
    ],
    instructor: {
        name: "Prof. Azriel Pamungkas, Ph.D.",
        position: "Web Developer",
        photo: PlaceholderImage,
        description:
            "Prof. Azriel merupakan Web Developer yang berpengalaman selama 5+ tahun. Berfokus pada pengembangan teknologi frontend terlebih ReactJs. Beberapa pengalaman beliau adalah menjadi Frontend Developer di Perusahaanku.id selama 3 tahun, dan kemudian menjadi mentor di komunitas KomunitasQ selama 2 tahun.",
    },
    curriculum: [
        {
            id: 1,
            title: "Lecture 1 - Ini adalah judul materi 1",
            subs: [
                "Pengenalan Dart dan fundamental Flutter",
                "Pengenalan Dart dan fundamental Flutter",
                "Pengenalan Dart dan fundamental Flutter",
            ],
        },
        {
            id: 2,
            title: "Lecture 2 - Ini adalah judul materi 2",
            subs: [
                "Pengenalan Dart dan fundamental Flutter",
                "Pengenalan Dart dan fundamental Flutter",
                "Pengenalan Dart dan fundamental Flutter",
            ],
        },
        {
            id: 3,
            title: "Lecture 3 - Ini adalah judul materi 3",
            subs: [
                "Pengenalan Dart dan fundamental Flutter",
                "Pengenalan Dart dan fundamental Flutter",
                "Pengenalan Dart dan fundamental Flutter",
            ],
        },
    ],
    testimonials: [
        {
            name: "Andi Pratama",
            job: "Pelajar",
            feedback:
                "Materi yang diberikan sangat membantu. Saya bisa beralih dari Java ke Kotlin dengan mudah.",
            photo: PlaceholderImage,
        },
        {
            name: "Siti Aminah",
            job: "Pelajar",
            feedback:
                "Pengajarnya sangat jelas dalam menjelaskan konsep-konsep Kotlin. Sekarang saya lebih percaya diri mengembangkan aplikasi Android.",
            photo: PlaceholderImage,
        },
        {
            name: "Dimas Aditya",
            job: "Pelajar",
            feedback:
                "Kursus ini membuka wawasan saya tentang penggunaan Kotlin untuk pengembangan server. Sangat bermanfaat!",
            photo: PlaceholderImage,
        },
    ],
    recommendationCourse: [
        {
            iconBadge: FrontendIcon,
            backgroundBadge: "#FF7A00",
            categoryClass: "Frontend",
            title: 'Pengantar Dunia Komputer : “Hello World!"',
            teacher: "Flora Shafiqa Riyadi, M.Kom",
            teachersJob: "Mobile Apps Developer",
            avatar: PlaceholderImage,
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
            avatar: PlaceholderImage,
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
            avatar: PlaceholderImage,
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
            avatar: PlaceholderImage,
            level: 2,
            slug: "pengantar-dunia-komputer-hello-world",
        },
    ],
});

// bars
const bars = computed(() => {
    const levels = [
        { height: "h-3", color: "bg-white" },
        { height: "h-5", color: "bg-neutral-60" },
        { height: "h-7", color: "bg-neutral-60" },
    ];

    return levels.map((bar, index) => {
        if (index < props.course.level) {
            bar.color = "bg-white";
        }
        return bar;
    });
});

// get data
const props = defineProps({
    course: {
        type: Object,
        required: true,
    },
    hasAccess: {
        type: Boolean,
        required: true,
    },
    relatedCourses: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="Detail Kelas" />

    <AuthenticatedLayout>
        <!-- Hero -->
        <div
            class="bg-primary-pressed relative xl:h-screen flex justify-center flex-col py-16"
        >
            <img
                :src="props.course.thumbnail"
                class="absolute top-0 right-0 w-2/5 h-full object-cover hidden lg:block"
                alt=""
            />
            <!-- Konten dalam container -->
            <div class="container relative z-10">
                <div class="grid xl:grid-cols-2 gap-8 xl:gap-12 items-center">
                    <div class="col">
                        <BadgeCategory
                            :icons="props.course.categories[0].icon_image"
                            :backgroundColor="props.course.categories[0].color"
                            :category="props.course.categories[0].name"
                            fontSize="text-base"
                        />
                        <h1
                            class="text-[2.3125rem] leading-[2.775rem] font-bold text-neutral-10 my-3"
                        >
                            {{ props.course.title }}
                        </h1>
                        <p class="text-neutral-40 text-base mb-6">
                            {{ props.course.body }}
                        </p>
                        <!-- Mentor -->
                        <div class="flex justify-between items-center p-3 mb-6">
                            <div class="flex gap-2 items-center">
                                <img
                                    :src="props.course.mentor.profile_picture"
                                    class="size-8 object-cover rounded-full"
                                    alt=""
                                />

                                <div>
                                    <p
                                        class="text-neutral-20 font-bold text-sm mb-1"
                                    >
                                        {{ props.course.mentor.fullname }}
                                    </p>
                                    <p class="text-neutral-40 -mt-1.5 text-sm">
                                        {{
                                            props.course.mentor.mentor_detail
                                                .profession
                                        }}
                                        di
                                        {{
                                            props.course.mentor.mentor_detail
                                                .profession_at
                                        }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-end gap-[0.13rem]">
                                <div
                                    v-for="(bar, index) in bars"
                                    :key="index"
                                    :class="`w-2 ${bar.height} ${bar.color} rounded-[6.25rem] border border-neutral-20`"
                                ></div>
                            </div>
                        </div>
                        <button
                            type="button"
                            class="bg-primary text-neutral-20 text-[1.3125rem] border-b-4 border-primary-hover px-16 py-3 rounded-xl"
                        >
                            Bergabung
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Course -->
        <div class="container xl:py-12 py-8">
            <div class="grid md:grid-cols-2 gap-8 xl:gap-12">
                <div class="col-span-1">
                    <!-- For Who -->
                    <h1 class="title mb-1">Untuk Siapa?</h1>
                    <p class="text-neutral-90 mb-3">
                        Kelas ini cocok buat kamu apabila kamu adalah
                    </p>
                    <ul class="flex flex-col gap-3">
                        <li
                            v-for="(value, key) in dummyCourse.forWho"
                            :key="key"
                            class="flex gap-3 items-center px-3 py-2 border border-neutral-50 rounded-xl"
                        >
                            <img
                                src="../../../images/icons/who.svg"
                                class="size-6"
                                alt=""
                            />
                            <p class="text-neutral-90">{{ value }}</p>
                        </li>
                    </ul>
                </div>
                <div class="col-span-1">
                    <!-- Requirement -->
                    <div class="mb-12">
                        <h1 class="title mb-1">Kebutuhan kamu</h1>
                        <p class="text-neutral-90 mb-6">
                            Sebagai peralatan dan penunjang belajar kamu pada
                            kelas ini, kamu memerlukan beberapa hal seperti
                        </p>
                        <ul class="flex flex-col gap-3">
                            <li
                                v-for="(value, key) in props.course
                                    .requirements"
                                :key="key"
                                class="flex gap-3 items-center"
                            >
                                <img
                                    src="../../../images/icons/check.svg"
                                    class="size-6"
                                    alt=""
                                />
                                <p class="text-neutral-90">{{ value }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div
                class="grid lg:grid-cols-2 xl:grid-cols-5 gap-8 xl:gap-12 xl:py-12 py-8"
            >
                <!-- Curriculum -->
                <div class="lg:col-span-1 xl:col-span-3">
                    <h1 class="title mb-1">Kurikulum</h1>
                    <p class="text-neutral-90 mb-6">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua. incididunt ut labore et dolore magna
                        aliqua.
                    </p>
                    <Accordion :curriculum="dummyCourse.curriculum" />
                </div>
                <!-- Profile Mentor -->
                <div class="lg:col-span-1 xl:col-span-2">
                    <h1 class="title mb-1">Profil Pengajar</h1>
                    <p class="text-neutral-90 mb-6">
                        Pengajar adalah orang yang membuat dan berkontribusi
                        dalam pembuatan kurikulum pada kelas ini
                    </p>
                    <div class="border border-neutral-50 rounded-xl">
                        <div class="bg-neutral-30 flex items-center p-3 gap-3">
                            <img
                                :src="props.course.mentor.profile_picture"
                                class="size-[3.125rem] rounded-lg"
                                alt=""
                            />
                            <div>
                                <h2 class="text-neutral-100 font-bold text-xl">
                                    {{ props.course.mentor.fullname }}
                                </h2>
                                <p class="-mt-1 text-neutral-90">
                                    {{
                                        props.course.mentor.mentor_detail
                                            .profession
                                    }}
                                    di
                                    {{
                                        props.course.mentor.mentor_detail
                                            .profession_at
                                    }}
                                </p>
                            </div>
                        </div>
                        <div class="p-3">
                            <h1 class="text-neutral-100 font-bold text-xl">
                                Siapakan Dia?
                            </h1>
                            <p class="text-neutral-80">
                                {{
                                    props.course.mentor.mentor_detail
                                        .description
                                }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Review -->
            <div class="xl:py-12 py-8">
                <h1 class="title mb-1">Apa kata mereka?</h1>
                <p class="text-neutral-90 mb-12 md:w-3/5">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. incididunt ut labore et dolore magna aliqua.
                </p>
                <CarouselReveiw :testimonials="props.course.testimonies" />
            </div>
            <!-- You Might Like -->
            <div class="xl:py-12 py-8">
                <h1 class="title mb-3">Mungkin kamu suka</h1>
                <div
                    class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
                >
                    <BoxCourse
                        v-for="(course, index) in props.relatedCourses"
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
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.title {
    @apply text-2xl xl:text-[2.3125rem] leading-[2.775rem] font-bold text-neutral-100;
}
::v-deep .about-course ul {
    @apply list-disc list-inside;
}
::v-deep .about-course ul li,
::v-deep .about-course ol li,
::v-deep .about-course p,
::v-deep .about-course h1,
::v-deep .about-course h2,
::v-deep .about-course h3,
::v-deep .about-course h4,
::v-deep .about-course h5,
::v-deep .about-course h6 {
    @apply text-neutral-90;
}
::v-deep .about-course ol li {
    @apply list-decimal list-inside;
}
</style>
