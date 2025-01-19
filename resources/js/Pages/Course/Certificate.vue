<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import FinishLayout from "@/Layouts/FinishLayout.vue";

// Props declaration
const props = defineProps({
    course: Object, // Expecting a course object with necessary attributes
});
</script>

<template>
    <!-- Page head for setting the title -->
    <Head title="Kelas Selesai" />

    <!-- Layout wrapper -->
    <FinishLayout>
        <!-- Background section -->
        <div class="bg-neutral-20 pt-32 pb-12">
            <!-- Content container -->
            <div
                class="container flex flex-col items-center justify-center gap-6 xl:gap-12 mb-6"
            >
                <!-- PDF preview section -->
                <iframe
                    :src="
                        route('courses.show.certificate.download', {
                            course: props.course.slug,
                        })
                    "
                    class="w-3/4 h-[42rem] mb-6 border-2 border-neutral-40 rounded-xl shadow-lg"
                    title="Sertifikat"
                    allowfullscreen
                >
                </iframe>

                <!-- Download button -->
                <a
                    :href="
                        route('courses.show.certificate.download', {
                            course: props.course.slug,
                        })
                    "
                    target="_blank"
                    class="bg-primary hover:bg-primary-hover transition-all duration-200 ease-in-out w-full max-w-xs text-lg md:text-xl lg:text-xl-plus py-3 rounded-xl text-neutral-20 border-b-4 border-primary-hover text-center shadow-md"
                >
                    Unduh Sertifikat
                </a>
            </div>
        </div>
    </FinishLayout>
</template>
