<script setup>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <!-- Navbar -->
            <Navbar />

            <!-- Page Content -->
            <main>
                <slot />
            </main>

            <!-- Footer -->
            <Footer />
        </div>
    </div>
</template>
