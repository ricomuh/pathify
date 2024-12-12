<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BadgeCategory from "@/Components/BadgeCategory.vue";
import { Head, Link } from "@inertiajs/vue3";
import { computed, ref, watchEffect } from "vue";
import BoxCourse from "@/Components/BoxCourse.vue";
import CarouselReveiw from "@/Components/CarouselReveiw.vue";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/components/ui/accordion";
import { Progress } from "@/components/ui/progress";

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

// default value for accordion
const defaultAccordionValue = computed(() => {
    return props.course.groups.length > 0 ? props.course.groups[0].id : null;
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
                        <p
                            class="text-neutral-40 text-base mb-6"
                            v-html="props.course.body"
                        ></p>
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
                        <div
                            v-if="props.course.joined != null"
                            class="grid grid-cols-5 items-center gap-4"
                        >
                            <div class="col-span-3">
                                <div class="flex gap-4 items-center py-2">
                                    <Progress
                                        v-model="props.course.joined.progress"
                                        class="bg-white w-full border-none h-3"
                                    />
                                    <p
                                        class="text-white font-bold text-[1.75rem]"
                                    >
                                        {{ props.course.joined.progress }}%
                                    </p>
                                </div>
                            </div>
                            <div class="col-span-2 ms-auto">
                                <Link
                                    :href="`/courses/${props.course.slug}/watch/${props.course.joined.last_watched_episode}`"
                                    type="button"
                                    class="bg-primary text-neutral-20 text-[1.3125rem] border-b-4 border-primary-hover px-8 py-3 rounded-xl"
                                >
                                    Lanjut Belajar
                                </Link>
                            </div>
                        </div>
                        <div v-else class="flex justify-between items-center">
                            <Link
                                :href="`/courses/${props.course.slug}/watch/1`"
                                class="bg-primary block text-neutral-20 text-[1.3125rem] border-b-4 border-primary-hover px-16 py-3 rounded-xl"
                            >
                                Bergabung
                            </Link>
                            <p class="text-white text-end">
                                {{ props.course.users_count }} siswa telah
                                bergabung
                            </p>
                        </div>
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
                            v-for="(value, key) in props.course.recommended"
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
                    <Accordion
                        type="single"
                        class="w-full flex flex-col gap-2"
                        collapsible
                        :default-value="defaultAccordionValue"
                    >
                        <AccordionItem
                            class="bg-neutral-10 cursor-pointer border border-neutral-40 rounded-lg"
                            v-for="(value, index) in props.course.groups"
                            :key="index"
                            :value="value.id"
                        >
                            <AccordionTrigger
                                class="text-neutral-90 px-6 py-3 text-start"
                            >
                                Lecture {{ index + 1 }} -
                                {{ value.title }}</AccordionTrigger
                            >
                            <AccordionContent class="bg-neutral-20 p-0">
                                <ul class="flex flex-col gap-3 px-6 py-3">
                                    <li
                                        v-for="(item, key) in value.contents"
                                        :key="key"
                                        class="text-sm text-neutral-90"
                                    >
                                        {{ item.title }}
                                    </li>
                                </ul>
                            </AccordionContent>
                        </AccordionItem>
                    </Accordion>
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
                            <Link
                                :href="`/mentor/${props.course.mentor.username}`"
                            >
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
                            </Link>
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
        </div>
        <!-- Review -->
        <div class="xl:py-12 py-8">
            <div class="container">
                <h1 class="title mb-1">Apa kata mereka?</h1>
                <p class="text-neutral-90 mb-12 md:w-3/5">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. incididunt ut labore et dolore magna aliqua.
                </p>
            </div>
            <CarouselReveiw :testimonials="props.course.testimonies" />
        </div>
        <!-- You Might Like -->
        <div class="container xl:py-12 py-8">
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
