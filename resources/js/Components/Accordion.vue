<script setup>
import { ref } from "vue";

const props = defineProps({
    curriculum: {
        type: Array,
        required: true,
    },
});

//active index accordion
const activeIndex = ref(0);

// toggle accordion function
const toggleAccordion = (index) => {
    activeIndex.value = activeIndex.value === index ? null : index;
};
</script>

<template>
    <div
        v-for="(value, index) in curriculum"
        :key="index"
        class="border border-neutral-40 rounded-lg mb-2"
    >
        <!-- Header Accordion -->
        <div
            class="bg-neutral-10 py-3 px-6 flex justify-between items-center gap-4 cursor-pointer"
            @click="toggleAccordion(index)"
        >
            <p class="text-neutral-90">
                {{ value.title }}
            </p>
            <button type="button">
                <img
                    :class="{
                        'rotate-180 duration-300 ease-in-out':
                            activeIndex === index,
                    }"
                    src="../../images/icons/chevron.svg"
                    alt=""
                />
            </button>
        </div>
        <!-- Body Accordion -->
        <ul v-if="activeIndex === index" class="px-6 py-3 flex flex-col gap-3">
            <li
                v-for="(item, key) in value.subs"
                :key="key"
                class="text-sm text-neutral-90"
            >
                {{ item }}
            </li>
        </ul>
    </div>
</template>
