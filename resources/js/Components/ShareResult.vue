<script setup>
import { ref } from "vue";
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from "@/Components/ui/alert-dialog";

const profileUrl = window.location.href;

const copyToClipboard = async (text) => {
    try {
        await navigator.clipboard.writeText(text);
        alert("URL copied to clipboard!");
    } catch (err) {
        console.error("Failed to copy: ", err);
    }
};

const shareOnFacebook = () => {
    const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
        profileUrl
    )}`;
    window.open(url, "_blank");
};

const shareOnTwitter = () => {
    const url = `https://x.com/intent/tweet?text=${encodeURIComponent(
        profileUrl
    )}`;

    window.open(url, "_blank");
};

const shareOnWhatsapp = () => {
    const url = `https://api.whatsapp.com/send?text=${encodeURIComponent(
        profileUrl
    )}`;
    window.open(url, "_blank");
};

const props = defineProps({
    image: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div>
        <!-- Share -->
        <AlertDialog>
            <AlertDialogTrigger as-child>
                <button type="button" class="p-3 rounded-xl bg-neutral-20">
                    <img src="/media/icons/share.svg" class="h-6" alt="" />
                </button>
            </AlertDialogTrigger>
            <AlertDialogContent>
                <AlertDialogHeader>
                    <div class="flex justify-between items-center gap-4">
                        <AlertDialogTitle>Bagikan Hasilmu</AlertDialogTitle>
                        <AlertDialogCancel>
                            <img src="/media/icons/close.svg" alt="" />
                        </AlertDialogCancel>
                    </div>
                    <AlertDialogDescription class="flex flex-col gap-6">
                        <div>
                            <img
                                :src="props.image"
                                class="h-56 mx-auto mb-2.5"
                                alt=""
                            />
                            <div class="flex gap-3 items-center justify-center">
                                <div class="w-20 flex flex-col items-center">
                                    <button
                                        type="button"
                                        class="p-3 rounded-full border border-neutral-30 bg-neutral-10 text-white"
                                        @click="shareOnFacebook"
                                    >
                                        <img
                                            src="/media/icons/fb.svg"
                                            class="h-6"
                                            alt=""
                                        />
                                    </button>
                                    <p class="text-neutral-80">Facebook</p>
                                </div>
                                <div class="w-20 flex flex-col items-center">
                                    <button
                                        type="button"
                                        class="p-3 rounded-full border border-neutral-30 bg-neutral-10 text-white"
                                        @click="shareOnTwitter"
                                    >
                                        <img
                                            src="/media/icons/x.svg"
                                            class="h-6"
                                            alt=""
                                        />
                                    </button>
                                    <p class="text-neutral-80">Twitter</p>
                                </div>
                                <div class="w-20 flex flex-col items-center">
                                    <button
                                        type="button"
                                        class="p-3 rounded-full border border-neutral-30 bg-neutral-10 text-white"
                                        @click="shareOnWhatsapp"
                                    >
                                        <img
                                            src="/media/icons/wa.svg"
                                            class="h-6"
                                            alt=""
                                        />
                                    </button>
                                    <p class="text-neutral-80">Whatsapp</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h1 class="text-2xl xl:text-2xl-plus font-bold">
                                Bagikan tipe dirimu
                            </h1>
                            <p class="mb-3 text-neutral-80">
                                Bagikan tipe dirimu, lengkap beserta
                                prosentasenya
                            </p>
                            <div
                                class="flex gap-3 items-center w-full py-3 px-6 border-2 bg-neutral-10 rounded-xl border-neutral-40"
                            >
                                <input
                                    type="text"
                                    disabled
                                    :value="profileUrl"
                                    class="shadow-none p-0 outline-none border-none ring-0 w-full text-neutral-70 bg-transparent"
                                />
                                <button
                                    type="button"
                                    class="p-1"
                                    @click="copyToClipboard(profileUrl)"
                                >
                                    <img src="/media/icons/copy.svg" alt="" />
                                </button>
                            </div>
                        </div>
                    </AlertDialogDescription>
                </AlertDialogHeader>
            </AlertDialogContent>
        </AlertDialog>
    </div>
</template>

<style scoped>
/* Add any custom styles here */
</style>
