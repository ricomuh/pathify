<script setup lang="ts">
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

// Define menu items
const menuItems = [
    {
        name: "Dashboard",
        href: route("user.dashboard"),
        icon: "/media/icons/dashboard.svg",
        active: "user.dashboard",
    },
    {
        name: "Kelas Saya",
        href: route("user.my-courses.index"),
        icon: "/media/icons/class.svg",
        active: "user.my-courses.index",
    },
    {
        name: "Event Saya",
        href: route("user.my-events.index"),
        icon: "/media/icons/event.svg",
        active: "user.my-events.index",
    },
    {
        name: "Akun Saya",
        href: route("profile.edit"),
        icon: "/media/icons/profile.svg",
        active: "profile.edit",
    },
];

const currentRoute = computed(() => usePage().props.url);
</script>

<template>
    <div
        class="fixed bottom-0 left-0 right-0 bg-white shadow-sm border-t py-1 px-4 flex justify-between items-center"
    >
        <div
            v-for="item in menuItems"
            :key="item.name"
            class="flex gap-1 flex-col items-center p-3"
        >
            <Link :href="item.href" class="flex gap-1 flex-col items-center">
                <img
                    :src="item.icon"
                    :alt="`${item.name} Icon`"
                    :class="{ 'filter-image': route().current(item.active) }"
                    class="size-5"
                />
                <p
                    :class="{
                        'text-primary': route().current(item.active),
                        'text-neutral-90': !route().current(item.active),
                    }"
                    class="text-xs"
                >
                    {{ item.name }}
                </p>
            </Link>
        </div>
    </div>
</template>

<style scoped>
.filter-image {
    filter: invert(45%) sepia(94%) saturate(372%) hue-rotate(169deg)
        brightness(102%) contrast(90%);
}
</style>
