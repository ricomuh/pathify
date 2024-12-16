<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import BoxEvent from "@/Components/BoxEvent.vue";
import ContentBottom from "@/Components/ContentBottom.vue";
import { watch } from "vue";

const props = defineProps({
    events: {
        type: Object,
        required: true,
    },
});

// search
const form = useForm({
    search: new URLSearchParams(window.location.search).get("search") || "",
});

let searchTimeout = null;
const handleSearch = () => {
    form.get(route("events.index"), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        data: { search: form.search },
    });
};

watch(
    () => form.search,
    (newSearch) => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            handleSearch();
        }, 1000);
    }
);

const goToPage = (url) => {
    if (url) {
        router.get(url, {}, { preserveState: true, preserveScroll: true });
    }
};
</script>

<template>
    <Head title="Event" />

    <AuthenticatedLayout>
        <div class="container pt-12">
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
                <!-- Search Form -->
                <div class="w-full max-w-md">
                    <div
                        class="flex gap-1 items-center py-3 px-4 rounded-xl border-2 border-neutral-40 bg-neutral-10 w-96"
                    >
                        <img src="media/icons/search.svg" alt="" />
                        <input
                            type="search"
                            v-model="form.search"
                            class="outline-none !h-max py-0 px-0 border-0 bg-neutral-10 shadow-none !ring-0 w-full"
                            placeholder="Cari Event"
                        />
                    </div>
                </div>
            </div>

            <!-- All Events -->
            <div class="pb-12">
                <h1
                    class="text-3xl md:text-4xl-plus font-bold text-neutral-100 mb-6"
                >
                    Semua Event
                </h1>
                <div
                    v-if="props.events.data.length > 0"
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
                <!-- Empty State -->
                <div
                    v-else
                    class="text-center py-20 flex flex-col items-center gap-2"
                >
                    <img
                        src="/media/illustrations/search-empty.svg"
                        class="h-60"
                        alt="Empty State"
                    />
                    <p class="text-xl text-neutral-80">
                        Event yang Anda cari tidak ada, silahkan berikan kata
                        kunci lain
                    </p>
                </div>
            </div>

            <!-- Pagination -->
            <div
                v-if="props.events.data.length > 0"
                class="flex justify-center items-center gap-2 mb-12"
            >
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

<style scoped>
/* Add any custom styles here */
</style>
