<template>
    <div v-if="visible" class="alert alert-success">
        <p class="text-white">{{ message }}</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
    message: {
        type: String,
        default: "Operation successful!",
    },
    duration: {
        type: Number,
        default: 3000, // 3 seconds
    },
});

const visible = ref(true);

const closeAlert = () => {
    visible.value = false;
};

onMounted(() => {
    setTimeout(() => {
        closeAlert();
    }, props.duration);
});
</script>

<style scoped>
.alert {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #4caf50;
    color: white;
    padding: 8px 12px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}
.alert button {
    background: none;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    margin-left: 10px;
}
</style>
