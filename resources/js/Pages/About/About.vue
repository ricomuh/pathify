<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Tentang" />

    <AuthenticatedLayout>
        <div class="container pt-16">
            <!-- Section 1 -->
            <div
                class="grid gap-4 py-8 md:grid-cols-2 xl:py-0 xl:grid-cols-5 xl:gap-12 items-center"
            >
                <div
                    class="flex flex-col gap-3 xl:col-span-3 order-last md:order-first"
                >
                    <h1
                        class="text-3xl lg:text-4xl lg:leading-[2.75rem] leading-10 xl:text-5xl-plus font-bold xl:leading-[3.6995rem]"
                    >
                        Mencari <span class="text-primary">Passion</span> yang
                        tepat itu membuang Waktu dan Tenaga?
                    </h1>
                    <p
                        class="text-xl-plus leading-[1.60125rem] text-neutral-90"
                    >
                        Tahukah kalian? bahwa mencari “alur belajar” yang tepat
                        itu menjadi sebuah tantangan tersendiri bagi orang yang
                        terjun dalam dunia IT. Perlu waktu dan energi yang besar
                        untuk dapat menemukan bidang yang cocok.
                    </p>
                </div>
                <div class="xl:col-span-2">
                    <img
                        loading="lazy"
                        src="/media/illustrations/about1.svg"
                        class="xl:h-[31.25rem]"
                        alt=""
                    />
                </div>
            </div>
            <!-- Section 2 -->
            <div
                class="grid gap-4 py-8 md:grid-cols-2 xl:py-0 xl:grid-cols-5 xl:gap-12 items-center"
            >
                <div class="xl:col-span-2">
                    <img
                        loading="lazy"
                        src="/media/illustrations/about2.svg"
                        class="xl:h-[31.25rem]"
                        alt=""
                    />
                </div>
                <div class="flex flex-col gap-3 xl:col-span-3">
                    <h1
                        class="text-3xl lg:text-4xl lg:leading-[2.75rem] leading-10 xl:text-5xl-plus font-bold xl:leading-[3.6995rem]"
                    >
                        Dunia IT sangatlah
                        <span class="text-primary">abstrak</span>, Namun kami
                        sudah membuatnya lebih
                        <span class="text-primary">terstruktur!</span>
                    </h1>
                    <p
                        class="text-xl-plus leading-[1.60125rem] text-neutral-90"
                    >
                        Tidak hanya dalam proses mencari “passion” saja yang
                        ribet, namun juga dalam hal mencari sumber belajar, dan
                        semua materi yang perlu dipelajari pun cukup abstrak dan
                        rumit. Namun dengan pathify, kami menjadikannya sangat
                        terstruktur
                    </p>
                </div>
            </div>
            <!-- Section 3 -->
            <div
                class="grid gap-4 py-8 md:grid-cols-2 xl:py-0 xl:grid-cols-5 xl:gap-12 items-center"
            >
                <div
                    class="flex flex-col gap-3 xl:col-span-3 order-last md:order-first"
                >
                    <h1
                        class="text-3xl lg:text-4xl lg:leading-[2.75rem] leading-10 xl:text-5xl-plus font-bold xl:leading-[3.6995rem]"
                    >
                        Karena belajar bersama itu jauh lebih
                        <span class="text-primary">menyenangkan</span>
                    </h1>
                    <p
                        class="text-xl-plus leading-[1.60125rem] text-neutral-90"
                    >
                        Belajar bersama membuat kita menjadi lebih mudah dalam
                        memahami materi karena memiliki support system dan teman
                        seperjuangan. Dengan pathify, anda dapat menemukan forum
                        diskusi untuk saling berkomunikasi antar member
                    </p>
                </div>
                <div class="xl:col-span-2">
                    <img
                        loading="lazy"
                        src="/media/illustrations/about3.svg"
                        class="xl:h-[31.25rem]"
                        alt=""
                    />
                </div>
            </div>
            <!-- Section 4 -->
            <div
                class="grid gap-4 py-8 md:grid-cols-2 xl:py-0 xl:grid-cols-5 xl:gap-12 items-center"
            >
                <div class="xl:col-span-2">
                    <img
                        loading="lazy"
                        src="/media/illustrations/about4.svg"
                        class="xl:h-[31.25rem]"
                        alt=""
                    />
                </div>
                <div class="flex flex-col gap-3 xl:col-span-3">
                    <h1
                        class="text-3xl lg:text-4xl lg:leading-[2.75rem] leading-10 xl:text-5xl-plus font-bold xl:leading-[3.6995rem]"
                    >
                        Berhenti Membuang Waktu Anda, Mulailah belajar coding
                        sesuai dengan
                        <span class="text-primary">Passion Anda</span>
                    </h1>
                    <p
                        class="text-xl-plus leading-[1.60125rem] text-neutral-90"
                    >
                        Pathify hadir untuk menjembatani semua orang yang ingin
                        terjun ke dalam dunia teknologi bahkan dengan tidak
                        memiliki basic sama sekali.
                    </p>
                    <p
                        class="text-xl-plus leading-[1.60125rem] text-neutral-90"
                    >
                        Dengan kuisioner personifikasi yang membantu kalian
                        menemukan alur belajar yang tepat, dan forum diskusi
                        untuk menemukan komunitas yang supportif. Serta
                        rekomendasi alur belajar yang tepat dan terstruktur
                    </p>
                    <p
                        class="text-xl-plus leading-[1.60125rem] text-neutral-90"
                    >
                        Maka anda telah siap untuk meraih mimpi anda!
                    </p>
                </div>
            </div>
            <!-- Section 5 -->
            <div class="pt-6 text-center">
                <h1
                    class="text-3xl lg:text-4xl lg:leading-[2.75rem] leading-10 xl:text-5xl-plus font-bold xl:leading-[3.6995rem] md:w-3/4 mx-auto"
                >
                    Bersama Pathify, Anda siap memulai karir anda dalam dunia
                    Teknologi
                </h1>
                <img
                    loading="lazy"
                    src="/media/illustrations/about5.svg"
                    class="mx-auto"
                    alt=""
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
