<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="grid grid-cols-2 h-screen overflow-hidden">
        <img
            src="../../images/banner.png"
            class="w-full h-full object-cover"
            alt=""
        />
        <div class="col overflow-y-auto h-screen">
            <div class="bg-primary-surface px-12 py-6">
                <Link href="/">
                    <ApplicationLogo
                        class="h-20 w-auto fill-current text-gray-500"
                    />
                </Link>
            </div>
            <div class="pt-12 pb-72 px-[6.25rem] bg-neutral-10">
                <slot />
            </div>
            <div class="bg-primary-surface py-6 px-12 text-center">
                <p class="text-neutral-90 text-2xl">
                    &copy; {{ new Date().getFullYear() }} Phatify
                </p>
            </div>
        </div>
    </div>
</template>
