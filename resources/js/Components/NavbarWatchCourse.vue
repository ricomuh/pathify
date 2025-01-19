<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import Notifications from "@/Components/Notifications.vue";
import UserMenu from "@/Components/UserMenu.vue";
import SidebarMaterial from "@/Components/SidebarMaterial.vue";

const isScrolled = ref(false);
const isMenuOpen = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 0;
};

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

onMounted(() => {
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});
const props = defineProps({
    course: Object,
    order: Number,
    defaultAccordionValue: String,
    currentOrder: Number,
});
</script>

<template>
    <div>
        <nav
            :class="[
                'fixed top-0 w-full z-[55] transition-colors duration-300',
                isScrolled || !route().current('home')
                    ? 'bg-neutral-10 shadow'
                    : 'bg-transparent',
            ]"
        >
            <!-- Primary Navigation Menu -->
            <div
                class="container w-full flex items-center justify-between relative py-3"
            >
                <button @click="toggleMenu">
                    <img
                        src="/media/icons/menu.svg"
                        class="size-8"
                        alt="Menu"
                    />
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

        <!-- Off-canvas menu -->
        <div
            v-if="isMenuOpen"
            class="fixed inset-0 bg-black bg-opacity-50 z-40"
            @click="toggleMenu"
        ></div>
        <div
            :class="[
                'fixed top-0 left-0  overflow-y-auto h-full w-[90%] min-w-72 bg-white z-50 max-w-80 transform transition-transform duration-300',
                isMenuOpen ? 'translate-x-0' : '-translate-x-full',
            ]"
        >
            <div class="p-4 mt-10">
                <SidebarMaterial
                    :course="props.course"
                    :currentOrder="currentOrder"
                    :order="props.order"
                    :defaultAccordionValue="defaultAccordionValue"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Add any additional styles for the off-canvas menu here */
</style>
