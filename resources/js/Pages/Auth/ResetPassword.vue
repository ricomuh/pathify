<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TitleAuth from "@/Components/TitleAuth.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";
import eyeIcon from "../../../images/icons/eye.svg";
import eyeCloseIcon from "../../../images/icons/eye-close.svg";
import { ref } from "vue";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

// show confirmation password
const showConfirmPassword = ref(false);
const togglePasswordConfirmationVisibility = () => {
    showConfirmPassword.value = !showConfirmPassword.value;
};

// show password
const showPassword = ref(false);
const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const submit = () => {
    form.post(route("password.store"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Ubah Kata Sandi" />

        <TitleAuth
            title="Buat Kata Sandi Baru"
            subtitle=" Silahkan buat kata sandi baru untuk masuk ke akun Anda"
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
                    autocomplete="email"
                    placeholder="Masukkan email Anda"
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
                        autocomplete="new-password"
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

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Konfirmasi Kata Sandi"
                />

                <div class="relative">
                    <TextInput
                        id="password_confirmation"
                        :type="showConfirmPassword ? 'text' : 'password'"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="******************"
                    />
                    <button
                        type="button"
                        @click="togglePasswordConfirmationVisibility"
                        class="absolute right-4 top-1/2 -translate-y-1/2"
                    >
                        <img
                            :src="showConfirmPassword ? eyeIcon : eyeCloseIcon"
                            alt="Toggle Password Visibility"
                        />
                    </button>
                </div>

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-12 flex items-center justify-end">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Ubah Kata Sandi
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
