<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import BoxCourse from "@/Components/BoxCourse.vue";
import BadgeCategory from "@/Components/BadgeCategory.vue";
import { computed } from "vue";
import { Progress } from "@/Components/ui/progress";
import {
    Carousel,
    CarouselContent,
    CarouselItem,
    CarouselNext,
    CarouselPrevious,
} from "@/Components/ui/carousel";

const props = defineProps({
    courses: {
        type: Array,
        required: true,
    },
    relatedCourses: {
        type: Array,
        required: true,
    },
    questionnaire_result: {
        type: Object,
        required: true,
    },
});

const bars = computed(() => {
    return props.courses.map((course) => {
        const levels = [
            { height: "h-3", color: "bg-neutral-50" },
            { height: "h-5", color: "bg-neutral-50" },
            { height: "h-7", color: "bg-neutral-50" },
        ];

        return levels.map((bar, index) => {
            if (index < course.level) {
                bar.color = "bg-primary";
            }
            return bar;
        });
    });
});
</script>

<template>
    <Head title="Kelas Saya" />

    <UserLayout>
        <div class="container py-12">
            <div class="flex flex-col gap-12">
                <!-- Header -->
                <h1
                    class="font-bold p-6 text-[2.3125rem] rounded-xl bg-neutral-10"
                >
                    Kelas Saya
                </h1>

                <!-- Box Quisioner -->
                <div
                    class="p-6 rounded-xl bg-primary-surface border-t-8 border-x-8 border-b-[32px] border-primary-hover xl:w-1/2"
                >
                    <h1 class="text-[1.75rem] font-bold mb-3">
                        Quisioner Personifikasi
                    </h1>
                    <p class="text-[1.3125rem] text-neutral-90 mb-9">
                        Ikuti Quisioner, dapatkan rekomendasi kelas dan alur
                        belajar yang sesuai dengan diri kamu. Coba sekarang,
                        Gratis!
                    </p>
                    <div class="flex justify-end">
                        <Link
                            href="/questionnaire"
                            class="py-3 px-6 bg-primary rounded-3xl"
                        >
                            <img src="/media/icons/play.svg" alt="" />
                        </Link>
                    </div>
                </div>

                <!-- Your Class -->
                <div>
                    <h1 class="text-[2.3125rem] font-bold">
                        Kelas yang kamu pilih
                    </h1>
                    <p v-if="!props.courses" class="mt-3">
                        Kamu belum bergabung pada kelas manapun, klik disini
                        untuk bergabung dan memilih kelas pertamamu
                    </p>
                    <div v-else class="mt-6">
                        <Carousel
                            class="relative w-full"
                            :opts="{
                                align: 'center',
                                gap: 24,
                            }"
                        >
                            <CarouselContent>
                                <CarouselItem
                                    v-for="(value, key) in props.courses"
                                    :key="key"
                                    class="xl:basis-3/5"
                                >
                                    <Link
                                        :href="`/courses/${value.slug}`"
                                        class="p-3 rounded-2xl border border-neutral-90 bg-neutral-30 flex gap-6"
                                    >
                                        <img
                                            :src="value.thumbnail"
                                            class="w-[16rem] h-80 object-cover rounded-xl"
                                            alt=""
                                        />
                                        <div
                                            class="flex flex-col gap-3 py-3 w-[32rem]"
                                        >
                                            <!-- Category -->
                                            <BadgeCategory
                                                :category="
                                                    value.categories[0].name
                                                "
                                                :backgroundColor="
                                                    value.categories[0].color
                                                "
                                                :icons="
                                                    value.categories[0]
                                                        .icon_image
                                                "
                                            />
                                            <h1
                                                class="text-[1.3125rem] font-bold h-16"
                                            >
                                                {{ value.title }}
                                            </h1>
                                            <!-- Mentor -->
                                            <div
                                                class="flex justify-between items-center py-3 w-full"
                                            >
                                                <div
                                                    class="flex gap-2 items-center"
                                                >
                                                    <img
                                                        :src="
                                                            value.mentor
                                                                .profile_picture
                                                        "
                                                        class="size-8 object-cover rounded-full"
                                                        alt=""
                                                    />

                                                    <div>
                                                        <p
                                                            class="font-bold text-sm mb-1"
                                                        >
                                                            {{
                                                                value.mentor
                                                                    .fullname
                                                            }}
                                                        </p>
                                                        <p
                                                            class="-mt-1.5 text-sm"
                                                        >
                                                            {{
                                                                value.mentor
                                                                    .mentor_detail
                                                                    .profession
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex items-end gap-[0.13rem]"
                                                >
                                                    <div
                                                        v-for="(
                                                            bar, index
                                                        ) in bars[key]"
                                                        :key="index"
                                                        :class="`w-2 ${bar.height} ${bar.color} rounded-[6.25rem]`"
                                                    ></div>
                                                </div>
                                            </div>
                                            <!-- Progress -->
                                            <div
                                                class="flex gap-6 items-center py-2"
                                            >
                                                <Progress
                                                    v-model="
                                                        value.joined.progress
                                                    "
                                                    class="bg-white w-full border-none h-3"
                                                />
                                                <p
                                                    class="text-primary font-bold text-[1.75rem]"
                                                >
                                                    {{ value.joined.progress }}%
                                                </p>
                                            </div>
                                        </div>
                                    </Link>
                                </CarouselItem>
                            </CarouselContent>
                            <CarouselPrevious />
                            <CarouselNext />
                        </Carousel>
                    </div>
                </div>

                <!-- Maybe You Like -->
                <div>
                    <h1 class="text-[2.3125rem] font-bold mb-6">
                        Mungkin kamu suka
                    </h1>
                    <Carousel
                        class="relative w-full"
                        :opts="{
                            align: 'start',
                        }"
                    >
                        <CarouselContent>
                            <CarouselItem
                                v-for="(course, index) in props?.relatedCourses"
                                :key="index"
                                class="md:basis-1/2 lg:basis-1/3 xl:basis-[30%]"
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
    </UserLayout>
</template>
