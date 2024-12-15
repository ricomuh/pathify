<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head } from "@inertiajs/vue3";
import BoxEvent from "@/Components/BoxEvent.vue";
import { computed } from "vue";

const props = defineProps({
    events: {
        type: Array,
        required: true,
    },
});

// upcoming events
const upcomingEvents = computed(() => {
    const now = new Date();
    return props.events.filter((event) => new Date(event.start_date) > now);
});

// finished events
const finishedEvents = computed(() => {
    const now = new Date();
    return props.events.filter((event) => new Date(event.start_date) < now);
});
</script>

<template>
    <Head title="Event Saya" />

    <UserLayout>
        <div class="container py-12">
            <div class="flex flex-col gap-12">
                <!-- Header -->
                <h1
                    class="font-bold p-6 text-4xl-plus leading-[2.775rem] rounded-xl bg-neutral-10"
                >
                    Event Saya
                </h1>

                <!-- Upcoming Event -->
                <div>
                    <h1 class="font-bold text-4xl-plus leading-[2.775rem] mb-6">
                        Akan datang
                    </h1>
                    <div
                        v-if="upcomingEvents.length === 0"
                        class="flex flex-col items-center gap-6"
                    >
                        <img
                            src="/media/illustrations/empty-state.svg"
                            class="h-60"
                            alt="Empty State"
                        />
                        <p class="text-neutral-90 text-xl-plus text-center">
                            Anda belum tergabung dalam event apapun,
                            <a href="#" class="text-primary font-bold"
                                >klik disini</a
                            >
                            untuk mengikuti event terbaru dari kami
                        </p>
                    </div>
                    <div
                        v-else
                        class="grid md:grid-cols-2 xl:grid-cols-3 gap-3"
                    >
                        <BoxEvent
                            v-for="event in upcomingEvents"
                            :key="event.id"
                            :title="event.title"
                            :category="event.category.name"
                            :slug="event.slug"
                            :seatsLeft="event.seats_left"
                            :daysLeft="event.start_date"
                            :thumbnail="event.thumbnail"
                        />
                    </div>
                </div>

                <!-- Finished Event -->
                <div>
                    <h1 class="font-bold text-4xl-plus leading-[2.775rem] mb-6">
                        Event lampau
                    </h1>
                    <div v-if="finishedEvents.length === 0">
                        <p class="text-neutral-90 text-xl-plus">
                            Anda tidak pernah menghadiri event apapun.
                        </p>
                    </div>
                    <div
                        v-else
                        class="grid md:grid-cols-2 xl:grid-cols-3 gap-3"
                    >
                        <BoxEvent
                            v-for="event in finishedEvents"
                            :key="event.id"
                            :title="event.title"
                            :category="event.category.name"
                            :slug="event.slug"
                            :seatsLeft="event.seats_left"
                            :daysLeft="event.start_date"
                            :thumbnail="event.thumbnail"
                        />
                    </div>
                </div>
            </div>
        </div>
    </UserLayout>
</template>
