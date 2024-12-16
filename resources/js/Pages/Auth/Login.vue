<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TitleAuth from "@/Components/TitleAuth.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import eyeIcon from "../../../images/icons/eye.svg";
import eyeCloseIcon from "../../../images/icons/eye-close.svg";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

const showPassword = ref(false);

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};
</script>

<template>
    <GuestLayout>
        <Head title="Masuk" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <TitleAuth
            title="Selamat Bergabung"
            subtitle="Lanjutkan perjalanan anda dalam dunia Teknologi. Bersama Pathify, perjalanan karir anda akan menjadi lebih mudah."
        />
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
                    placeholder="Masukkan email Anda"
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Kata Sandi" />

                <div class="relative">
                    <TextInput
                        id="password"
                        :type="showPassword ? 'text' : 'password'"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete
                        placeholder="******************"
                    />
                    <button
                        type="button"
                        @click="togglePasswordVisibility"
                        class="absolute right-4 top-1/2 -translate-y-1/2"
                    >
                        <img
                            :src="showPassword ? eyeIcon : eyeCloseIcon"
                            alt="Toggle Password Visibility"
                        />
                    </button>
                </div>

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-3 mb-12 flex items-center justify-end">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-primary font-bold underline"
                >
                    Lupa kata sandi?
                </Link>
            </div>
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Masuk
            </PrimaryButton>
            <div class="mt-3 flex justify-center gap-3 items-center">
                <span class="text-neutral-80">Belum punya akun?</span>
                <Link
                    :href="route('register')"
                    class="text-primary font-bold underline"
                >
                    Buat Akun di sini!
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
