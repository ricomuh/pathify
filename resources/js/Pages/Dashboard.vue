<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head } from "@inertiajs/vue3";
import BadgeCategory from "@/Components/BadgeCategory.vue";
import QuisionerDashboard from "@/Components/QuisionerDashboard.vue";

const props = defineProps({
    auth: {
        type: Object,
        required: true,
    },
    questionnaireResult: {
        type: Object,
        required: true,
    },
    coursesCount: {
        type: Number,
        required: true,
    },
    eventsCount: {
        type: Number,
        required: true,
    },
    certificateCount: {
        type: Number,
        required: true,
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <UserLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="container pt-8 pb-32 lg:pb-12 xl:!py-12">
            <div class="flex flex-col gap-4 md:gap-6 lg:gap-8 xl:gap-12">
                <!-- Quisioner result -->
                <div class="bg-neutral-10 p-4 lg:p-5 xl:p-6 rounded-xl">
                    <h1 class="font-bold text-2xl lg:text-3xl xl:text-4xl">
                        Halo,
                        <span class="text-primary">{{
                            props.auth.user.fullname
                        }}</span>
                        👋
                    </h1>
                    <div v-if="props.questionnaireResult">
                        <p
                            class="text-lg lg:text-xl xl:text-2xl text-neutral-90"
                        >
                            Sang
                            <span class="text-primary">{{
                                props.questionnaireResult?.category.name
                            }}</span>
                        </p>
                        <div
                            class="py-2 px-4 bg-neutral-20 rounded-xl flex justify-between sm:flex-row md:items-center gap-2 mt-3 flex-col xl:mt-8 mb-3"
                        >
                            <p class="text-neutral-90 md:text-lg xl:text-xl">
                                Karir yang cocok untuk Anda
                            </p>
                            <div class="flex flex-wrap gap-2 md:gap-4">
                                <BadgeCategory
                                    v-if="
                                        props.questionnaireResult.first_category
                                    "
                                    :category="
                                        props.questionnaireResult.first_category
                                            .name
                                    "
                                    :backgroundColor="
                                        props.questionnaireResult.first_category
                                            .color
                                    "
                                    :icons="
                                        props.questionnaireResult.first_category
                                            .icon_image
                                    "
                                    fontSize="text-sm xl:text-lg"
                                    paddingY="py-2 !rounded-xl"
                                />
                                <BadgeCategory
                                    v-if="
                                        props.questionnaireResult
                                            .second_category
                                    "
                                    :category="
                                        props.questionnaireResult
                                            .second_category.name
                                    "
                                    :backgroundColor="
                                        props.questionnaireResult
                                            .second_category.color
                                    "
                                    :icons="
                                        props.questionnaireResult
                                            .second_category.icon_image
                                    "
                                    fontSize="text-sm xl:text-lg"
                                    paddingY="py-2 !rounded-xl"
                                />
                            </div>
                        </div>
                        <img
                            :src="props.questionnaireResult?.category.image"
                            alt=""
                            class="mx-auto max-w-72"
                        />
                    </div>
                </div>

                <!-- Data -->
                <div class="bg-neutral-10 p-4 lg:p-5 xl:p-6 rounded-xl">
                    <h1
                        class="text-xl xl:text-2xl font-bold text-center mb-4 xl:mb-6"
                    >
                        Pencapaian
                    </h1>
                    <div
                        class="grid grid-cols-3 xl:w-3/4 mx-auto justify-center gap-6"
                    >
                        <div class="col-span-1 text-center">
                            <p
                                class="text-4xl lg:text-5xl xl:text-[3.5rem] leading-[4.25rem] font-bold"
                            >
                                {{ props.coursesCount }}
                            </p>
                            <p class="lg:text-lg text-neutral-80">
                                Kelas Diikuti
                            </p>
                        </div>
                        <div class="col-span-1 text-center">
                            <p
                                class="text-4xl lg:text-5xl xl:text-[3.5rem] leading-[4.25rem] font-bold"
                            >
                                {{ props.eventsCount }}
                            </p>
                            <p class="lg:text-lg text-neutral-80">
                                Event Dihadiri
                            </p>
                        </div>
                        <div class="col-span-1 text-center">
                            <p
                                class="text-4xl lg:text-5xl xl:text-[3.5rem] leading-[4.25rem] font-bold"
                            >
                                {{ props.certificateCount }}
                            </p>
                            <p class="lg:text-lg text-neutral-80">Sertifikat</p>
                        </div>
                    </div>
                </div>

                <!-- Quisioner -->
                <QuisionerDashboard />
            </div>
        </div>
    </UserLayout>
</template>
