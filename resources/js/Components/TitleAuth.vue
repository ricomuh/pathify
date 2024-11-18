<script setup>
defineProps({
    title: {
        type: String,
    },
    subtitle: {
        type: String,
    },
});
</script>

<template>
    <div class="mb-12">
        <h1 class="text-4xl md:text-5xl font-bold mb-1">{{ title }}</h1>
        <p class="text-neutral-70 text-lg md:text-xl">
            {{ subtitle }}
        </p>
    </div>
</template>
