<script setup>
import Navbar from "@/Components/Navbar.vue";
import NavBottom from "@/Components/NavBottom.vue";
import SidebarUser from "@/Components/SidebarUser.vue";
</script>

<template>
    <div>
        <div class="bg-neutral-20">
            <!-- Navbar -->
            <Navbar />

            <!-- Page Content -->
            <main class="pt-20">
                <div class="flex gap-4 h-[calc(100vh-80px)] overflow-hidden">
                    <!-- Sidebar -->
                    <SidebarUser class="flex-shrink-0 hidden lg:flex" />

                    <!-- Content -->
                    <div class="w-full overflow-y-auto">
                        <slot />
                    </div>
                </div>
            </main>

            <!-- Nav Botom -->
            <NavBottom class="lg:hidden" />
        </div>
    </div>
</template>

<style scoped>
.filter-image {
    filter: invert(29%) sepia(6%) saturate(265%) hue-rotate(149deg)
        brightness(90%) contrast(88%);
}
</style>
