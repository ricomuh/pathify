<script setup>
import { Link } from "@inertiajs/vue3";
import BadgeCategory from "./BadgeCategory.vue";
import { computed } from "vue";

const props = defineProps({
    categoryClass: {
        type: String,
        required: true,
    },
    backgroundBadge: {
        type: String,
        required: true,
    },
    iconBadge: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    teacher: {
        type: String,
        required: true,
    },
    teachersJob: {
        type: String,
        required: true,
    },
    avatar: {
        type: String,
        required: true,
    },
    level: {
        type: Number,
        required: true,
    },
    slug: {
        type: String,
        required: true,
    },
});

const bars = computed(() => {
    const levels = [
        { height: "h-3", color: "bg-primary" },
        { height: "h-5", color: "bg-neutral-50" },
        { height: "h-7", color: "bg-neutral-50" },
    ];

    return levels.map((bar, index) => {
        if (index < props.level) {
            bar.color = "bg-primary";
        }
        return bar;
    });
});
</script>
<template>
    <Link
        :href="`/courses/${slug}`"
        class="rounded-2xl overflow-hidden border border-neutral-90 bg-neutral-10"
    >
        <div class="p-3">
            <img
                src="../../images/banner.png"
                class="h-[10.40625rem] w-full object-cover rounded-lg mb-3"
                alt=""
            />
            <BadgeCategory
                :category="categoryClass"
                :backgroundColor="backgroundBadge"
                :icons="iconBadge"
            />
            <h1 class="mt-1 text-xl text-neutral-100 font-bold h-28 mb-3">
                {{ title }}
            </h1>
        </div>
        <div class="bg-neutral-40 p-3">
            <div class="flex justify-between items-center">
                <div class="flex gap-2 items-center">
                    <img
                        :src="avatar"
                        class="size-8 object-cover rounded-full"
                        alt=""
                    />
                    <div>
                        <p class="text-neutral-100 font-bold text-sm mb-1">
                            {{ teacher }}
                        </p>
                        <p class="text-neutral-90 -mt-1.5 text-sm">
                            {{ teachersJob }}
                        </p>
                    </div>
                </div>
                <div class="flex items-end gap-[0.13rem]">
                    <div
                        v-for="(bar, index) in bars"
                        :key="index"
                        :class="`w-2 ${bar.height} ${bar.color} rounded-[6.25rem]`"
                    ></div>
                </div>
            </div>
        </div>
    </Link>
</template>
