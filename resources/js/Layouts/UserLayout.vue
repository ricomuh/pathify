<script setup>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import { Link } from "@inertiajs/vue3";

// Sidebar menu items
const menuItems = [
    {
        name: "Dashboard",
        href: "/dashboard",
        icon: "/media/icons/dashboard.svg",
        active: "dashboard",
    },
    {
        name: "Kelas Saya",
        href: "/my-courses",
        icon: "/media/icons/class.svg",
        active: "my-courses.index",
    },
    {
        name: "Event Saya",
        href: "/my-events",
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
    <div>
        <div class="bg-neutral-20">
            <!-- Navbar -->
            <Navbar />

            <!-- Page Content -->
            <main class="pt-20">
                <div
                    class="grid grid-cols-5 min-h-[calc(100vh-80px)] overflow-hidden"
                >
                    <!-- Sidebar -->
                    <div
                        class="col-span-1 bg-primary-surface p-6 flex flex-col justify-between"
                    >
                        <div class="flex flex-col gap-1">
                            <!-- Sidebar Links -->
                            <template
                                v-for="item in menuItems"
                                :key="item.href"
                            >
                                <Link
                                    :href="item.href"
                                    class="flex items-center gap-3 p-3 rounded-xl hover:bg-primary-border"
                                    :class="{
                                        'bg-primary-border': route().current(
                                            item.active
                                        ),
                                    }"
                                >
                                    <img
                                        :class="{
                                            'filter-image': !route().current(
                                                item.active
                                            ),
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
                            </template>
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

                    <!-- Content -->
                    <div class="col-span-4 overflow-y-auto">
                        <slot />
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <Footer />
        </div>
    </div>
</template>

<style scoped>
.filter-image {
    filter: invert(29%) sepia(6%) saturate(265%) hue-rotate(149deg)
        brightness(90%) contrast(88%);
}
</style>
