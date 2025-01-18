<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="p-6 rounded-xl mx-auto bg-primary-surface border-t-8 border-x-8 border-b-[32px] border-primary-hover xl:w-1/2"
    >
        <img
            src="/media/illustrations/test.png"
            class="mx-auto max-h-40 xl:max-h-[15rem] mb-4 xl:mb-8"
            alt=""
        />
        <h1 class="text-2xl xl:text-2xl-plus font-bold mb-2 xl:mb-3">
            Quisioner Personifikasi
        </h1>
        <p
            class="md:text-lg lg:text-xl xl:text-xl-plus text-neutral-90 mb-5 xl:mb-9"
        >
            Ikuti Quisioner, dapatkan rekomendasi kelas dan alur belajar yang
            sesuai dengan diri kamu. Coba sekarang, Gratis!
        </p>
        <div class="flex justify-center">
            <Link
                href="/questionnaire"
                class="py-3 px-6 bg-primary rounded-3xl flex gap-2.5 items-center hover:bg-primary-hover transition-all duration-200 ease-in-out"
            >
                <img
                    src="/media/icons/play.svg"
                    class="size-5 lg:size-6"
                    alt=""
                />
                <span class="text-white text-lg xl:text-xl"
                    >Mulai sekarang</span
                >
            </Link>
        </div>
    </div>
</template>
