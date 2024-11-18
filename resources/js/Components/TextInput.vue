<script setup>
import { onMounted, ref } from "vue";

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-xl py-3 px-6 border-neutral-40 border-2 shadow-sm focus:border-primary focus:ring-primary text-base"
        v-model="model"
        ref="input"
    />
</template>
