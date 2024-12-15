<script setup lang="ts">
const props = defineProps({
    submission: { type: Object, required: false },
    showSubmissionForm: { type: Boolean, required: false },
    handleSubmissionClick: Function,
});
</script>

<template>
    <div
        v-if="
            submission &&
            !showSubmissionForm &&
            props.submission?.user_course_submissions == null
        "
        class="bg-neutral-10 p-6 rounded-xl"
    >
        <div class="flex gap-2 flex-col mb-4">
            <h1 class="text-5xl font-bold leading-[3.5rem]">Submission</h1>
            <p class="text-neutral-90 text-lg">
                Selamat, Anda Telah Berhasil Sampai di Tahap Ini!
            </p>
            <p class="text-neutral-90 text-lg">
                Kami sangat mengapresiasi usaha dan dedikasi Anda dalam
                mengikuti setiap langkah hingga saat ini. Sekarang, Anda berada
                di titik yang sangat penting dalam proses ini. Sebelum
                melanjutkan pengumpulan tugas Anda, pastikan Anda telah memahami
                dengan jelas Aturan Submission, Petunjuk Submission, serta Soal
                Submission yang telah disediakan.
            </p>
            <p class="text-neutral-90 text-lg">
                Proses pengumpulan tugas ini dirancang untuk menguji pemahaman
                dan keterampilan Anda dalam mengaplikasikan materi yang telah
                dipelajari. Kami berharap Anda dapat menunjukkan hasil terbaik
                dalam setiap tugas yang diserahkan.
            </p>
            <p class="text-neutral-90 text-lg">
                Jangan lupa untuk memeriksa setiap detail dengan teliti dan
                pastikan bahwa Anda mengirimkan pekerjaan yang sesuai dengan
                instruksi. Pengumpulan yang berhasil dan tepat waktu akan
                membantu Anda mencapai hasil yang maksimal.
            </p>
            <p class="text-neutral-90 text-lg">
                Semoga sukses dalam penyelesaian tugas, dan kami berharap Anda
                menikmati proses ini!
            </p>
        </div>
        <div class="flex flex-col gap-2 mb-4">
            <h1 class="text-4xl font-bold">Aturan Submission</h1>
            <p class="text-neutral-90 text-lg">
                Berikut adalah aturan yang harus Anda ikuti dalam proses
                submission:
            </p>
            <ol class="list-decimal pl-6 text-neutral-90">
                <li class="text-neutral-90 font-bold text-2xl-plus">
                    Batas Waktu
                    <span class="block text-lg font-normal text-neutral-90"
                        >Semua submission harus diterima paling lambat [Tanggal
                        & Jam]. Pengiriman yang terlambat tidak akan
                        diproses.</span
                    >
                </li>
                <li class="text-neutral-90 font-bold text-2xl-plus">
                    Format dan Ukuran File
                    <span class="block text-lg font-normal text-neutral-90"
                        >Pastikan file yang Anda kirimkan dalam format yang
                        sesuai. Diperbolehkan untuk mengirimkan dalam format
                        file kompres (.zip) dengan maksimal ukuran adalah
                        100mb.</span
                    >
                </li>
                <li class="text-neutral-90 font-bold text-2xl-plus">
                    Nama File
                    <span class="block text-lg font-normal text-neutral-90"
                        >Harap beri nama file Anda dengan format
                        1012341-nama.zip</span
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
        v-if="
            submission &&
            !showSubmissionForm &&
            props.submission?.user_course_submissions == null
        "
        class="bg-neutral-10 p-6 rounded-xl mt-12"
    >
        <p class="text-neutral-90 text-lg mb-4">Apakah anda sudah siap?</p>
        <button
            @click="handleSubmissionClick"
            type="button"
            class="w-full py-3 text-2xl text-neutral-20 bg-primary border-b-4 rounded-xl border-primary-hover"
        >
            Mulai Submission
        </button>
    </div>
</template>
