<script setup lang="ts">
const props = defineProps({
    course: { type: Object, required: true },
    showSubmissionForm: { type: Boolean, required: true },
    fileSubmitted: { type: Array, required: true },
    handleFileUpload: { type: Function, required: true },
    removeFile: { type: Function, required: true },
});
</script>

<template>
    <div v-if="showSubmissionForm" class="bg-neutral-10 p-6 rounded-xl">
        <h1 class="text-5xl font-bold leading-[3.5rem] mb-6">Submission</h1>
        <form
            :action="`/courses/${props.course.slug}/submission`"
            method="POST"
            enctype="multipart/form-data"
        >
            <!-- Form -->
            <div v-if="fileSubmitted.length === 0" class="mb-6">
                <label
                    for="file"
                    class="flex flex-col gap-4 justify-center items-center py-24 border-dashed border-4 bg-neutral-10 border-neutral-40 rounded-xl cursor-pointer"
                >
                    <img src="/media/icons/upload.svg" alt="" />
                    <span class="text-xl-plus text-neutral-90"
                        >Silahkan upload file anda disini</span
                    >
                </label>
                <input
                    type="file"
                    id="file"
                    name="file"
                    class="hidden w-full text-neutral-90 text-lg border border-neutral-40 rounded-xl py-2 px-4"
                    required
                    multiple
                    @change="handleFileUpload"
                />
            </div>

            <!-- Preview -->
            <div v-else class="mb-6 flex flex-col gap-4">
                <div
                    v-for="(file, index) in fileSubmitted"
                    :key="index"
                    class="flex justify-between items-center gap-3"
                >
                    <div class="flex gap-4 items-center">
                        <img src="/media/icons/file.svg" alt="" />
                        <p class="text-xl-plus text-neutral-90">
                            {{ file.name }}
                        </p>
                    </div>
                    <button type="button" @click="removeFile(index)">
                        <img src="/media/icons/close.svg" alt="" />
                    </button>
                </div>
            </div>
            <button
                type="submit"
                class="w-full py-3 text-2xl text-neutral-20 bg-primary border-b-4 rounded-xl border-primary-hover"
            >
                Kumpulkan
            </button>
        </form>
    </div>
</template>
