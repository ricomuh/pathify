<script setup lang="ts">
const props = defineProps({
    content: Object,
    submission: Object,
    showSubmissionForm: Boolean,
});
</script>

<template>
    <div
        v-if="
            !submission &&
            !showSubmissionForm &&
            submission?.user_course_submissions == null
        "
        class="bg-neutral-10 p-5 xl:p-6 rounded-xl"
    >
        <div v-html="content?.body" class="course-content"></div>
    </div>
</template>

<style scoped>
:deep(.course-content ul) {
    @apply list-disc list-inside;
}
:deep(.course-content ul li),
:deep(.course-content ol li),
:deep(.course-content p),
:deep(.course-content h1),
:deep(.course-content h2),
:deep(.course-content h3),
:deep(.course-content h4),
:deep(.course-content h5),
:deep(.course-content h6) {
    @apply text-neutral-90;
}
:deep(.course-content ol li) {
    @apply list-decimal list-inside;
}

:deep(.course-content img) {
    @apply mx-auto my-6;
    max-width: 100%;
}

:deep(.course-content table) {
    @apply w-full;
}

:deep(.course-content table tr) {
    @apply border-b border-neutral-40;
}

:deep(.course-content table tr:last-child) {
    @apply border-b-0;
}

:deep(.course-content table td) {
    @apply py-3;
}

:deep(.course-content table th) {
    @apply py-3;
}

:deep(.course-content table th),
:deep(.course-content table td) {
    @apply text-neutral-90;
}

:deep(.course-content table th) {
    @apply font-bold;
}

:deep(.course-content table td:first-child) {
    @apply pr-6;
}

:deep(.course-content table td:last-child) {
    @apply pl-6;
}

:deep(.course-content blockquote) {
    @apply bg-neutral-10 border-l-4 border-primary-surface p-5;
}

:deep(.course-content blockquote p) {
    @apply text-neutral-90;
}

:deep(.course-content a) {
    @apply text-primary;
}

:deep(.course-content a:hover) {
    @apply underline;
}

:deep(.course-content h1) {
    @apply text-2xl-plus md:text-3xl lg:text-4xl xl:text-5xl font-bold mb-1;
}

:deep(.course-content h2) {
    @apply text-2xl md:text-3xl lg:text-4xl xl:text-4xl-plus font-bold mb-1;
}

:deep(.course-content h3) {
    @apply text-xl md:text-2xl lg:text-3xl xl:text-3xl-plus font-bold mb-1;
}

:deep(.course-content h4) {
    @apply text-lg md:text-xl lg:text-2xl xl:text-2xl-plus font-bold mb-1;
}

:deep(.course-content h5) {
    @apply text-base md:text-lg lg:text-xl xl:text-xl-plus font-bold mb-1;
}

:deep(.course-content h6) {
    @apply text-base md:text-lg lg:text-xl xl:text-xl font-bold mb-1;
}

:deep(.course-content p) {
    @apply mb-4;
}

:deep(.course-content ul) {
    @apply list-disc list-inside;
}

:deep(.course-content ol) {
    @apply list-decimal list-inside;
}

:deep(.course-content ol li) {
    @apply mb-2;
}

:deep(.course-content ul li) {
    @apply mb-2;
}

:deep(.course-content pre) {
    @apply bg-neutral-10 p-5 rounded-xl overflow-x-auto;
}

:deep(.course-content code) {
    @apply bg-neutral-10 p-1 rounded-md;
}

:deep(.course-content iframe) {
    @apply w-full mb-4;
    height: 500px;
}
</style>
