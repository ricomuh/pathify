<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BadgeCategory from "@/Components/BadgeCategory.vue";
import BoxEvent from "@/Components/BoxEvent.vue";
import { ref } from "vue";

// props
const props = defineProps({
    categories: Array,
    events: Array,
});
// advantages
const advantages = ref([
    {
        title: "Mulai Belajar IT jadi lebih mudah",
        desc: "Pathify dirancang sedemikian rupa sehingga materi yang diberikan sangat ramah untuk pemula, bahkan yang benar - benar baru terjun sekalipun",
        image: "/media/illustrations/home1.svg",
    },
    {
        title: "Pahami dirimu sekarang",
        desc: "Bingung memilih karir di bidang apa? Pathify membantu kamu dalam menentukan fokus dan spesialisasi yang kamu banget!",
        image: "/media/illustrations/home2.svg",
    },
    {
        title: "Materi Terbaharukan",
        desc: "Pathify tidak kaku seperti instansi pendidikan pada umumnya. Tentu saja materi yang diajarkan juga sudah sesuai dengan kebutuhan industri saat ini",
        image: "/media/illustrations/home3.svg",
    },
]);
</script>

<template>
    <Head title="Beranda" />

    <AuthenticatedLayout>
        <!-- Banner -->
        <div class="bg-home">
            <div class="container">
                <div
                    class="text-center min-h-screen flex flex-col justify-between pt-12"
                >
                    <div class="xl:w-2/3 mx-auto pt-20">
                        <h1
                            class="text-6xl-plus leading-[4.95rem] mb-3 font-bold text-neutral-20"
                        >
                            Ikuti Kuiz dan Temukan Role yang
                            <span class="text-primary">Kamu Banget!</span>
                        </h1>
                        <p class="text-xl text-neutral-70 mb-12">
                            Merasa sudah belajar coding namun tidak segera
                            pandai?. Atau merasa salah mengambil role?. Ikuti
                            Quiz dari kami dan temukan role serta dapatkan
                            roadmap belajar yang sesuai dengan kamu!. Coba
                            sekarang,
                            <span class="font-bold text-neutral-70"
                                >Gratis!</span
                            >
                        </p>
                        <Link
                            href="/questionnaire"
                            class="block bg-primary text-neutral-20 w-max text-xl py-4 px-8 rounded-xl mx-auto border-b-4 border-primary-hover"
                            >Temukan Role</Link
                        >
                    </div>
                    <img
                        src="/media/illustrations/home-banner.png"
                        class="w-4/5 mx-auto"
                        alt=""
                    />
                </div>
            </div>
        </div>

        <!-- Section 2 -->
        <div class="bg-neutral-100 py-12 overflow-hidden">
            <div class="marquee">
                <div class="marquee-content">
                    <!-- Repeating content dynamically using Vue.js -->
                    <template v-for="i in 8" :key="i">
                        <p
                            class="text-3xl-plus text-neutral-20 font-semibold text-center leading-[2.4rem]"
                        >
                            Dunia IT adalah masa depan Anda
                        </p>
                        <p
                            class="text-3xl-plus text-neutral-20 font-semibold text-center leading-[2.4rem]"
                        >
                            -
                        </p>
                        <p
                            class="text-3xl-plus text-neutral-20 font-semibold text-center leading-[2.4rem]"
                        >
                            Belajar IT itu Menyenangkan
                        </p>
                        <p
                            class="text-3xl-plus text-neutral-20 font-semibold text-center leading-[2.4rem]"
                        >
                            -
                        </p>
                        <p
                            class="text-3xl-plus text-neutral-20 font-semibold text-center leading-[2.4rem]"
                        >
                            Temukan Spesialisasimu disini
                        </p>
                        <p
                            class="text-3xl-plus text-neutral-20 font-semibold text-center leading-[2.4rem]"
                        >
                            -
                        </p>
                    </template>
                </div>
            </div>
        </div>

        <!-- Section 3 -->
        <div class="bg-primary py-12">
            <div class="container">
                <div class="grid grid-cols-4 gap-12 items-center">
                    <div class="col-span-1">
                        <h1
                            class="text-4xl text-neutral-20 font-bold leading-[2.7rem]"
                        >
                            Rasakan manfaat dari bergabung bersama kami
                        </h1>
                    </div>
                    <div class="col-span-3">
                        <div class="grid grid-cols-3 gap-6">
                            <div
                                v-for="(value, index) in advantages"
                                :key="index"
                                class="rounded-3xl border-4 border-neutral-90 bg-neutral-20 p-6 flex flex-col justify-between"
                            >
                                <div>
                                    <h1
                                        class="text-3xl-plus font-bold text-neutral-90 leading-[2.5rem] mb-2"
                                    >
                                        {{ value.title }}
                                    </h1>
                                    <p class="text-neutral-70">
                                        {{ value.desc }}
                                    </p>
                                </div>
                                <img :src="value.image" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role -->
        <div class="bg-primary-pressed py-12">
            <h1 class="text-center text-4xl text-neutral-20 font-bold mb-6">
                Pilih Rolemu, Sekarang!
            </h1>
            <div class="marquee">
                <div class="marquee-content !gap-6">
                    <template v-for="i in 8" :key="i">
                        <BadgeCategory
                            v-for="category in props.categories"
                            :key="category.id"
                            :category="category.name"
                            :backgroundColor="category.color"
                            :icons="category.icon_image"
                            fontSize="text-lg"
                            paddingY="py-1.5 rounded-xl"
                        />
                    </template>
                </div>
            </div>
        </div>

        <!-- Event -->
        <div class="bg-primary py-12">
            <h1 class="text-center text-4xl text-neutral-20 font-bold mb-6">
                Ikuti Event, dapatkan Insight
            </h1>
            <div class="marquee">
                <div class="marquee-event inline-flex gap-5">
                    <template v-for="i in 3" :key="i">
                        <BoxEvent
                            v-for="(value, key) in props.events"
                            :key="key"
                            :title="value.title"
                            :category="value.category.name"
                            :slug="value.slug"
                            :seatsLeft="value.seats_left"
                            :daysLeft="value.start_date"
                            :thumbnail="value.thumbnail"
                            width="w-[22.5rem]"
                        />
                    </template>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.marquee {
    position: relative;
    overflow: hidden;
    width: 100%;
}

.marquee-content {
    display: inline-flex;
    gap: 3rem;
    animation: marquee 100s linear infinite;
    white-space: nowrap;
}

@keyframes marquee {
    0% {
        transform: translateX(0%);
    }
    100% {
        transform: translateX(-100%);
    }
}

.marquee-event {
    animation: marquee 100s linear infinite;
    white-space: nowrap;
}
</style>
