<script setup>
import { onMounted } from "vue";

const props = defineProps({
    category: {
        type: String,
        required: true,
    },
    backgroundColor: {
        type: String,
        required: true,
    },
    icons: {
        type: String,
        required: true,
    },
    fontSize: {
        type: String,
        default: "text-xs",
    },
    imageSize: {
        type: String,
        default: "size-3",
    },
    paddingY: {
        type: String,
        default: "py-1",
    },
});

onMounted(() => {
    lucide.createIcons();
});
</script>

<template>
    <div
        :class="`flex px-2 w-max rounded-lg gap-1 items-center ${paddingY}`"
        :style="{ backgroundColor: backgroundColor }"
    >
        <i :class="icons" class="text-xs text-white"></i>
        <span :class="`${fontSize} text-neutral-20`">{{ category }}</span>
    </div>
</template>
