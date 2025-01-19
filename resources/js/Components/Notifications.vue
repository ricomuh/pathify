<script setup lang="ts">
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>

<template>
    <div class="relative">
        <Dropdown align="right" width="48">
            <template #trigger>
                <div class="inline-flex">
                    <button
                        type="button"
                        class="size-10 border-[3px] border-primary-surface bg-primary-surface rounded-xl flex items-center justify-center hover:!bg-primary-focus transition-all duration-200 ease-in-out"
                    >
                        <img
                            src="../../images/icons/notification.svg"
                            alt=""
                            class="h-full w-full p-1.5 object-cover"
                        />
                    </button>
                </div>
            </template>
            <template #content>
                <div class="py-3 px-4">
                    <h1 class="text-lg font-bold text-neutral-100">
                        Notifikasi
                    </h1>
                    <p class="text-neutral-80 text-center text-sm mt-2">
                        Tidak ada notifikasi
                    </p>
                </div>
            </template>
        </Dropdown>
    </div>
</template>
