<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import BoxEvent from "@/Components/BoxEvent.vue";
import ContentBottom from "@/Components/ContentBottom.vue";
import { ref } from "vue";

const search = ref("");

const props = defineProps({
    events: {
        type: Object,
        required: true,
    },
});

const goToPage = (url) => {
    if (url) {
        router.get(url, {}, { preserveState: true, preserveScroll: true });
    }
};
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
                        v-for="(value, key) in props.events.data"
                        :key="key"
                        :title="value.title"
                        :category="value.category.name"
                        :slug="value.slug"
                        :seatsLeft="value.seats_left"
                        :daysLeft="value.start_date"
                        :thumbnail="value.thumbnail"
                    />
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center items-center gap-2 mb-12">
                <button
                    v-for="(link, index) in props.events.links"
                    :key="index"
                    :disabled="!link.url"
                    @click="goToPage(link.url)"
                    :class="[
                        'px-3 py-1 border rounded',
                        link.active
                            ? 'bg-blue-500 text-white'
                            : 'bg-white text-blue-500 border-blue-500',
                        !link.url && 'opacity-50 cursor-not-allowed',
                    ]"
                >
                    <span v-html="link.label"></span>
                </button>
            </div>

            <!-- Content -->
            <ContentBottom />
        </div>
    </AuthenticatedLayout>
</template>
