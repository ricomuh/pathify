<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
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
</script>

<template>
    <div>
        <nav
            :class="[
                'fixed top-0 w-full z-50 transition-colors duration-300',
                isScrolled || !route().current('home')
                    ? 'bg-neutral-10 shadow'
                    : 'bg-transparent',
            ]"
        >
            <!-- Primary Navigation Menu -->
            <div
                class="container relative flex items-center justify-between py-2"
            >
                <!-- Logo -->
                <Link :href="route('home')">
                    <ApplicationLogo class="block h-12 w-auto" />
                </Link>
                <!-- Navigation Links -->
                <div
                    class="hidden justify-center space-x-8 sm:-my-px sm:ms-10 sm:flex"
                >
                    <NavLink
                        :href="route('home')"
                        :active="route().current('home')"
                        :isScrolled="isScrolled || !route().current('home')"
                        >Beranda</NavLink
                    >
                    <NavLink
                        :href="route('courses.index')"
                        :active="route().current('courses.*')"
                        :isScrolled="isScrolled || !route().current('home')"
                        >Kelas</NavLink
                    >
                    <NavLink
                        :href="route('events.index')"
                        :active="route().current('events.*')"
                        :isScrolled="isScrolled || !route().current('home')"
                        >Event</NavLink
                    >
                    <NavLink
                        :href="route('about.index')"
                        :active="route().current('about.index')"
                        :isScrolled="isScrolled || !route().current('home')"
                        >Tentang</NavLink
                    >
                </div>
                <div
                    v-if="$page.props.auth.user"
                    class="flex h-16 justify-center"
                >
                    <div class="flex"></div>
                    <div class="hidden sm:ms-6 gap-4 sm:flex sm:items-center">
                        <!-- Settings Dropdown -->
                        <div class="relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <div class="inline-flex">
                                        <button
                                            type="button"
                                            class="size-10 border-[3px] border-primary-surface bg-primary-surface rounded-xl flex items-center justify-center"
                                        >
                                            <img
                                                src="../../images/icons/notification.svg"
                                                alt=""
                                                class="h-full w-full p-1.5 object-cover"
                                            />
                                        </button>
                                    </div>
                                </template>
                                <template #content>
                                    <div class="py-3 px-4">
                                        <h1
                                            class="text-lg font-bold text-neutral-100"
                                        >
                                            Notifikasi
                                        </h1>
                                        <p
                                            class="text-neutral-80 text-center text-sm mt-2"
                                        >
                                            Tidak ada notifikasi
                                        </p>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>
                        <div class="relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <button
                                        type="button"
                                        class="size-10 rounded-xl border-[3px] border-primary-border overflow-hidden"
                                    >
                                        <img
                                            :src="
                                                $page.props.auth.user
                                                    .profile_picture
                                            "
                                            alt=""
                                            class="h-full w-full object-cover"
                                        />
                                    </button>
                                </template>
                                <template #content>
                                    <DropdownLink :href="route('dashboard')"
                                        >Dashboard</DropdownLink
                                    >
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                        >Log Out</DropdownLink
                                    >
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                <div v-else class="flex gap-4 items-center">
                    <Link
                        :href="route('login')"
                        class="text-neutral-20 hover:text-primary-surface text-lg leading-[1.25rem] px-6 py-3 rounded-xl border-b-4 border-primary-hover hover:bg-primary-hover transition-all duration-200 ease-in-out bg-primary flex items-center justify-center"
                        >Masuk</Link
                    >
                    <Link
                        :href="route('register')"
                        class="border-b-4 border-primary-border border-t-[3px] border-x-[3px] text-lg leading-[1.25rem] px-6 py-3 rounded-xl flex items-center justify-center bg-neutral-20"
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
                <div class="space-y-1 pb-3 pt-2">
                    <ResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        >Dashboard</ResponsiveNavLink
                    >
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
                        <ResponsiveNavLink :href="route('profile.edit')"
                            >Profile</ResponsiveNavLink
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

<style scoped>
/* Add any custom styles here */
</style>
