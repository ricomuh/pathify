<script setup lang="ts">
import SecondaryLayout from "@/Layouts/SecondaryLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import SidebarMaterial from "@/Components/SidebarMaterial.vue";
import ContentMaterial from "@/Components/ContentMaterial.vue";
import UploadSubmission from "@/Components/UploadSubmission.vue";
import SubmissionContent from "@/Components/SubmissionContent.vue";
import SuccessSubmission from "@/Components/SuccessSubmission.vue";
import NextPrevMaterial from "@/Components/NextPrevMaterial.vue";
import Discussion from "@/Components/Discussion.vue";
import { computed, onMounted } from "vue";
import { ref } from "vue";

// detail discussion
const selectedCommentId = ref(null);

const toggleChildren = (id) => {
    selectedCommentId.value = selectedCommentId.value === id ? null : id;
};

const props = defineProps({
    course: Object,
    content: Object,
    order: Number,
    submission: Object,
    nextEpisode: String,
    prevEpisode: String,
});

// default value for accordion
const defaultAccordionValue = computed(() => {
    const group = props.course.groups.find((group) => {
        return group.contents.some((content) => content.order === props.order);
    });

    return group ? group.id : null;
});

// current order
const currentOrder = computed(() => {
    return parseInt(route().params.order);
});

// format date comment
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffSeconds = Math.floor(diffTime / 1000);
    const diffMinutes = Math.floor(diffSeconds / 60);
    const diffHours = Math.floor(diffMinutes / 60);
    const diffDays = Math.floor(diffHours / 24);

    if (diffDays > 0) {
        return `${diffDays} hari yang lalu`;
    } else if (diffHours > 0) {
        return `${diffHours} jam yang lalu`;
    } else if (diffMinutes > 0) {
        return `${diffMinutes} menit yang lalu`;
    } else {
        return `${diffSeconds} detik yang lalu`;
    }
};

// Reactive property to manage visibility
const showSubmissionForm = ref(false);

// Method to handle button click
const handleSubmissionClick = () => {
    showSubmissionForm.value = true;
    const query = new URLSearchParams(window.location.search);
    query.set("submission", "true");
    window.history.replaceState(
        null,
        "",
        `${window.location.pathname}?${query.toString()}`
    );
};

const files = ref([]);

const handleFileUpload = (event) => {
    const uploadedFiles = Array.from(event.target.files);
    files.value = [...files.value, ...uploadedFiles];
};

const removeFile = (index) => {
    files.value.splice(index, 1);
    const fileInput = document.getElementById("file");
    if (files.value.length === 0 && fileInput) fileInput.value = "";
};

// Check URL query parameters on page load
onMounted(() => {
    const query = new URLSearchParams(window.location.search);
    if (query.get("submission") === "true") {
        showSubmissionForm.value = true;
    }
});
</script>

<template>
    <Head title="Detail Materi" />

    <SecondaryLayout>
        <div class="bg-neutral-30 relative">
            <div class="container mx-auto xl:px-0">
                <!-- Container utama -->
                <div
                    class="grid grid-cols-4 gap-6 h-[calc(100vh-170px)] overflow-hidden"
                >
                    <!-- Sidebar -->
                    <SidebarMaterial
                        :course="props.course"
                        :currentOrder="currentOrder"
                        :order="props.order"
                        :defaultAccordionValue="defaultAccordionValue"
                    />

                    <div class="col-span-3 bg-neutral-20 p-6 overflow-y-auto">
                        <!-- Content -->
                        <ContentMaterial
                            :content="props.content"
                            :submission="props.submission"
                            :showSubmissionForm="showSubmissionForm"
                        />

                        <!-- Discussion -->
                        <Discussion
                            :content="props.content"
                            :submission="props.submission"
                            :showSubmissionForm="showSubmissionForm"
                            :selectedCommentId="selectedCommentId"
                            :toggleChildren="toggleChildren"
                            :formatDate="formatDate"
                            :classSlug="props.course.slug"
                        />

                        <!-- Submission -->
                        <SubmissionContent
                            :submission="props.submission"
                            :showSubmissionForm="showSubmissionForm"
                            :handleSubmissionClick="handleSubmissionClick"
                        />

                        <!-- File Upload Form -->
                        <UploadSubmission
                            :course="props.course"
                            :showSubmissionForm="showSubmissionForm"
                            :fileSubmitted="files"
                            :handleFileUpload="handleFileUpload"
                            :removeFile="removeFile"
                        />

                        <!-- Success Submission  -->
                        <div
                            v-if="
                                props.submission?.user_course_submissions !=
                                null
                            "
                            class="bg-neutral-10 p-6 rounded-xl"
                        >
                            <SuccessSubmission />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Next Prev -->
            <NextPrevMaterial
                :prevEpisode="prevEpisode"
                :nextEpisode="nextEpisode"
                :submission="props.submission"
            />
        </div>
    </SecondaryLayout>
</template>
