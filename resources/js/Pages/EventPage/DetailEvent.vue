<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    event: Object,
});
// registration end date
const formattedDate = computed(() => {
    const date = new Date(props.event.registration_end_date);
    return new Intl.DateTimeFormat("id-ID", {
        day: "2-digit",
        month: "long",
        year: "numeric",
    }).format(date);
});

// format date to human readable
const formattedDateTime = computed(() => {
    const startDate = new Date(props.event.start_date);
    const endDate = new Date(props.event.end_date);

    const dayName = new Intl.DateTimeFormat("id-ID", {
        weekday: "long",
    }).format(startDate);
    const date = new Intl.DateTimeFormat("id-ID", {
        day: "2-digit",
        month: "long",
        year: "numeric",
    }).format(startDate);
    const startTime = new Intl.DateTimeFormat("id-ID", {
        hour: "2-digit",
        minute: "2-digit",
        hour12: false,
    }).format(startDate);
    const endTime = new Intl.DateTimeFormat("id-ID", {
        hour: "2-digit",
        minute: "2-digit",
        hour12: false,
    }).format(endDate);

    return `${dayName}, ${date}<br>Pukul ${startTime} WIB sampai ${endTime} WIB`;
});
</script>

<template>
    <Head title="Detail Event" />

    <AuthenticatedLayout>
        <div class="bg-neutral-30 py-12">
            <div class="container">
                <img
                    :src="props.event.thumbnail"
                    class="h-[18.75rem] w-auto object-contain rounded-[2.25rem] mb-3 mx-auto"
                    alt=""
                />
                <h1
                    class="text-3xl lg:text-[2.3125rem] font-bold text-neutral-100 xl:w-3/5 lg:leading-[2.775rem] text-center mx-auto"
                >
                    {{ props.event.title }}
                </h1>
            </div>
        </div>
        <div class="bg-neutral-10">
            <div
                class="py-12 grid lg:grid-cols-2 xl:grid-cols-5 gap-6 xl:gap-12 container"
            >
                <div class="lg:col-span-1 xl:col-span-3">
                    <div class="flex flex-col gap-6">
                        <!-- About -->
                        <div>
                            <h1
                                class="text-3xl lg:text-[2.3125rem] font-bold text-neutral-90 mb-3"
                            >
                                Tentang Event ini
                            </h1>
                            <div
                                class="text-neutral-90"
                                v-html="props.event.body"
                            ></div>
                        </div>
                        <!-- Rundown -->
                        <div>
                            <h1
                                class="text-3xl lg:text-[2.3125rem] font-bold text-neutral-90 mb-3"
                            >
                                Rundown
                            </h1>
                            <ul>
                                <li
                                    class="text-neutral-90"
                                    v-for="(value, key) in props.event.rundown"
                                    :key="key"
                                >
                                    {{ value[0] }} - {{ value[1] }}
                                    <span class="ps-4 text-neutral-90">{{
                                        value[2]
                                    }}</span>
                                </li>
                            </ul>
                        </div>
                        <!-- Pertanyaan -->
                        <h1
                            class="text-3xl lg:text-[2.3125rem] font-bold text-neutral-90 mb-3"
                        >
                            Pertanyaan
                        </h1>
                    </div>
                </div>
                <div class="lg:col-span-1 xl:col-span-2">
                    <div class="flex flex-col gap-6">
                        <div>
                            <p class="text-neutral-70">Sisa Kuota</p>
                            <h1
                                class="text-neutral-90 text-[1.3125rem] font-bold mb-3"
                            >
                                {{ props.event.seats_left }} Kursi
                            </h1>
                            <p class="text-neutral-70">
                                Pendaftaran Dibuka Hingga
                            </p>
                            <h1
                                class="text-neutral-90 text-[1.3125rem] font-bold"
                            >
                                {{ formattedDate }}
                            </h1>
                        </div>
                        <div>
                            <h1
                                class="text-2xl lg:text-[1.75rem] font-bold text-neutral-100"
                            >
                                Waktu dan Tempat
                            </h1>
                            <div
                                class="text-neutral-90 mb-6"
                                v-html="formattedDateTime"
                            ></div>
                            <div
                                class="text-neutral-90 font-bold"
                                v-html="props.event.location"
                            ></div>
                        </div>
                        <div>
                            <h1
                                class="text-2xl lg:text-[1.75rem] font-bold text-neutral-100"
                            >
                                Ikuti Event
                            </h1>
                            <p class="text-neutral-90">
                                Ayo daftar event ini agar anda tidak ketinggalan
                                informasi
                            </p>
                            <button
                                class="bg-primary text-neutral-20 py-3 px-8 text-[1.3125rem] mt-3 border-b-4 border-primary-hover leading-[1.575rem] rounded-xl"
                            >
                                Ikuti Event
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
