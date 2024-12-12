<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>

<template>
    <Head title="Beranda" />

    <AuthenticatedLayout>
        <div class="bg-home">
            <div class="container">
                <div
                    class="text-center min-h-screen flex flex-col justify-between pt-12"
                >
                    <div class="xl:w-2/3 mx-auto pt-20">
                        <h1
                            class="text-5xl leading-[3.5rem] mb-3 font-bold text-neutral-20"
                        >
                            Jelajahi dunia IT dengan cara yang
                            <span class="text-primary">Menyenangkan!</span>
                        </h1>
                        <p class="text-xl text-neutral-70">
                            Dengan Pathify, kamu tidak hanya belajar, tetapi
                            juga merasakan bagaimana dunia IT dapat membuka
                            berbagai peluang karier yang menarik dan
                            menguntungkan. Jadikan belajar IT bagian dari
                            petualanganmu yang seru!
                        </p>
                        <form>
                            <div class="flex gap-2 justify-center mt-10">
                                <input
                                    type="text"
                                    class="w-[25rem] p-3 rounded-xl bg-neutral-10"
                                    placeholder="Mau belajar apa hari ini?"
                                />
                                <button
                                    type="submit"
                                    class="bg-primary text-white p-3 rounded-xl"
                                >
                                    Mulai Belajar
                                </button>
                            </div>
                        </form>
                    </div>
                    <img
                        src="/media/illustrations/home-banner.png"
                        class="w-4/5 mx-auto"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
