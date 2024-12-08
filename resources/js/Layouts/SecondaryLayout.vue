<script setup>
import Navbar from "@/Components/Navbar.vue";
import FooterCourse from "@/Components/FooterCourse.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <!-- Navbar -->
            <Navbar />

            <!-- Page Content -->
            <main class="pt-20">
                <slot />
            </main>

            <!-- Footer -->
            <!-- <FooterCourse /> -->
        </div>
    </div>
</template>
