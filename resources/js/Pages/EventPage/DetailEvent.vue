<script setup>
// filepath: /d:/website/pathify/resources/js/Pages/EventPage/DetailEvent.vue
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    event: {
        type: Object,
        required: true,
    },
    isJoined: {
        type: Boolean,
        required: true,
    },
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

// check if event is finished
const isEventFinished = computed(() => {
    const now = new Date();
    const endDate = new Date(props.event.end_date);
    return endDate < now;
});

//  check if registration is closed
const isRegistrationClosed = computed(() => {
    const now = new Date();
    const registrationEndDate = new Date(props.event.registration_end_date);
    return registrationEndDate < now;
});
</script>

<template>
    <Head title="Detail Event" />

    <AuthenticatedLayout>
        <div class="bg-neutral-30 pb-12 pt-24">
            <div class="container">
                <img
                    :src="props.event.thumbnail"
                    class="h-[18.75rem] w-auto object-contain rounded-[2.25rem] mb-3 mx-auto"
                    alt="Event Thumbnail"
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
                            <table>
                                <tr
                                    v-for="(value, key) in props.event.rundown"
                                    :key="key"
                                >
                                    <td class="text-neutral-90">
                                        {{ value[0] }} - {{ value[1] }}
                                    </td>
                                    <td class="text-neutral-90 ps-6">
                                        {{ value[2] }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- Pertanyaan -->
                        <div>
                            <h1
                                class="text-3xl lg:text-[2.3125rem] font-bold text-neutral-90 mb-3"
                            >
                                Pertanyaan
                            </h1>
                            <ol class="text-neutral-90">
                                <li
                                    v-for="(faq, index) in props.event.faqs"
                                    :key="index"
                                    class="mb-2 text-neutral-90"
                                >
                                    <p class="font-semibold text-neutral-90">
                                        {{ index + 1 }}. {{ faq.question }}
                                    </p>
                                    <ul class="ml-8 list-disc text-neutral-90">
                                        <li class="text-neutral-90">
                                            Jawab: {{ faq.answer }}
                                        </li>
                                    </ul>
                                </li>
                            </ol>
                        </div>
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
                                :class="
                                    props.event.is_online == 0 ? 'mb-6' : ''
                                "
                            >
                                <div
                                    class="text-neutral-90"
                                    v-html="formattedDateTime"
                                ></div>
                                <p
                                    v-if="props.event.is_online == 0"
                                    class="text-neutral-90"
                                >
                                    Pertemuan diadakan secara Offline dengan
                                    lokasi
                                </p>
                                <div v-else>
                                    <p class="text-neutral-90">
                                        Pertemuan diadakan secara Online melalui
                                        kanal
                                        <span
                                            class="font-bold text-neutral-90"
                                            >{{ props.event.platform }}</span
                                        >
                                    </p>
                                    <a
                                        target="_blank"
                                        class="text-primary"
                                        :href="props.event.link"
                                    >
                                        <span class="text-neutral-90"
                                            >Link:</span
                                        >
                                        {{ props.event.link }}
                                    </a>
                                </div>
                            </div>
                            <p
                                v-if="props.event.is_online == 0"
                                class="text-neutral-90 font-bold"
                            >
                                {{ props.event.location_name }}
                            </p>
                            <p class="text-neutral-90">
                                {{ props.event.location_address }}
                            </p>
                        </div>
                        <div v-if="props.isJoined">
                            <h1
                                class="text-2xl lg:text-[1.75rem] font-bold text-neutral-100"
                            >
                                Kehadiran
                            </h1>
                            <div v-if="isEventFinished">
                                <p
                                    class="bg-[#dcf9f9] text-[#155724] border border-[#11c5c6] p-4 rounded-xl"
                                >
                                    Event ini telah selesai. Terima kasih telah
                                    berpartisipasi.
                                </p>
                            </div>

                            <div v-else>
                                <p
                                    class="p-4 rounded-xl bg-[#DAEAFA] text-[#234B73] border border-[#C1DCF7]"
                                >
                                    Anda telah terdaftar dalam event ini.
                                    Silahkan cek email Anda untuk informasi
                                    lebih lanjut.
                                </p>
                                <button
                                    class="bg-primary text-neutral-20 py-3 px-8 text-[1.3125rem] mt-3 border-b-4 border-primary-hover leading-[1.575rem] rounded-xl"
                                >
                                    Batalkan
                                </button>
                            </div>
                        </div>
                        <div v-else>
                            <div v-if="isRegistrationClosed">
                                <h1
                                    class="text-2xl lg:text-[1.75rem] font-bold text-neutral-100"
                                >
                                    Ikuti Event
                                </h1>
                                <p
                                    class="p-4 rounded-lg bg-[#f8d7da] text-[#721c24] border border-[#f5c6cb]"
                                >
                                    Pendaftaran Tutup
                                </p>
                            </div>

                            <div v-else>
                                <h1
                                    class="text-2xl lg:text-[1.75rem] font-bold text-neutral-100"
                                >
                                    Ikuti Event
                                </h1>
                                <p class="text-neutral-90">
                                    Ayo daftar event ini agar anda tidak
                                    ketinggalan informasi
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
        </div>
    </AuthenticatedLayout>
</template>
