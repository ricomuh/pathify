<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
const dashboardURL =
    page.props.auth.role == "Admin"
        ? route("admin.dashboard")
        : page.props.auth.role == "Mentor"
        ? route("mentor.dashboard")
        : route("user.dashboard");
</script>

<template>
    <div class="relative">
        <Dropdown align="right" width="48">
            <template #trigger>
                <button
                    type="button"
                    class="size-10 rounded-xl border-[3px] border-primary-border overflow-hidden hover:bg-primary-focus hover:text-primary transition-all duration-200 ease-in-out"
                >
                    <img
                        :src="$page.props.auth.user.profile_picture"
                        alt=""
                        class="h-full w-full object-cover"
                    />
                </button>
            </template>
            <template #content>
                <DropdownLink :href="dashboardURL">Dashboard</DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button"
                    >Log Out</DropdownLink
                >
            </template>
        </Dropdown>
    </div>
</template>
