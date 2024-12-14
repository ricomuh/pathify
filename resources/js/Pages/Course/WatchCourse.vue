<script setup lang="ts">
import SecondaryLayout from "@/Layouts/SecondaryLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/components/ui/accordion";
import { computed } from "vue";

const props = defineProps({
    course: Object,
    content: Object,
    order: Number,
    submission: Object,
    nextEpisode: String,
    prevEpisode: String,
});

// default value for accordion
// default value for accordion
const defaultAccordionValue = computed(() => {
    const group = props.course.groups.find((group) => {
        return group.contents.some((content) => content.order === props.order);
    });

    return group ? group.id : null;
});

// current order
const currentOrder = computed(() => {
    return parseInt(route().params.order);
});

// order of previous and next content
const previousContentUrl = computed(() => {
    if (props.order > 1) {
        return `/courses/${props.course.slug}/watch/${props.order - 1}`;
        defaultAccordionValue.value = props.course.groups[props.order - 1].id;
    }
    return null;
});

const nextContentUrl = computed(() => {
    if (props.order < props.course.groups.length) {
        return `/courses/${props.course.slug}/watch/${props.order + 1}`;
        defaultAccordionValue.value = props.course.groups[props.order + 1].id;
    }
    return null;
});

// format date comment
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffSeconds = Math.floor(diffTime / 1000);
    const diffMinutes = Math.floor(diffSeconds / 60);
    const diffHours = Math.floor(diffMinutes / 60);
    const diffDays = Math.floor(diffHours / 24);

    if (diffDays > 0) {
        return `${diffDays} hari yang lalu`;
    } else if (diffHours > 0) {
        return `${diffHours} jam yang lalu`;
    } else if (diffMinutes > 0) {
        return `${diffMinutes} menit yang lalu`;
    } else {
        return `${diffSeconds} detik yang lalu`;
    }
};
</script>

<template>
    <Head title="Detail Materi" />

    <SecondaryLayout>
        <div class="bg-neutral-30 relative">
            <div class="container mx-auto xl:px-0">
                <!-- Container utama -->
                <div
                    class="grid grid-cols-4 gap-6 h-[calc(100vh-170px)] overflow-hidden"
                >
                    <!-- Sidebar -->
                    <div class="col-span-1 py-6 overflow-y-auto">
                        <Link
                            href="/dashboard"
                            class="flex gap-3 items-center p-3 mb-6"
                        >
                            <img src="/media/icons/arrow.svg" alt="" />
                            <p>Dashboard</p>
                        </Link>
                        <Accordion
                            type="single"
                            class="w-full flex flex-col gap-2"
                            collapsible
                            :default-value="defaultAccordionValue"
                        >
                            <AccordionItem
                                class="bg-neutral-10 cursor-pointer border border-neutral-40 rounded-xl"
                                v-for="(value, index) in props.course.groups"
                                :key="index"
                                :value="value.id"
                            >
                                <AccordionTrigger
                                    class="text-neutral-90 text-[1.3125rem] p-4 text-start bg-none"
                                >
                                    {{ value.title }}
                                </AccordionTrigger>
                                <AccordionContent class="bg-neutral-10 p-0">
                                    <div class="flex flex-col gap-3 px-4 pb-3">
                                        <Link
                                            :href="`/courses/${props.course.slug}/watch/${item?.order}`"
                                            v-for="(
                                                item, key
                                            ) in value?.contents"
                                            :key="key"
                                            class="text-base flex gap-3 items-center px-3 py-2 rounded-xl"
                                            :class="{
                                                'bg-primary-border':
                                                    item.order === currentOrder,
                                                '': item.order !== currentOrder,
                                            }"
                                        >
                                            <img
                                                v-if="
                                                    item.order === currentOrder
                                                "
                                                src="/media/icons/uncheck.svg"
                                                alt=""
                                                class="w-[1.125rem]"
                                            />
                                            <img
                                                v-else-if="
                                                    item.order < currentOrder
                                                "
                                                src="/media/icons/checked.svg"
                                                alt=""
                                                class="w-[1.125rem]"
                                            />
                                            <img
                                                v-else
                                                src="/media/icons/section.svg"
                                                alt=""
                                                class="w-[1.125rem]"
                                            />
                                            <p
                                                :class="
                                                    item.order > currentOrder
                                                        ? 'text-neutral-70'
                                                        : 'text-neutral-100'
                                                "
                                            >
                                                {{ item.title }}
                                            </p>
                                        </Link>
                                    </div>
                                </AccordionContent>
                            </AccordionItem>
                            <AccordionItem
                                class="bg-neutral-10 cursor-pointer border border-neutral-40 rounded-xl"
                                value="submission"
                            >
                                <AccordionTrigger
                                    class="text-neutral-90 text-[1.3125rem] p-4 text-start bg-none"
                                >
                                    Submission
                                </AccordionTrigger>
                                <AccordionContent class="bg-neutral-10 p-0">
                                    <div class="flex flex-col gap-3 px-4 pb-3">
                                        <Link
                                            :href="`/courses/${props.course.slug}/submission`"
                                            class="text-base flex gap-3 items-center px-3 py-2 rounded-xl"
                                        >
                                            <img
                                                src="/media/icons/section.svg"
                                                alt=""
                                                class="w-[1.125rem]"
                                            />
                                            <p class="text-neutral-100">
                                                Overview
                                            </p>
                                        </Link>
                                    </div>
                                </AccordionContent>
                            </AccordionItem>
                        </Accordion>
                    </div>
                    <div class="col-span-3 bg-neutral-20 p-6 overflow-y-auto">
                        <!-- Content -->
                        <div
                            v-if="!submission"
                            class="bg-neutral-10 p-6 rounded-xl"
                        >
                            <h1
                                class="text-5xl font-bold mb-3 leading-[3.5rem]"
                            >
                                {{ content?.title }}
                            </h1>
                            <div
                                v-html="content?.body"
                                class="course-content"
                            ></div>
                        </div>
                        <!-- Submission -->
                        <div v-else class="bg-neutral-10 p-6 rounded-xl">
                            <div class="flex gap-2 flex-col mb-4">
                                <h1 class="text-5xl font-bold leading-[3.5rem]">
                                    Submission
                                </h1>
                                <p class="text-neutral-90 text-lg">
                                    Selamat, Anda Telah Berhasil Sampai di Tahap
                                    Ini!
                                </p>
                                <p class="text-neutral-90 text-lg">
                                    Kami sangat mengapresiasi usaha dan dedikasi
                                    Anda dalam mengikuti setiap langkah hingga
                                    saat ini. Sekarang, Anda berada di titik
                                    yang sangat penting dalam proses ini.
                                    Sebelum melanjutkan pengumpulan tugas Anda,
                                    pastikan Anda telah memahami dengan jelas
                                    Aturan Submission, Petunjuk Submission,
                                    serta Soal Submission yang telah disediakan.
                                </p>
                                <p class="text-neutral-90 text-lg">
                                    Proses pengumpulan tugas ini dirancang untuk
                                    menguji pemahaman dan keterampilan Anda
                                    dalam mengaplikasikan materi yang telah
                                    dipelajari. Kami berharap Anda dapat
                                    menunjukkan hasil terbaik dalam setiap tugas
                                    yang diserahkan.
                                </p>
                                <p class="text-neutral-90 text-lg">
                                    Jangan lupa untuk memeriksa setiap detail
                                    dengan teliti dan pastikan bahwa Anda
                                    mengirimkan pekerjaan yang sesuai dengan
                                    instruksi. Pengumpulan yang berhasil dan
                                    tepat waktu akan membantu Anda mencapai
                                    hasil yang maksimal.
                                </p>
                                <p class="text-neutral-90 text-lg">
                                    Semoga sukses dalam penyelesaian tugas, dan
                                    kami berharap Anda menikmati proses ini!
                                </p>
                            </div>
                            <div class="flex flex-col gap-2 mb-4">
                                <h1 class="text-4xl font-bold">
                                    Aturan Submission
                                </h1>
                                <p class="text-neutral-90 text-lg">
                                    Berikut adalah aturan yang harus Anda ikuti
                                    dalam proses submission:
                                </p>
                                <ol class="list-decimal pl-6 text-neutral-90">
                                    <li
                                        class="text-neutral-90 font-bold text-[1.75rem]"
                                    >
                                        Batas Waktu
                                        <span
                                            class="block text-lg font-normal text-neutral-90"
                                            >Semua submission harus diterima
                                            paling lambat [Tanggal & Jam].
                                            Pengiriman yang terlambat tidak akan
                                            diproses.</span
                                        >
                                    </li>
                                    <li
                                        class="text-neutral-90 font-bold text-[1.75rem]"
                                    >
                                        Format dan Ukuran File
                                        <span
                                            class="block text-lg font-normal text-neutral-90"
                                            >Pastikan file yang Anda kirimkan
                                            dalam format yang sesuai.
                                            Diperbolehkan untuk mengirimkan
                                            dalam format file kompres (.zip)
                                            dengan maksimal ukuran adalah
                                            100mb.</span
                                        >
                                    </li>
                                    <li
                                        class="text-neutral-90 font-bold text-[1.75rem]"
                                    >
                                        Nama File
                                        <span
                                            class="block text-lg font-normal text-neutral-90"
                                            >Harap beri nama file Anda dengan
                                            format 1012341-nama.zip</span
                                        >
                                    </li>
                                </ol>
                            </div>
                            <div class="flex gap-2 flex-col">
                                <h1 class="text-4xl font-bold">Kesimpulan</h1>
                                <div
                                    v-html="submission?.body"
                                    class="course-content text-neutral-90"
                                ></div>
                            </div>
                        </div>

                        <!-- Ready to Submission -->
                        <div
                            v-if="submission"
                            class="bg-neutral-10 p-6 rounded-xl mt-12"
                        >
                            <p class="text-neutral-90 text-lg mb-4">
                                Apakah anda sudah siap?
                            </p>
                            <button
                                type="button"
                                class="w-full py-3 text-2xl text-neutral-20 bg-primary border-b-4 rounded-xl border-primary-hover"
                            >
                                Mulai Submission
                            </button>
                        </div>
                        <!-- Discussion -->
                        <div
                            v-if="!submission"
                            class="my-12 border-t-4 border-neutral-40"
                        ></div>
                        <div v-if="!submission" class="p-6 rounded-xl">
                            <div class="flex flex-col gap-6">
                                <div class="flex justify-between items-center">
                                    <h1 class="text-[1.75rem] font-bold">
                                        Diskusi Terdahulu
                                    </h1>
                                    <div
                                        class="flex gap-1 items-center py-3 px-4 rounded-xl border-2 border-neutral-40 bg-neutral-10 w-96"
                                    >
                                        <img
                                            src="/media/icons/search.svg"
                                            alt=""
                                        />
                                        <input
                                            type="search"
                                            v-model="search"
                                            class="outline-none !h-max py-0 px-0 border-0 bg-neutral-10 shadow-none !ring-0 w-full"
                                            placeholder="Cari Pertanyaan"
                                        />
                                    </div>
                                </div>
                                <!-- Form -->
                                <form
                                    class="p-6 rounded-xl border-2 border-neutral-40 bg-neutral-10"
                                >
                                    <div class="mb-3">
                                        <label
                                            for="title"
                                            class="text-neutral-90 block mb-1"
                                            >Judul Pertanyaan</label
                                        >
                                        <input
                                            type="text"
                                            id="title"
                                            name="title"
                                            class="border-2 rounded-xl w-full py-3 px-6 border-neutral-40"
                                            placeholder="Masukkan judul pertanyaan"
                                        />
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="question"
                                            class="text-neutral-90 block mb-1"
                                        >
                                            Pertanyaan</label
                                        >
                                        <textarea
                                            type="text"
                                            rows="4"
                                            id="question"
                                            name="question"
                                            class="border-2 rounded-xl w-full py-3 px-6 border-neutral-40"
                                            placeholder="Masukkan pertanyaan"
                                        ></textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <button
                                            type="submit"
                                            class="text-neutral-20 rounded-xl border-b-4 bg-primary border-primary-hover py-2 px-16"
                                        >
                                            Tanyakan
                                        </button>
                                    </div>
                                </form>
                                <!-- Discuss content -->
                                <div
                                    v-for="(value, key) in content?.comments"
                                    :key="key"
                                    class="p-6 rounded-xl bg-neutral-10 flex flex-col gap-6"
                                >
                                    <div class="flex gap-3 items-center">
                                        <img
                                            :src="value.user.profile_picture"
                                            class="size-11 rounded-full object-cover"
                                            alt=""
                                        />
                                        <div class="flex gap-2.5 items-center">
                                            <p class="text-lg font-bold">
                                                {{ value.user.fullname }}
                                            </p>
                                            <img
                                                src="/media/icons/dot.svg"
                                                alt=""
                                            />
                                            <p class="text-neutral-80">
                                                {{
                                                    formatDate(value.created_at)
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="text-2xl font-bold">
                                            {{ value.title }}
                                        </h1>
                                        <p class="text-neutral-90 text-lg">
                                            {{ value.body }}
                                        </p>
                                    </div>
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <div class="flex gap-6 items-center">
                                            <!-- Total Discuss -->
                                            <button
                                                type="button"
                                                class="flex gap-3 items-center"
                                            >
                                                <img
                                                    src="/media/icons/discuss.svg"
                                                    alt=""
                                                    class="size-6"
                                                />
                                                <p
                                                    class="text-neutral-80 text-lg"
                                                >
                                                    {{
                                                        value.children?.length >
                                                        0
                                                            ? value.children
                                                                  .length
                                                            : 0
                                                    }}
                                                    Diskusi
                                                </p>
                                            </button>
                                            <!-- Upvote -->
                                            <button
                                                class="flex gap-3 items-center"
                                                type="button"
                                            >
                                                <img
                                                    src="/media/icons/chevron-up.svg"
                                                    alt=""
                                                    class="size-6"
                                                />
                                                <p
                                                    class="text-neutral-80 text-lg"
                                                >
                                                    {{ value.upvotes_count }}
                                                </p>
                                            </button>
                                        </div>
                                        <button type="button">
                                            <img
                                                src="/media/icons/report.svg"
                                                alt=""
                                                class="size-6"
                                            />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Next Prev -->
            <div
                class="bg-neutral-10 px-6 py-5 border-t flex justify-between items-center rounded-xl fixed w-full"
            >
                <Link
                    :href="prevEpisode"
                    class="flex gap-2 items-center p-3 border-2 boder-neutral-50 !border-b-[6px] hover:bg-neutral-20 rounded-xl"
                >
                    <img src="/media/icons/arrow-left.svg" alt="" />
                    <p class="text-neutral-90">Materi Sebelumnya</p>
                </Link>
                <Link
                    :href="nextEpisode"
                    class="flex gap-2 items-center p-3 border-2 boder-neutral-50 !border-b-[6px] hover:bg-neutral-20 rounded-xl"
                >
                    <p class="text-neutral-90">Materi Selanjutnya</p>
                    <img
                        src="/media/icons/arrow-left.svg"
                        class="rotate-180"
                        alt=""
                    />
                </Link>
            </div>
        </div>
    </SecondaryLayout>
</template>

<style scoped>
::v-deep .course-content ul {
    @apply list-disc list-inside;
}
::v-deep .course-content ul li,
::v-deep .course-content ol li,
::v-deep .course-content p,
::v-deep .course-content h1,
::v-deep .course-content h2,
::v-deep .course-content h3,
::v-deep .course-content h4,
::v-deep .course-content h5,
::v-deep .course-content h6 {
    @apply text-neutral-90;
}
::v-deep .course-content ol li {
    @apply list-decimal list-inside;
}

::v-deep .course-content img {
    @apply mx-auto my-6;
    max-width: 100%;
}

::v-deep .course-content table {
    @apply w-full;
}

::v-deep .course-content table tr {
    @apply border-b border-neutral-40;
}

::v-deep .course-content table tr:last-child {
    @apply border-b-0;
}

::v-deep .course-content table td {
    @apply py-3;
}

::v-deep .course-content table th {
    @apply py-3;
}

::v-deep .course-content table th,
::v-deep .course-content table td {
    @apply text-neutral-90;
}

::v-deep .course-content table th {
    @apply font-bold;
}

::v-deep .course-content table td:first-child {
    @apply pr-6;
}

::v-deep .course-content table td:last-child {
    @apply pl-6;
}

::v-deep .course-content blockquote {
    @apply bg-neutral-10 border-l-4 border-primary-surface p-4;
}

::v-deep .course-content blockquote p {
    @apply text-neutral-90;
}

::v-deep .course-content a {
    @apply text-primary;
}

::v-deep .course-content a:hover {
    @apply underline;
}

::v-deep .course-content h1 {
    @apply text-4xl font-bold mb-1;
}

::v-deep .course-content h2 {
    @apply text-3xl font-bold mb-1;
}

::v-deep .course-content h3 {
    @apply text-2xl font-bold mb-1;
}

::v-deep .course-content h4 {
    @apply text-xl font-bold mb-1;
}

::v-deep .course-content h5 {
    @apply text-lg font-bold mb-1;
}

::v-deep .course-content h6 {
    @apply text-base font-bold mb-1;
}

::v-deep .course-content p {
    @apply mb-4;
}

::v-deep .course-content ul {
    @apply list-disc list-inside;
}

::v-deep .course-content ol {
    @apply list-decimal list-inside;
}

::v-deep .course-content ol li {
    @apply mb-2;
}

::v-deep .course-content ul li {
    @apply mb-2;
}

::v-deep .course-content pre {
    @apply bg-neutral-10 p-4 rounded-xl overflow-x-auto;
}

::v-deep .course-content code {
    @apply bg-neutral-10 p-1 rounded-md;
}

::v-deep .course-content iframe {
    @apply w-full mb-4;
    height: 500px;
}
</style>
