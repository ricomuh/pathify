<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

// Sidebar menu items
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
</script>

<template>
    <div
        class="h-[calc(100vh-80px)] w-80 bg-primary-surface p-6 flex flex-col justify-between"
    >
        <div class="flex flex-col gap-1">
            <!-- Sidebar Links -->
            <div v-for="item in menuItems" :key="item.href">
                <Link
                    :href="item.href"
                    class="flex items-center gap-3 p-3 rounded-xl hover:bg-primary-border"
                    :class="{
                        'bg-primary-border': route().current(item.active),
                    }"
                >
                    <img
                        :class="{
                            'filter-image': !route().current(item.active),
                        }"
                        :src="item.icon"
                        class="size-5"
                        :alt="`${item.name} Icon`"
                    />
                    <p
                        class="text-lg"
                        :class="
                            route().current(item.active)
                                ? 'text-neutral-100'
                                : 'text-neutral-90'
                        "
                    >
                        {{ item.name }}
                    </p>
                </Link>
            </div>
        </div>

        <Link
            :href="route('logout')"
            method="post"
            type="button"
            class="w-full text-center cursor-pointer bg-[#FF0101] text-neutral-20 text-2xl py-3 rounded-xl mt-6 border-b-4 border-[#B30505]"
        >
            Keluar
        </Link>
    </div>
</template>

<style scoped>
.filter-image {
    filter: invert(26%) sepia(5%) saturate(299%) hue-rotate(149deg)
        brightness(102%) contrast(87%);
}
</style>
