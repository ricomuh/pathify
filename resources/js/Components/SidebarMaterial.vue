<script setup lang="ts">
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/Components/ui/accordion";

const props = defineProps({
    course: Object,
    order: Number,
    defaultAccordionValue: String,
    currentOrder: Number,
});
</script>

<template>
    <div class="col-span-1 py-6 overflow-y-auto">
        <Link href="/dashboard" class="flex gap-3 items-center p-3 mb-6">
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
                v-for="(value, index) in course.groups"
                :key="index"
                :value="value.id"
            >
                <AccordionTrigger
                    class="text-neutral-90 text-xl-plus p-4 text-start bg-none"
                >
                    {{ value.title }}
                </AccordionTrigger>
                <AccordionContent class="bg-neutral-10 p-0">
                    <div class="flex flex-col gap-3 px-4 pb-3">
                        <Link
                            :href="`/courses/${course.slug}/watch/${item?.order}`"
                            v-for="(item, key) in value?.contents"
                            :key="key"
                            class="text-base flex gap-3 items-center px-3 py-2 rounded-xl"
                            :class="{
                                'bg-primary-border':
                                    item.order === currentOrder,
                                '': item.order !== currentOrder,
                            }"
                        >
                            <img
                                v-if="item.order === currentOrder"
                                src="/media/icons/uncheck.svg"
                                alt=""
                                class="w-[1.125rem]"
                            />
                            <img
                                v-else-if="item.order < currentOrder"
                                src="/media/icons/checked.svg"
                                alt=""
                                class="w-[1.125rem]"
                            />
                            <img
                                v-else
                                src="/media/icons/section.svg"
                                alt=""
                                class="w-[1.125rem]"
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
            <AccordionItem
                class="bg-neutral-10 cursor-pointer border border-neutral-40 rounded-xl"
                value="submission"
            >
                <AccordionTrigger
                    class="text-neutral-90 text-xl-plus p-4 text-start bg-none"
                >
                    Submission
                </AccordionTrigger>
                <AccordionContent class="bg-neutral-10 p-0">
                    <div class="flex flex-col gap-3 px-4 pb-3">
                        <Link
                            :href="`/courses/${course.slug}/submission`"
                            class="text-base flex gap-3 items-center px-3 py-2 rounded-xl"
                        >
                            <img
                                src="/media/icons/section.svg"
                                alt=""
                                class="w-[1.125rem]"
                            />
                            <p class="text-neutral-100">Overview</p>
                        </Link>
                    </div>
                </AccordionContent>
            </AccordionItem>
        </Accordion>
    </div>
</template>
