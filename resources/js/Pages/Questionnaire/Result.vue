<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Head, Link } from "@inertiajs/vue3";
import BadgeCategory from "@/Components/BadgeCategory.vue";
import { Progress } from "@/Components/ui/progress";
import ShareResult from "@/Components/ShareResult.vue";
import BoxCourse from "@/Components/BoxCourse.vue";
import {
    Carousel,
    CarouselContent,
    CarouselItem,
    CarouselNext,
    CarouselPrevious,
} from "@/Components/ui/carousel";

const props = defineProps({
    questionnaireResult: {
        type: Object,
        required: true,
    },
    relatedCourses: {
        type: Array,
        required: true,
    },
});

// format date
const formatDate = (date) => {
    const options = {
        year: "numeric",
        month: "long",
        day: "numeric",
    };
    return new Date(date).toLocaleDateString("id-ID", options);
};
</script>
<template>
    <Head title="Hasil Kuisioner" />
    <div class="bg-neutral-20">
        <div class="bg-neutral-10 py-6 sticky top-0 shadow-sm z-50">
            <div class="container">
                <Link href="/">
                    <ApplicationLogo class="h-12 mx-auto" />
                </Link>
            </div>
        </div>
        <div class="container pt-6 pb-20">
            <div class="flex flex-col gap-6 xl:gap-12">
                <!-- Result -->
                <div
                    class="bg-neutral-10 p-6 rounded-xl flex flex-col gap-4 xl:gap-12 lg:w-5/6 lg:mx-auto"
                >
                    <div
                        class="border w-max border-neutral-50 p-2 rounded-2xl flex gap-2 items-center"
                    >
                        <img
                            :src="questionnaireResult.user.profile_picture"
                            class="size-[3.5rem] object-cover rounded-2xl border-2 border-primary-border"
                            alt=""
                        />
                        <p class="text-primary text-xl">
                            {{ questionnaireResult.user.fullname }}
                        </p>
                    </div>
                    <div
                        class="flex justify-between flex-wrap items-center gap-4"
                    >
                        <div>
                            <p class="text-xl xl:text-xl-plus text-primary">
                                Kamu adalah seorang
                            </p>
                            <h1 class="text-3xl xl:text-4xl-plus font-bold">
                                {{ questionnaireResult.category.name }}
                            </h1>
                        </div>
                        <!-- Share -->
                        <ShareResult
                            :image="questionnaireResult.category.image"
                        />
                    </div>
                    <img
                        :src="questionnaireResult.category.image"
                        class="md:h-72 xl:h-[25rem] w-auto object-contain"
                        alt=""
                    />
                    <p class="text-xl xl:text-xl-plus text-neutral-90">
                        {{ questionnaireResult.category.description }}
                    </p>
                    <div>
                        <h1 class="text-2xl xl:text-2xl-plus font-bold mb-3">
                            Karir yang direkomendasikan
                        </h1>
                        <div class="flex flex-wrap gap-2 md:gap-4">
                            <BadgeCategory
                                v-if="questionnaireResult.first_category"
                                :category="
                                    questionnaireResult.first_category.name
                                "
                                :backgroundColor="
                                    questionnaireResult.first_category.color
                                "
                                :icons="
                                    questionnaireResult.first_category
                                        .icon_image
                                "
                                fontSize="xl:text-lg"
                                paddingY="py-2 !rounded-xl"
                            />
                            <BadgeCategory
                                v-if="questionnaireResult.second_category"
                                :category="
                                    questionnaireResult.second_category.name
                                "
                                :backgroundColor="
                                    questionnaireResult.second_category.color
                                "
                                :icons="
                                    questionnaireResult.second_category
                                        .icon_image
                                "
                                fontSize="xl:text-lg"
                                paddingY="py-2 !rounded-xl"
                            />
                        </div>
                    </div>
                </div>

                <!-- Presentase -->
                <div
                    class="bg-neutral-10 p-6 rounded-xl flex flex-col gap-3 lg:w-5/6 lg:mx-auto"
                >
                    <h1
                        class="text-2xl xl:text-2xl-plus font-bold pb-6 border-b border-neutral-40"
                    >
                        Prosentase Bakat Anda
                    </h1>
                    <div
                        class="w-full md:w-5/6 xl:w-4/6 flex flex-col mx-auto gap-2 md:gap-6"
                    >
                        <div
                            v-for="(
                                result, category
                            ) in questionnaireResult.result"
                            :key="category"
                            class="flex flex-col md:flex-row items-center gap-2 md:gap-6 py-3"
                        >
                            <div class="w-full md:w-2/6 xl:w-1/4 md:text-end">
                                <p class="text-neutral-80 font-semibold">
                                    {{ category }}
                                </p>
                            </div>
                            <div
                                class="w-full md:w-3/6 xl:w-3/4 flex items-center gap-6"
                            >
                                <Progress
                                    :model-value="result.score"
                                    class="w-full bg-neutral-30 h-5"
                                    :backgroundColor="result.color"
                                />
                                <p class="text-neutral-80 font-semibold">
                                    {{ Math.round(result.score) }}%
                                </p>
                            </div>
                        </div>
                    </div>
                    <p class="text-neutral-80">
                        Test Terakhir :
                        {{ formatDate(questionnaireResult.created_at) }}
                    </p>
                </div>

                <!-- Recommendation Class -->
                <div class="lg:w-5/6 lg:mx-auto">
                    <h1
                        class="text-3xl-plus leading-[2.5rem] xl:text-4xl-plus font-bold mb-6"
                    >
                        Kelas yang kami rekomendasikan
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
                                class="md:basis-1/2 lg:basis-[40%] xl:basis-[31%]"
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
    </div>
</template>
