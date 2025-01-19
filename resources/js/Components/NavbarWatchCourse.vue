<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import Notifications from "@/Components/Notifications.vue";
import UserMenu from "@/Components/UserMenu.vue";

const isScrolled = ref(false);

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
                class="container w-full flex items-center justify-between relative py-3"
            >
                <button>
                    <img src="/media/icons/menu.svg" alt="" />
                </button>
                <!-- Logo -->
                <Link
                    :href="route('home')"
                    class="absolute left-1/2 transform -translate-x-1/2"
                >
                    <ApplicationLogo class="block h-12 w-auto" />
                </Link>

                <div class="ms-6 gap-4 flex items-center">
                    <!-- Settings Dropdown -->
                    <Notifications />
                    <UserMenu />
                </div>
            </div>
        </nav>
    </div>
</template>
