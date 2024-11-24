<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TitleAuth from "@/Components/TitleAuth.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <GuestLayout>
        <Head title="Lupa Kata Sandi" />

        <TitleAuth
            title="Pulihkan akun Anda"
            subtitle=" Silahkan isikan alamat email Anda, dan link untuk reset kata
                sandi akan muncul di sana"
        />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Masukkan email Anda"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-12 flex items-center justify-end">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Kirim Link Masuk
                </PrimaryButton>
            </div>
        </form>
        <div class="mt-3 text-center">
            <Link href="#" class="text-primary font-bold underline">
                Tidak bisa ubah password Anda?
            </Link>
        </div>

        <div
            class="flex gap-[0.63rem] w-full justify-center items-center mt-12"
        >
            <div class="h-[0.0625rem] w-1/2 bg-neutral-60"></div>
            <p class="text-neutral-80">atau</p>
            <div class="h-[0.0625rem] w-1/2 bg-neutral-60"></div>
        </div>
        <Link
            :href="route('register')"
            class="text-primary block text-center mt-3 text-xl font-bold"
        >
            Buat akun baru
        </Link>
    </GuestLayout>
</template>
