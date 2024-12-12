<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head } from "@inertiajs/vue3";
import BoxEvent from "@/Components/BoxEvent.vue";

const props = defineProps({
    events: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="Event Saya" />

    <UserLayout>
        <div class="container py-12">
            <div class="flex flex-col gap-12">
                <!-- Header -->
                <h1
                    class="font-bold p-6 text-[2.3125rem] leading-[2.775rem] rounded-xl bg-neutral-10"
                >
                    Event Saya
                </h1>

                <!-- Upcoming Event -->
                <div v-if="props.events == ''">
                    <h1
                        class="font-bold text-[2.3125rem] leading-[2.775rem] mb-6"
                    >
                        Akan datang
                    </h1>
                    <div class="flex flex-col items-center gap-6">
                        <img
                            src="/media/illustrations/empty-state.svg"
                            class="h-60"
                            alt=""
                        />
                        <p class="text-neutral-90 text-[1.3125rem] text-center">
                            Anda belum tergabung dalam event apapun,
                            <a href="#" class="text-primary font-bold"
                                >klik disini</a
                            >
                            untuk mengikuti event terbaru dari kami
                        </p>
                    </div>
                </div>

                <!-- Old Event -->
                <div v-if="props.events == ''">
                    <h1
                        class="font-bold text-[2.3125rem] leading-[2.775rem] mb-6"
                    >
                        Event lampau
                    </h1>
                    <p class="text-neutral-90 text-[1.3125rem]">
                        Anda tidak pernah menghadiri event apapun.
                    </p>
                </div>
            </div>
        </div>
    </UserLayout>
</template>
