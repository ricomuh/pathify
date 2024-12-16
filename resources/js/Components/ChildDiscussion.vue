<script setup>
import { useForm } from "@inertiajs/vue3";
import { defineProps, ref } from "vue";
import SuccessAlert from "@/Components/SuccessAlert.vue";

const props = defineProps({
    content: { type: Object, required: true },
    selectedCommentId: { type: Number, required: true },
    formatDate: { type: Function, required: true },
    toggleChildren: { type: Function, required: true },
    classSlug: { type: String, required: true },
});

// upvote
const formVote = useForm({
    is_upvote: true,
});

const upvoteComment = async (commentId) => {
    formVote.post(`/courses/${props.classSlug}/comment/${commentId}/vote`, {
        onSuccess: () => {
            successMessage.value = ref("Berhasil memberikan suara");
            showSuccessAlert.value = true;
            formVote.reset();
        },
        onError: (errors) => {
            console.error("Validation errors:", errors);
        },
    });
};

// submit discussion
const form = useForm({
    title: "",
    body: "",
    course_content_id: props.content.id,
    parent_id: props.selectedCommentId,
});

const successMessage = ref("");
const showSuccessAlert = ref(false);

const onSubmit = async () => {
    form.post(`/courses/${props.classSlug}/comment`, {
        onSuccess: () => {
            successMessage.value = ref("Balasan berhasil ditambahkan");
            showSuccessAlert.value = true;
            form.reset();
        },
        onError: (errors) => {
            console.error("Validation errors:", errors);
        },
    });
};

// back
const goBack = () => {
    window.history.back();
};
</script>

<template>
    <!-- Success Alert -->
    <SuccessAlert v-if="showSuccessAlert" :message="successMessage" />
    <button @click="goBack" class="mb-4 p-2 bg-gray-200 rounded">Back</button>
    <div v-for="(value, key) in content?.comments" :key="key">
        <div v-if="selectedCommentId === value.id" class="child-discussions">
            <div class="p-6 rounded-xl bg-neutral-10 flex flex-col gap-6">
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
                <div class="flex gap-6 items-center">
                    <!-- Total Discuss -->
                    <button type="button" class="flex gap-3 items-center">
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
            </div>
            <!-- Form -->
            <form
                @submit.prevent="onSubmit"
                class="p-6 border-2 border-neutral-40 bg-neutral-10 flex justify-between gap-6"
            >
                <textarea
                    v-model="form.body"
                    class="w-full h-12 bg-neutral-10 p-3 rounded-xl"
                    placeholder="Tulis Balasanmu"
                ></textarea>
                <button
                    type="submit"
                    class="bg-primary h-auto px-10 rounded-xl border-b-4 border-primary-hover text-neutral-20"
                >
                    Balas
                </button>
            </form>

            <!-- If have a child -->
            <div v-if="value.children">
                <div
                    v-for="child in value.children"
                    :key="child.id"
                    class="m-6"
                >
                    <div
                        class="p-6 rounded-xl bg-neutral-10 flex flex-col gap-6"
                    >
                        <div class="flex gap-3 items-center">
                            <img
                                :src="child.user.profile_picture"
                                class="size-11 rounded-full object-cover"
                                alt=""
                            />
                            <div class="flex gap-2.5 items-center">
                                <p class="text-lg font-bold">
                                    {{ child.user.fullname }}
                                </p>
                                <img src="/media/icons/dot.svg" alt="" />
                                <p class="text-neutral-80">
                                    {{ formatDate(child.created_at) }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">
                                {{ child.title }}
                            </h1>
                            <p class="text-neutral-90">
                                {{ child.body }}
                            </p>
                        </div>
                        <div class="flex gap-6 items-center">
                            <!-- Total Discuss -->
                            <button
                                @click="toggleChildren(child.id)"
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
                                        child.children?.length > 0
                                            ? child.children.length
                                            : 0
                                    }}
                                    Diskusi
                                </p>
                            </button>

                            <!-- Upvote -->
                            <button
                                @click="upvoteComment(child.id)"
                                class="flex gap-3 items-center"
                                type="button"
                                :class="{
                                    'bg-primary-surface p-3 rounded-3xl':
                                        child.voted?.is_upvote == 1,
                                }"
                            >
                                <img
                                    :src="
                                        child.voted?.is_upvote == 1
                                            ? '/media/icons/chevron-up-primary.svg'
                                            : '/media/icons/chevron-up.svg'
                                    "
                                    alt=""
                                    class="size-6"
                                />
                                <p
                                    class="text-lg"
                                    :class="
                                        child.voted?.is_upvote == 1
                                            ? 'text-primary'
                                            : 'text-neutral-80 '
                                    "
                                >
                                    {{ child.upvotes_count }}
                                </p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- If no -->
            <div v-else>
                <div class="m-6 text-center">
                    <p class="text-xl text-neutral-80">Belum ada balasan</p>
                </div>
            </div>
        </div>
    </div>
</template>
