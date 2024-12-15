<script setup lang="ts">
const props = defineProps({
    content: { type: Object, required: true },
    selectedCommentId: { type: Number, required: true },
    formatDate: { type: Function, required: true },
    toggleChildren: { type: Function, required: true },
});
</script>

<template>
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
                    <button
                        @click="toggleChildren(value.id)"
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
                    <button class="flex gap-3 items-center" type="button">
                        <img
                            src="/media/icons/chevron-up.svg"
                            alt=""
                            class="size-6"
                        />
                        <p class="text-neutral-80 text-lg">
                            {{ value.upvotes_count }}
                        </p>
                    </button>
                </div>
            </div>
            <div
                v-for="child in value.children"
                :key="child.id"
                class="child-discussion"
            >
                <h2 class="text-xl font-bold">
                    {{ child.title }}
                </h2>
                <p class="text-neutral-90 text-lg">
                    {{ child.body }}
                </p>
            </div>
        </div>
    </div>
</template>
