<script setup>
import { cn } from "@/lib/utils";
import { DialogTitle, useForwardProps } from "radix-vue";
import { computed } from "vue";

const props = defineProps({
    asChild: { type: Boolean, required: false },
    as: { type: null, required: false },
    class: { type: null, required: false },
});

const delegatedProps = computed(() => {
    const { class: _, ...delegated } = props;

    return delegated;
});

const forwardedProps = useForwardProps(delegatedProps);
</script>

<template>
    <DialogTitle
        v-bind="forwardedProps"
        :class="cn('text-xl-plus font-bold leading-none', props.class)"
    >
        <slot />
    </DialogTitle>
</template>
