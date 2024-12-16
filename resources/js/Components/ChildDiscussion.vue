<script setup lang="ts">
const props = defineProps({
    content: { type: Object, required: true },
    selectedCommentId: { type: Number, required: true },
    formatDate: { type: Function, required: true },
    toggleChildren: { type: Function, required: true },
    classSlug: { type: String, required: true },
});

// upvote
const upvoteComment = async (commentId: number) => {
    try {
        const response = await fetch(
            `/courses/${props.classSlug}/comment/${commentId}/vote`,
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ is_upvote: true }),
            }
        );
        const data = await response.json();
        // Handle the response if needed
        console.log(data);
    } catch (error) {
        console.error("Failed to upvote the comment:", error);
    }
};

// back
const goBack = () => {
    window.history.back();
};
</script>

<template>
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
            <div
                class="p-6 border-2 border-neutral-40 bg-neutral-10 flex justify-between gap-6"
            >
                <textarea
                    class="w-full h-12 bg-neutral-10 p-3 rounded-xl"
                    placeholder="Tulis Balasanmu"
                ></textarea>
                <button
                    type="button"
                    class="bg-primary h-auto px-10 rounded-xl border-b-4 border-primary-hover text-neutral-20"
                >
                    Balas
                </button>
            </div>

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
