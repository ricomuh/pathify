<script setup lang="ts">
import Navbar from "@/Components/Navbar.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { formToJSON } from "axios";

const props = defineProps({
    course: Object,
});

const selectedRating = ref(0);

const handleStarClick = (rating: number) => {
    selectedRating.value = rating;
    form.rating = rating;
};

const form = useForm({
    body: "",
    rating: 0,
});

// submit review
const submitReview = () => {
    form.post(`/courses/${props.course.slug}/review`, {
        onSuccess: () => {
            window.location.href = `/courses/${props.course.slug}/certificate`;
        },
    });
};
</script>

<template>
    <Head title="Kelas Selesai" />
    <Navbar />
    <div class="bg-neutral-20 pt-32 pb-12">
        <div
            class="container flex flex-col items-center justify-center gap-12 mb-6"
        >
            <img src="/media/illustrations/complete.png" alt="" />
            <div class="flex flex-col items-center justify-center text-center">
                <p class="text-2xl xl:text-2xl-plus text-neutral-90 mb-2">
                    Selamat, Anda telah resmi menamatkan kelas
                </p>
                <h1
                    class="text-primary text-4xl leading-10 xl:text-5xl font-bold"
                >
                    {{ props.course.title }}
                </h1>
            </div>
            <div
                class="p-6 lg:w-2/3 xl:w-1/2 w-full rounded-xl border-2 border-primary-border bg-neutral-10"
                style="border-bottom: 8px solid #c1dcf7 !important"
            >
                <div class="flex gap-3 items-center justify-between mb-3">
                    <label
                        for="review"
                        class="text-neutral-90 text-xl xl:text-xl-plus"
                    >
                        Berikan review Anda
                    </label>
                    <div class="flex gap-4 items-center">
                        <img
                            v-for="star in 5"
                            :key="star"
                            :src="
                                star <= selectedRating
                                    ? '/media/icons/star-fill.svg'
                                    : '/media/icons/star.svg'
                            "
                            alt=""
                            class="cursor-pointer"
                            @click="handleStarClick(star)"
                        />
                    </div>
                </div>
                <textarea
                    name="review"
                    id="review"
                    for="review"
                    v-model="form.body"
                    rows="3"
                    placeholder="Berikan Umpan balik anda"
                    class="w-full rounded-xl border-2 border-neutral-40 px-6 py-3"
                ></textarea>
            </div>
            <button
                type="submit"
                @click="submitReview"
                class="bg-primary hover:bg-primary-hover transition-all duration-200 ease-in-out w-full max-w-96 text-xl-plus py-3 rounded-xl text-neutral-20 border-b-4 border-primary-hover text-center"
            >
                Selanjutnya
            </button>
        </div>
    </div>
    <div class="bg-primary-surface">
        <div class="container flex justify-between items-center py-6">
            <ApplicationLogo class="h-14" />

            <p class="text-neutral-90 text-lg">
                &copy; {{ new Date().getFullYear() }} Phatify
            </p>
        </div>
    </div>
</template>
