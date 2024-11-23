<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active ? "text-primary" : "text-neutral-80"
);
</script>

<template>
    <Link
        :href="href"
        :class="classes"
        class="inline-flex items-center transition text-lg duration-150 ease-in-out"
    >
        <slot />
    </Link>
</template>
