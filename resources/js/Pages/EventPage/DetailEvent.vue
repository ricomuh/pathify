<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/components/ui/accordion";
</script>

<template>
    <Head title="Detail Event" />

    <AuthenticatedLayout>
        <div class="container">
            <p>Detail Event</p>
        </div>
    </AuthenticatedLayout>
</template>
