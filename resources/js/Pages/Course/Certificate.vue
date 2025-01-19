<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import FinishLayout from "@/Layouts/FinishLayout.vue";
</script>

<template>
    <Head title="Kelas Selesai" />
    <FinishLayout>
        <div class="bg-neutral-20 pt-32 pb-12">
            <div
                class="container flex flex-col items-center justify-center gap-6 xl:gap-12 mb-6"
            >
                <a
                    href="#"
                    download="sertifikat.pdf"
                    type="submit"
                    class="bg-primary hover:bg-primary-hover transition-all duration-200 ease-in-out w-full max-w-96 text-lg md:text-xl lg:text-xl-plus py-3 rounded-xl text-neutral-20 border-b-4 border-primary-hover text-center"
                >
                    Unduh Sertifikat
                </a>
            </div>
        </div>
    </FinishLayout>
</template>
