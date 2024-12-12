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
    isScrolled: {
        type: Boolean,
        default: false,
    },
});

const classes = computed(() => {
    if (props.active) {
        return "text-primary";
    }
    return props.isScrolled ? "text-neutral-80" : "text-neutral-20";
});
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
