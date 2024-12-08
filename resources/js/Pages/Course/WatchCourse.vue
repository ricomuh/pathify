<script setup>
import SecondaryLayout from "@/Layouts/SecondaryLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/components/ui/accordion";
import { computed } from "vue";

const props = defineProps({
    course: Object,
    content: Object,
    order: Number,
});

// default value for accordion
const defaultAccordionValue = computed(() => {
    return props.course.groups.length > 0 ? props.course.groups[0].id : null;
});

// current order
const currentOrder = computed(() => {
    return parseInt(route().params.order);
});

// order of previous and next content
const previousContentUrl = computed(() => {
    if (props.order > 1) {
        return `/courses/${props.course.slug}/watch/${props.order - 1}`;
        defaultAccordionValue.value = props.course.groups[props.order - 1].id;
    }
    return null;
});

const nextContentUrl = computed(() => {
    if (props.order < props.course.groups.length) {
        return `/courses/${props.course.slug}/watch/${props.order + 1}`;
        defaultAccordionValue.value = props.course.groups[props.order + 1].id;
    }
    return null;
});
</script>

<template>
    <Head title="Detail Materi" />

    <SecondaryLayout>
        <div class="bg-neutral-30">
            <div class="container content-container overflow-hidden">
                <div class="grid grid-cols-4 gap-6">
                    <div class="col-span-1 py-6">
                        <!-- Sidebar -->
                        <Link
                            href="/dashboard"
                            class="flex gap-3 items-center p-3 mb-6"
                        >
                            <img src="/media/icons/arrow.svg" alt="" />
                            <p>Dashboard</p>
                        </Link>
                        <Accordion
                            type="single"
                            class="w-full flex flex-col gap-2"
                            collapsible
                            :default-value="defaultAccordionValue"
                        >
                            <AccordionItem
                                class="bg-neutral-10 cursor-pointer border border-neutral-40 rounded-xl"
                                v-for="(value, index) in props.course.groups"
                                :key="index"
                                :value="value.id"
                            >
                                <AccordionTrigger
                                    class="text-neutral-90 text-[1.3125rem] p-4 text-start"
                                >
                                    {{ value.title }}</AccordionTrigger
                                >
                                <AccordionContent class="bg-neutral-10 p-0">
                                    <div class="flex flex-col gap-3 px-4 pb-3">
                                        <Link
                                            :href="`/courses/${props.course.slug}/watch/${item.order}`"
                                            v-for="(
                                                item, key
                                            ) in value.contents"
                                            :key="key"
                                            class="text-base flex gap-3 items-center px-3 py-2 rounded-xl"
                                            :class="{
                                                'bg-primary-border':
                                                    item.order === currentOrder,
                                                '': item.order !== currentOrder,
                                            }"
                                        >
                                            <img
                                                v-if="
                                                    item.order === currentOrder
                                                "
                                                src="/media/icons/uncheck.svg"
                                                alt=""
                                                class="size-[1.125rem]"
                                            />
                                            <img
                                                v-else-if="
                                                    item.order < currentOrder
                                                "
                                                src="/media/icons/checked.svg"
                                                alt=""
                                                class="size-[1.125rem]"
                                            />
                                            <img
                                                v-else
                                                src="/media/icons/section.svg"
                                                alt=""
                                                class="size-[1.125rem]"
                                            />
                                            <p
                                                :class="
                                                    item.order > currentOrder
                                                        ? 'text-neutral-70'
                                                        : 'text-neutral-100'
                                                "
                                            >
                                                {{ item.title }}
                                            </p>
                                        </Link>
                                    </div>
                                </AccordionContent>
                            </AccordionItem>
                        </Accordion>
                    </div>
                    <!-- Content -->
                    <div class="col-span-3 bg-neutral-20 p-6">
                        <div class="bg-neutral-10 p-6 rounded-xl mb-6">
                            <h1
                                class="text-5xl font-bold mb-3 leading-[3.5rem]"
                            >
                                {{ content.title }}
                            </h1>
                            <div
                                v-html="content.body"
                                class="course-content"
                            ></div>
                        </div>
                        <div
                            class="bg-neutral-10 p-6 flex justify-between items-center rounded-xl"
                        >
                            <Link
                                :href="previousContentUrl"
                                class="flex gap-2 items-center p-3 hover:bg-neutral-20 rounded-xl"
                            >
                                <img src="/media/icons/arrow-left.svg" alt="" />
                                <p class="text-neutral-90">Materi Sebelumnya</p>
                            </Link>
                            <Link
                                :href="nextContentUrl"
                                class="flex gap-2 items-center p-3 hover:bg-neutral-20 rounded-xl"
                            >
                                <p class="text-neutral-90">
                                    Materi Selanjutnya
                                </p>
                                <img
                                    src="/media/icons/arrow-left.svg"
                                    class="rotate-180"
                                    alt=""
                                />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </SecondaryLayout>
</template>

<style scoped>
.content-container {
    max-height: calc(100% - 138px);
    overflow-y: auto;
}
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
