<script setup>
import Navbar from "@/Components/Navbar.vue";
import NavbarWatchCourse from "@/Components/NavbarWatchCourse.vue";

const props = defineProps({
    course: Object,
    order: Number,
    defaultAccordionValue: String,
    currentOrder: Number,
});
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <!-- Navbar -->
            <NavbarWatchCourse
                class="lg:hidden"
                :course="props.course"
                :currentOrder="currentOrder"
                :order="props.order"
                :defaultAccordionValue="defaultAccordionValue"
            />
            <Navbar class="hidden lg:block" />

            <!-- Page Content -->
            <main class="pt-20">
                <slot />
            </main>
        </div>
    </div>
</template>
