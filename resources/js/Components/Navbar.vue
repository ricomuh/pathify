<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Notifications from "@/Components/Notifications.vue";
import UserMenu from "@/Components/UserMenu.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, usePage } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
const isScrolled = ref(false);
const page = usePage();

const handleScroll = () => {
    isScrolled.value = window.scrollY > 0;
};

onMounted(() => {
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});

const dashboardURL =
    page.props.auth.role == "Admin"
        ? route("admin.dashboard")
        : page.props.auth.role == "Mentor"
        ? route("mentor.dashboard")
        : route("user.dashboard");

const menuItems = [
    { name: "Beranda", routeName: "home", href: route("home") },
    { name: "Kelas", routeName: "courses.index", href: route("courses.index") },
    { name: "Event", routeName: "events.index", href: route("events.index") },
    { name: "Tentang", routeName: "about.index", href: route("about.index") },
];
</script>

<template>
    <div>
        <nav
            :class="[
                'fixed top-0 w-full z-50 transition-colors duration-300',
                isScrolled || !route().current('home')
                    ? 'bg-neutral-10 shadow'
                    : 'bg-neutral-10 sm:bg-transparent',
            ]"
        >
            <!-- Primary Navigation Menu -->
            <div
                class="container relative flex items-center justify-between py-2"
            >
                <!-- Logo -->
                <Link :href="route('home')">
                    <ApplicationLogo class="block h-10 md:h-12 w-auto" />
                </Link>
                <!-- Navigation Links -->
                <div
                    class="hidden justify-center space-x-8 sm:-my-px sm:ms-10 sm:flex"
                >
                    <NavLink
                        v-for="item in menuItems"
                        :key="item.routeName"
                        :href="item.href"
                        :active="route().current(item.routeName)"
                        :isScrolled="isScrolled || !route().current('home')"
                    >
                        {{ item.name }}
                    </NavLink>
                </div>
                <div
                    v-if="$page.props.auth.user"
                    class="flex h-16 justify-center"
                >
                    <div class="flex"></div>
                    <div class="hidden sm:ms-6 gap-4 sm:flex sm:items-center">
                        <!-- Settings Dropdown -->
                        <Notifications />
                        <UserMenu />
                    </div>
                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:text-gray-500 focus:text-gray-500 focus:outline-none"
                        >
                            <img
                                src="/media/icons/menu.svg"
                                class="size-6 rotate-180"
                                alt=""
                            />
                        </button>
                    </div>
                </div>
                <div v-else class="flex gap-3 lg:gap-4 items-center">
                    <Link
                        :href="route('login')"
                        class="text-neutral-20 hover:text-primary-surface lg:text-lg leading-[1.25rem] px-4 lg:px-6 py-2 lg:py-3 rounded-xl border-b-4 border-primary-hover hover:bg-primary-hover transition-all duration-200 ease-in-out bg-primary flex items-center justify-center"
                        >Masuk</Link
                    >
                    <Link
                        :href="route('register')"
                        class="border-b-4 border-primary-border border-t-[3px] border-x-[3px] lg:text-lg leading-[1.25rem] px-4 lg:px-6 py-2 lg:py-3 rounded-xl flex items-center justify-center bg-neutral-20 hover:bg-primary-focus hover:text-primary transition-all duration-200 ease-in-out"
                        >Gabung</Link
                    >
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                v-if="$page.props.auth.user"
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="sm:hidden"
            >
                <div class="space-y-1 pb-3 pt-2 flex flex-col">
                    <ResponsiveNavLink
                        v-for="item in menuItems"
                        :key="item.routeName"
                        :href="item.href"
                        :active="route().current(item.routeName)"
                        :isScrolled="isScrolled || !route().current('home')"
                    >
                        {{ item.name }}
                    </ResponsiveNavLink>
                </div>
                <!-- Responsive Settings Options -->
                <div class="border-t border-gray-200 pb-1 pt-4">
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="text-sm font-medium text-gray-500">
                            {{ $page.props.auth.user.email }}
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink
                            :href="dashboardURL"
                            :active="route().current('dashboard')"
                            >Dashboard</ResponsiveNavLink
                        >
                        <ResponsiveNavLink
                            :href="route('logout')"
                            method="post"
                            as="button"
                            >Log Out</ResponsiveNavLink
                        >
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>
