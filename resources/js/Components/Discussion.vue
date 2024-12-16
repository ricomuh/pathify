<script setup>
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/Components/ui/dialog";
import ChildDiscussion from "@/Components/ChildDiscussion.vue";
import { onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

// report
const reportOptions = [
    {
        value: "Pertanyaan ini tidak relevan",
        label: "Pertanyaan ini tidak relevan",
    },
    {
        value: "Pertanyaan ini mengandung unsur SARA",
        label: "Pertanyaan ini mengandung unsur SARA",
    },
    {
        value: "Pertanyaan ini adalah NSFW",
        label: "Pertanyaan ini adalah NSFW",
    },
    {
        value: "Pertanyaan ini tidak selayaknya ditanyakan",
        label: "Pertanyaan ini tidak selayaknya ditanyakan",
    },
    {
        value: "Pertanyaan ini adalah spam",
        label: "Pertanyaan ini adalah spam",
    },
    {
        value: "Pertanyaan ini adalah duplikat",
        label: "Pertanyaan ini adalah duplikat",
    },
    { value: "other", label: "Lainnya" },
];

const props = defineProps({
    content: Object,
    submission: Object,
    showSubmissionForm: Boolean,
    selectedCommentId: Number,
    toggleChildren: Function,
    formatDate: Function,
    classSlug: String,
});

// upvote comment
const formVote = useForm({
    is_upvote: true,
});

const upvoteComment = async (commentId) => {
    formVote.post(`/courses/${props.classSlug}/comment/${commentId}/vote`, {
        onSuccess: () => {
            formVote.reset();
        },
        onError: (errors) => {
            console.error("Validation errors:", errors);
        },
    });
};

const openChildDiscussion = (commentId) => {
    window.history.pushState({}, "", `?commentId=${commentId}`);
    props.toggleChildren(commentId);
};

// submit form
const form = useForm({
    title: "",
    body: "",
    course_content_id: props.content.id,
    parent_id: props.selectedCommentId,
});

const onSubmit = async () => {
    form.post(`/courses/${props.classSlug}/comment`, {
        onSuccess: () => {
            form.reset();
        },
        onError: (errors) => {
            console.error("Validation errors:", errors);
        },
    });
};

// report form
const selectedReason = ref("");
const description = ref("");

const showDialog = ref(true);

const openDialog = () => {
    showDialog.value = true;
};

const closeDialog = () => {
    showDialog.value = false;
};

const submitReport = (commentId) => {
    const form = useForm({
        reportable_type: "course_comments",
        reportable_id: commentId,
        reason: selectedReason.value,
        description: description.value || null,
    });

    form.post(route("reports.store"), {
        onSuccess: () => {
            // close the dialog
            closeDialog();
        },
        onError: () => {
            // close the dialog
            closeDialog();
        },
    });
};

onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const commentId = urlParams.get("commentId");
    if (commentId) {
        props.toggleChildren(Number(commentId));
    }
});
</script>

<template>
    <div v-if="!submission" class="p-6 rounded-xl">
        <div class="flex flex-col gap-6">
            <div
                v-if="selectedCommentId === null"
                class="flex justify-between items-center"
            >
                <h1 class="text-2xl-plus font-bold">Diskusi Terdahulu</h1>
                <div
                    class="flex gap-1 items-center py-3 px-4 rounded-xl border-2 border-neutral-40 bg-neutral-10 w-96"
                >
                    <img src="/media/icons/search.svg" alt="" />
                    <input
                        type="search"
                        class="outline-none !h-max py-0 px-0 border-0 bg-neutral-10 shadow-none !ring-0 w-full"
                        placeholder="Cari Pertanyaan"
                    />
                </div>
            </div>
            <!-- Form -->
            <form
                @submit.prevent="onSubmit"
                v-if="selectedCommentId === null"
                class="p-6 rounded-xl border-2 border-neutral-40 bg-neutral-10"
            >
                <div class="mb-3 w-full">
                    <label for="title" class="text-neutral-90 block mb-1"
                        >Judul Pertanyaan</label
                    >
                    <input
                        type="text"
                        id="title"
                        v-model="form.title"
                        name="title"
                        class="border-2 rounded-xl w-full py-3 px-6 border-neutral-40"
                        placeholder="Masukkan judul pertanyaan"
                    />
                </div>
                <div class="mb-6">
                    <label for="question" class="text-neutral-90 block mb-1">
                        Pertanyaan</label
                    >
                    <textarea
                        type="text"
                        rows="4"
                        v-model="form.body"
                        id="question"
                        name="question"
                        class="border-2 rounded-xl w-full py-3 px-6 border-neutral-40"
                        placeholder="Masukkan pertanyaan"
                    ></textarea>
                </div>
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="text-neutral-20 rounded-xl border-b-4 bg-primary border-primary-hover py-2 px-16"
                    >
                        Tanyakan
                    </button>
                </div>
            </form>

            <!-- Discuss content -->
            <div v-if="selectedCommentId === null" class="flex flex-col gap-6">
                <div
                    v-for="(value, key) in content?.comments"
                    :key="key"
                    class="p-6 rounded-xl bg-neutral-10 flex flex-col gap-6"
                >
                    <div class="flex gap-3 items-center">
                        <img
                            :src="value.user.profile_picture"
                            class="size-11 rounded-full object-cover"
                            alt=""
                        />
                        <div class="flex gap-2.5 items-center">
                            <p class="text-lg font-bold">
                                {{ value.user.fullname }}
                            </p>
                            <img src="/media/icons/dot.svg" alt="" />
                            <p class="text-neutral-80">
                                {{ formatDate(value.created_at) }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ value.title }}
                        </h1>
                        <p class="text-neutral-90 text-lg">
                            {{ value.body }}
                        </p>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex gap-6 items-center">
                            <!-- Total Discuss -->
                            <button
                                @click="openChildDiscussion(value.id)"
                                type="button"
                                class="flex gap-3 items-center"
                            >
                                <img
                                    src="/media/icons/discuss.svg"
                                    alt=""
                                    class="size-6"
                                />
                                <p class="text-neutral-80 text-lg">
                                    {{
                                        value.children?.length > 0
                                            ? value.children.length
                                            : 0
                                    }}
                                    Diskusi
                                </p>
                            </button>

                            <!-- Upvote -->
                            <button
                                @click="upvoteComment(value.id)"
                                class="flex gap-3 items-center"
                                type="button"
                                :class="{
                                    'bg-primary-surface p-3 rounded-3xl':
                                        value.voted?.is_upvote == 1,
                                }"
                            >
                                <img
                                    :src="
                                        value.voted?.is_upvote == 1
                                            ? '/media/icons/chevron-up-primary.svg'
                                            : '/media/icons/chevron-up.svg'
                                    "
                                    alt=""
                                    class="size-6"
                                />
                                <p
                                    class="text-lg"
                                    :class="
                                        value.voted?.is_upvote == 1
                                            ? 'text-primary'
                                            : 'text-neutral-80 '
                                    "
                                >
                                    {{ value.upvotes_count }}
                                </p>
                            </button>
                        </div>
                        <!-- Report -->
                        <Dialog v-if="showDialog">
                            <DialogTrigger as-child>
                                <button type="button" @click="openDialog">
                                    <img
                                        src="/media/icons/report.svg"
                                        alt=""
                                        class="size-6"
                                    />
                                </button>
                            </DialogTrigger>
                            <DialogContent class="sm:max-w-[425px]">
                                <DialogHeader>
                                    <DialogTitle
                                        >Laporkan Pertanyaan</DialogTitle
                                    >
                                </DialogHeader>
                                <div class="flex flex-col gap-3">
                                    <div
                                        v-for="option in reportOptions"
                                        :key="option.value"
                                        class="flex gap-4 items-center"
                                    >
                                        <input
                                            type="radio"
                                            :name="`report-${value.id}`"
                                            :id="option.value"
                                            :value="option.value"
                                            v-model="selectedReason"
                                        />
                                        <label
                                            :for="option.value"
                                            class="text-lg text-neutral-90"
                                        >
                                            {{ option.label }}
                                        </label>
                                    </div>
                                    <textarea
                                        v-model="description"
                                        placeholder="Tambahkan deskripsi (opsional)"
                                        class="border rounded p-2"
                                    ></textarea>
                                </div>
                                <DialogFooter>
                                    <button
                                        type="button"
                                        class="text-lg w-full text-neutral-20 bg-primary border-b-4 rounded-xl border-primary-hover py-2 px-6"
                                        @click="submitReport(value.id)"
                                    >
                                        Laporkan
                                    </button>
                                </DialogFooter>
                            </DialogContent>
                        </Dialog>
                    </div>
                </div>
            </div>

            <!-- Child Discussions -->
            <div v-if="selectedCommentId !== null">
                <ChildDiscussion
                    :content="props.content"
                    :selectedCommentId="selectedCommentId"
                    :formatDate="formatDate"
                    :toggleChildren="toggleChildren"
                    :classSlug="classSlug"
                />
            </div>
        </div>
    </div>
</template>
