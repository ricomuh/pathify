<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="grid lg:grid-cols-2 h-screen overflow-hidden">
        <img
            src="/media/illustrations/banner.png"
            class="w-full h-full object-cover hidden lg:block"
            alt=""
        />
        <div class="col overflow-y-auto h-screen">
            <div
                class="bg-primary-surface px-8 md:px-12 py-3 sticky top-0 w-full md:py-4"
            >
                <Link href="/">
                    <ApplicationLogo class="h-12 w-auto" />
                </Link>
            </div>
            <div
                class="min-h-[88vh] pt-12 pb-32 xl:pb-56 px-6 md:px-[6.25rem] lg:px-8 xl:px-[6.25rem] bg-neutral-10 flex flex-col justify-center xl:block"
            >
                <slot />
            </div>
            <div class="bg-primary-surface py-6 px-12 text-center">
                <p class="text-neutral-90 md:text-lg">
                    &copy; {{ new Date().getFullYear() }} Phatify
                </p>
            </div>
        </div>
    </div>
</template>
