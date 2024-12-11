<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="bg-neutral-10 min-h-screen flex flex-col py-12 justify-center items-center"
    >
        <ApplicationLogo class="h-16 mb-12" />
        <img src="/media/illustrations/not-found.svg" class="max-w-96" alt="" />
        <p class="text-4xl text-neutral-90 mb-6">
            Ooops, halaman ini tidak ada
        </p>
        <Link
            href="/"
            class="py-3 px-16 text-neutral-20 text-2xl bg-primary rounded-xl border-b-4 border-primary-hover"
            >Kembali</Link
        >
    </div>
</template>

<style scoped>
/* Add any custom styles here */
</style>
