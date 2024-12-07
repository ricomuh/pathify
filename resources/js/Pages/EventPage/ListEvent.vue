<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import BoxEvent from "@/Components/BoxEvent.vue";
import ContentBottom from "@/Components/ContentBottom.vue";
import { ref } from "vue";

const search = ref("");

const events = [
    {
        id: 1,
        category: "Seminar",
        title: "Beginner Developer Fest 2024: Event yang menyenangkan dan menegangkan",
        slug: "beginner-developer-fest-2024",
        image: "media/illustrations/event-placeholder.png",
        seatsLeft: 150,
        daysLeft: 4,
    },
    {
        id: 2,
        category: "Workshop",
        title: "Advanced JavaScript Workshop: Mastering ES6+",
        slug: "advanced-javascript-workshop",
        image: "media/illustrations/event-placeholder.png",
        seatsLeft: 50,
        daysLeft: 2,
    },
    {
        id: 3,
        category: "Conference",
        title: "Tech Conference 2024: Innovations in AI",
        slug: "tech-conference-2024",
        image: "media/illustrations/event-placeholder.png",
        seatsLeft: 0,
        daysLeft: 0,
    },
    {
        id: 4,
        category: "Meetup",
        title: "Vue.js Meetup: Best Practices and Tips",
        slug: "vuejs-meetup",
        image: "media/illustrations/event-placeholder.png",
        seatsLeft: 20,
        daysLeft: 1,
    },
    {
        id: 5,
        category: "Webinar",
        title: "Webinar: Introduction to Machine Learning",
        slug: "webinar-machine-learning",
        image: "media/illustrations/event-placeholder.png",
        seatsLeft: 100,
        daysLeft: 5,
    },
    {
        id: 6,
        category: "Hackathon",
        title: "Hackathon 2024: Code for Good",
        slug: "hackathon-2024",
        image: "media/illustrations/event-placeholder.png",
        seatsLeft: 10,
        daysLeft: 3,
    },
    {
        id: 7,
        category: "Seminar",
        title: "Seminar: Future of Web Development",
        slug: "seminar-future-web-development",
        image: "media/illustrations/event-placeholder.png",
        seatsLeft: 75,
        daysLeft: 7,
    },
    {
        id: 8,
        category: "Workshop",
        title: "Workshop: Building Mobile Apps with Flutter",
        slug: "workshop-flutter",
        image: "media/illustrations/event-placeholder.png",
        seatsLeft: 30,
        daysLeft: 6,
    },
];
</script>

<template>
    <Head title="Event" />

    <AuthenticatedLayout>
        <div class="container">
            <!-- Hero -->
            <div class="flex flex-col items-center justify-center py-12">
                <h1
                    class="text-4xl md:text-5xl font-bold text-neutral-100 -mb-1"
                >
                    Event
                </h1>
                <p class="text-2xl text-neutral-90 mb-6 text-center">
                    Ikuti Event, dapatkan insight, dan jalin networking
                </p>
                <div
                    class="flex gap-1 items-center py-3 px-4 rounded-xl border-2 border-neutral-40 bg-neutral-10 w-96"
                >
                    <img src="media/icons/search.svg" alt="" />
                    <input
                        type="search"
                        v-model="search"
                        class="outline-none !h-max py-0 px-0 border-0 bg-neutral-10 shadow-none !ring-0 w-full"
                        placeholder="Cari Event"
                    />
                </div>
            </div>

            <!-- All Events -->
            <div class="pb-12">
                <h1
                    class="text-3xl md:text-[2.3125rem] font-bold text-neutral-100 mb-6"
                >
                    Semua Event
                </h1>
                <div
                    class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3"
                >
                    <BoxEvent
                        v-for="(value, key) in events"
                        :key="key"
                        :title="value.title"
                        :category="value.category"
                        :slug="value.slug"
                        :seatsLeft="value.seatsLeft"
                        :daysLeft="value.daysLeft"
                    />
                </div>
            </div>

            <!-- Content -->
            <ContentBottom />
        </div>
    </AuthenticatedLayout>
</template>
