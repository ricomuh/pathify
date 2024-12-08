<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
</script>

<template>
    <footer class="bg-primary-surface">
        <div class="container py-6">
            <div class="flex justify-between items-center">
                <ApplicationLogo class="h-14 w-auto" />
                <p class="text-neutral-90 text-center text-lg">
                    &copy; {{ new Date().getFullYear() }} Phatify
                </p>
            </div>
        </div>
    </footer>
</template>
