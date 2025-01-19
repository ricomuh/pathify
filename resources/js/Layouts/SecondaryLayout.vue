<script setup>
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
                :course="props.course"
                :currentOrder="currentOrder"
                :order="props.order"
                :defaultAccordionValue="defaultAccordionValue"
            />

            <!-- Page Content -->
            <main class="pt-16">
                <slot />
            </main>
        </div>
    </div>
</template>
