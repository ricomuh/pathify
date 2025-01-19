<script setup>
import Navbar from "@/Components/Navbar.vue";
import NavbarWatchCourse from "@/Components/NavbarWatchCourse.vue";
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <!-- Navbar -->
            <NavbarWatchCourse class="lg:hidden" />
            <Navbar class="hidden lg:block" />

            <!-- Page Content -->
            <main class="pt-20">
                <slot />
            </main>
        </div>
    </div>
</template>
