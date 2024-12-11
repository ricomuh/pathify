<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Event Saya" />

    <UserLayout>
        <div class="container py-12">
            <div class="flex flex-col gap-12">
                <!-- Header -->
                <h1
                    class="font-bold p-6 text-[2.3125rem] rounded-xl bg-neutral-10"
                >
                    Event Saya
                </h1>
            </div>
        </div>
    </UserLayout>
</template>
