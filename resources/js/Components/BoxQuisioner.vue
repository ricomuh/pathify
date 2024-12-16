<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="p-6 rounded-xl bg-primary-surface border-t-8 border-x-8 border-b-[32px] border-primary-hover xl:w-1/2"
    >
        <h1 class="text-2xl-plus font-bold mb-3">Quisioner Personifikasi</h1>
        <p class="text-xl-plus text-neutral-90 mb-9">
            Ikuti Quisioner, dapatkan rekomendasi kelas dan alur belajar yang
            sesuai dengan diri kamu. Coba sekarang, Gratis!
        </p>
        <div class="flex justify-end">
            <Link
                href="/questionnaire"
                class="py-3 px-6 bg-primary rounded-3xl hover:bg-primary-hover transition-all duration-200 ease-in-out"
            >
                <img src="/media/icons/play.svg" alt="" />
            </Link>
        </div>
    </div>
</template>
