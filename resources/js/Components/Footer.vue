<script setup>
import ApplicationLogo from "./ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <footer class="bg-footer bg-cover bg-left bg-no-repeat py-12">
        <div class="container">
            <div class="grid grid-cols-2 justify-between items-start gap-4">
                <div class="col-span-1 flex flex-col gap-3 items-start">
                    <ApplicationLogo
                        class="h-16 w-auto fill-current text-gray-500"
                    />
                    <h1 class="text-white text-xl-plus font-bold">
                        Pathify - Find Your Right Path Here
                    </h1>
                    <p class="text-white">
                        Pathify merupakan platform yang menyediakan layanan
                        kuisioner dan layanan pembelajaran bagi orang yang baru
                        terjun dalam dunia Teknologi. Bersama kami, kita bisa
                        menelusuri dunia teknologi bersama.
                    </p>
                </div>
                <div class="col-span-1 ms-auto">
                    <h1 class="text-neutral-10 text-xl font-bold mb-3">
                        Berkembang bersama kami
                    </h1>
                    <div class="flex flex-col gap-3">
                        <Link href="/questionnaire" class="text-neutral-50"
                            >Kuisioner Personifikasi</Link
                        >
                        <Link href="/courses" class="text-neutral-50"
                            >Telusuri Kelas</Link
                        >
                        <Link href="/events" class="text-neutral-50"
                            >Ikuti Event</Link
                        >
                    </div>
                </div>
            </div>
            <p class="text-neutral-20 mt-5">
                &copy; {{ new Date().getFullYear() }} Pathify. All rights
                reserved.
            </p>
        </div>
    </footer>
</template>
