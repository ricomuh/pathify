<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import BoxCourse from "@/Components/BoxCourse.vue";
import CarouselReveiw from "@/Components/CarouselReveiw.vue";

const props = defineProps({
    mentor: {
        type: Object,
        required: true,
    },
    courses: {
        type: Array,
        required: true,
    },
    testimonies: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="Detail Mentor" />

    <AuthenticatedLayout>
        <div class="h-80 relative">
            <img
                src="/media/illustrations/cover-mentor.png"
                class="w-full h-56 object-cover"
                alt=""
            />
            <div class="absolute left-1/2 -translate-x-1/2">
                <img
                    :src="props.mentor.profile_picture"
                    class="h-56 w-56 object-cover rounded-3xl border borde-neutral-90 -mt-32"
                    alt=""
                />
            </div>
        </div>
        <div class="container mb-12">
            <div class="flex flex-col gap-12 mt-2.5">
                <div class="text-center">
                    <h1 class="text-4xl font-bold">
                        {{ props.mentor.fullname }}
                    </h1>
                    <p class="text-xl text-neutral-90">
                        {{ props.mentor.mentor_detail.profession }}
                    </p>
                </div>
                <div>
                    <h1 class="text-[2.3125rem] font-bold mb-1">
                        Tentang Mentor
                    </h1>
                    <p class="text-[1.3125rem] text-neutral-90">
                        {{ props.mentor.mentor_detail.description }}
                    </p>
                </div>
                <!-- My Class -->
                <div>
                    <h1 class="text-[2.3125rem] font-bold mb-6">Kelas Saya</h1>
                    <div
                        class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3"
                    >
                        <BoxCourse
                            v-for="(course, index) in props?.courses"
                            :key="index"
                            :iconBadge="course.categories[0].icon_image"
                            :backgroundBadge="course.categories[0].color"
                            :categoryClass="course.categories[0].name"
                            :title="course.title"
                            :teacher="course.mentor.fullname"
                            :teachersJob="
                                course.mentor.mentor_detail.profession
                            "
                            :avatar="course.mentor.profile_picture"
                            :level="course.level"
                            :slug="course.slug"
                            :thumbnail="course.thumbnail"
                        />
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial -->
        <div class="mb-12">
            <div class="container">
                <h1 class="text-[2.3125rem] font-bold mb-6">
                    Apa kata mereka?
                </h1>
            </div>
            <CarouselReveiw :testimonials="props.testimonies" />
        </div>
    </AuthenticatedLayout>
</template>
