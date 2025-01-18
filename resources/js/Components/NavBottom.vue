<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

// Define menu items
const menuItems = [
    {
        name: "Dashboard",
        href: route("user.dashboard"),
        icon: "/media/icons/dashboard.svg",
        active: "dashboard",
    },
    {
        name: "Kelas Saya",
        href: route("user.my-courses.index"),
        icon: "/media/icons/class.svg",
        active: "my-courses.index",
    },
    {
        name: "Event Saya",
        href: route("user.my-events.index"),
        icon: "/media/icons/event.svg",
        active: "my-events.index",
    },
    {
        name: "Akun Saya",
        href: "/profile",
        icon: "/media/icons/profile.svg",
        active: "profile.edit",
    },
];
</script>

<template>
    <div
        class="fixed bottom-0 left-0 right-0 bg-white shadow-sm border-t py-3 px-4 flex justify-between items-center"
    >
        <div
            v-for="item in menuItems"
            :key="item.name"
            class="flex gap-1 flex-col items-center p-3"
        >
            <Link :href="item.href" class="flex gap-1 flex-col items-center">
                <img :src="item.icon" :alt="`${item.name} Icon`" />
                <p class="text-xs">{{ item.name }}</p>
            </Link>
        </div>
    </div>
</template>
