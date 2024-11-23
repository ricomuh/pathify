<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { ref } from "vue";

// sections of the footer
const sections = ref([
    {
        heading: "Heading Link 1",
        links: [
            { text: "Link 1", href: "#" },
            { text: "Link 2", href: "#" },
            { text: "Link 3", href: "#" },
        ],
    },
    {
        heading: "Heading Link 2",
        links: [
            { text: "Link 1", href: "#" },
            { text: "Link 2", href: "#" },
            { text: "Link 3", href: "#" },
        ],
    },
    {
        heading: "Heading Link 3",
        links: [
            { text: "Link 1", href: "#" },
            { text: "Link 2", href: "#" },
            { text: "Link 3", href: "#" },
        ],
    },
    {
        heading: "Heading Link 4",
        links: [
            { text: "Link 1", href: "#" },
            { text: "Link 2", href: "#" },
            { text: "Link 3", href: "#" },
        ],
    },
    {
        heading: "Heading Link 5",
        links: [
            { text: "Link 1", href: "#" },
            { text: "Link 2", href: "#" },
            { text: "Link 3", href: "#" },
        ],
    },
]);
</script>

<template>
    <footer class="bg-neutral-100">
        <div class="container py-12">
            <div class="flex justify-between px-12">
                <ApplicationLogo
                    class="h-16 w-auto fill-current text-gray-500"
                />
                <div class="flex gap-12">
                    <div v-for="(section, index) in sections" :key="index">
                        <p class="text-neutral-10 mb-2 font-bold text-lg">
                            {{ section.heading }}
                        </p>
                        <div class="flex flex-col gap-1">
                            <a
                                v-for="(link, linkIndex) in section.links"
                                :key="linkIndex"
                                :href="link.href"
                                class="text-neutral-30 hover:text-neutral-50"
                            >
                                {{ link.text }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <p class="text-neutral-90 text-center text-lg">
                &copy; {{ new Date().getFullYear() }} Phatify
            </p> -->
        </div>
    </footer>
</template>
