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
        class="bg-neutral-10 p-6 rounded-xl"
    >
        <h1 class="text-5xl font-bold mb-3 leading-[3.5rem]">
            {{ content?.title }}
        </h1>
        <div v-html="content?.body" class="course-content"></div>
    </div>
</template>

<style scoped>
::v-deep .course-content ul {
    @apply list-disc list-inside;
}
::v-deep .course-content ul li,
::v-deep .course-content ol li,
::v-deep .course-content p,
::v-deep .course-content h1,
::v-deep .course-content h2,
::v-deep .course-content h3,
::v-deep .course-content h4,
::v-deep .course-content h5,
::v-deep .course-content h6 {
    @apply text-neutral-90;
}
::v-deep .course-content ol li {
    @apply list-decimal list-inside;
}

::v-deep .course-content img {
    @apply mx-auto my-6;
    max-width: 100%;
}

::v-deep .course-content table {
    @apply w-full;
}

::v-deep .course-content table tr {
    @apply border-b border-neutral-40;
}

::v-deep .course-content table tr:last-child {
    @apply border-b-0;
}

::v-deep .course-content table td {
    @apply py-3;
}

::v-deep .course-content table th {
    @apply py-3;
}

::v-deep .course-content table th,
::v-deep .course-content table td {
    @apply text-neutral-90;
}

::v-deep .course-content table th {
    @apply font-bold;
}

::v-deep .course-content table td:first-child {
    @apply pr-6;
}

::v-deep .course-content table td:last-child {
    @apply pl-6;
}

::v-deep .course-content blockquote {
    @apply bg-neutral-10 border-l-4 border-primary-surface p-4;
}

::v-deep .course-content blockquote p {
    @apply text-neutral-90;
}

::v-deep .course-content a {
    @apply text-primary;
}

::v-deep .course-content a:hover {
    @apply underline;
}

::v-deep .course-content h1 {
    @apply text-4xl font-bold mb-1;
}

::v-deep .course-content h2 {
    @apply text-3xl font-bold mb-1;
}

::v-deep .course-content h3 {
    @apply text-2xl font-bold mb-1;
}

::v-deep .course-content h4 {
    @apply text-xl font-bold mb-1;
}

::v-deep .course-content h5 {
    @apply text-lg font-bold mb-1;
}

::v-deep .course-content h6 {
    @apply text-base font-bold mb-1;
}

::v-deep .course-content p {
    @apply mb-4;
}

::v-deep .course-content ul {
    @apply list-disc list-inside;
}

::v-deep .course-content ol {
    @apply list-decimal list-inside;
}

::v-deep .course-content ol li {
    @apply mb-2;
}

::v-deep .course-content ul li {
    @apply mb-2;
}

::v-deep .course-content pre {
    @apply bg-neutral-10 p-4 rounded-xl overflow-x-auto;
}

::v-deep .course-content code {
    @apply bg-neutral-10 p-1 rounded-md;
}

::v-deep .course-content iframe {
    @apply w-full mb-4;
    height: 500px;
}
</style>
