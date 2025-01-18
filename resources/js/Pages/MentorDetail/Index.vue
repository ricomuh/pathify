<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import BoxCourse from "@/Components/BoxCourse.vue";
import CarouselReveiw from "@/Components/CarouselReveiw.vue";
import {
    Carousel,
    CarouselContent,
    CarouselItem,
    CarouselNext,
    CarouselPrevious,
} from "@/Components/ui/carousel";

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
        <div class="h-48 xl:h-80 relative mt-12">
            <img
                src="/media/illustrations/cover-mentor.png"
                class="w-full h-32 xl:h-56 object-cover"
                alt=""
            />
            <div class="absolute left-1/2 -translate-x-1/2">
                <img
                    :src="props.mentor.profile_picture"
                    class="size-32 -mt-16 xl:size-56 object-cover rounded-3xl border borde-neutral-90 xl:-mt-32"
                    alt=""
                />
            </div>
        </div>
        <div class="container mb-12">
            <div class="flex flex-col gap-6 lg:gap-8 xl:gap-12 mt-2.5">
                <div class="text-center">
                    <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold">
                        {{ props.mentor.fullname }}
                    </h1>
                    <p class="text-lg xl:text-xl text-neutral-90">
                        {{ props.mentor.mentor_detail.profession }}
                    </p>
                </div>
                <div>
                    <h1
                        class="text-xl md:text-2xl lg:text-3xl xl:text-4xl-plus font-bold mb-1"
                    >
                        Tentang Mentor
                    </h1>
                    <p
                        class="md:text-lg lg:text-xl xl:text-xl-plus text-neutral-90"
                    >
                        {{ props.mentor.mentor_detail.description }}
                    </p>
                </div>
                <!-- My Class -->
                <div>
                    <h1
                        class="text-xl md:text-2xl lg:text-3xl xl:text-4xl-plus font-bold mb-6"
                    >
                        Kelas Saya
                    </h1>
                    <Carousel
                        class="relative w-full"
                        :opts="{
                            align: 'start',
                        }"
                    >
                        <CarouselContent>
                            <CarouselItem
                                v-for="(course, index) in props?.courses"
                                :key="index"
                                class="sm:basis-[48%] md:basis-[42%] lg:basis-1/3 xl:basis-1/4"
                            >
                                <div class="grid">
                                    <BoxCourse
                                        :iconBadge="
                                            course.categories[0].icon_image
                                        "
                                        :backgroundBadge="
                                            course.categories[0].color
                                        "
                                        :categoryClass="
                                            course.categories[0].name
                                        "
                                        :title="course.title"
                                        :teacher="course.mentor.fullname"
                                        :teachersJob="
                                            course.mentor.mentor_detail
                                                .profession
                                        "
                                        :avatar="course.mentor.profile_picture"
                                        :level="course.level"
                                        :slug="course.slug"
                                        :thumbnail="course.thumbnail"
                                    />
                                </div>
                            </CarouselItem>
                        </CarouselContent>
                        <CarouselPrevious />
                        <CarouselNext />
                    </Carousel>
                </div>
            </div>
        </div>
        <!-- Testimonial -->
        <div class="mb-12">
            <div class="container">
                <h1
                    class="text-xl md:text-2xl lg:text-3xl xl:text-4xl-plus font-bold mb-4 xl:mb-6"
                >
                    Apa kata mereka?
                </h1>
            </div>
            <CarouselReveiw :testimonials="props.testimonies" />
        </div>
    </AuthenticatedLayout>
</template>
