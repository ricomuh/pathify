<script setup>
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
        default: "text-sm",
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
</script>

<template>
    <div
        :class="`flex px-3 w-max rounded-md gap-[0.38rem] items-center ${paddingY}`"
        :style="{ backgroundColor: backgroundColor }"
    >
        <img :src="icons" :alt="category" :class="imageSize" />
        <span :class="`${fontSize} text-neutral-20`">{{ category }}</span>
    </div>
</template>
