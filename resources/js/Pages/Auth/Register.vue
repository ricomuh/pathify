<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TitleAuth from "@/Components/TitleAuth.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import eyeIcon from "../../../images/icons/eye.svg";
import eyeCloseIcon from "../../../images/icons/eye-close.svg";
import { ref } from "vue";

// data form
const form = useForm({
    firstName: "",
    lastName: "",
    fullname: "",
    email: "",
    password: "",
    password_confirmation: "",
    username: "",
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
    form.fullname = `${form.firstName} ${form.lastName}`.trim();

    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Daftar" />

        <TitleAuth
            title="Selamat Bergabung"
            subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua."
        />

        <form @submit.prevent="submit">
            <div class="grid md:grid-cols-2 gap-3">
                <div>
                    <InputLabel for="firstName" value="Nama Depan" />
                    <TextInput
                        id="firstName"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.firstName"
                        required
                        autofocus
                        autocomplete="given-name"
                        placeholder="Masukkan nama depan"
                    />
                    <InputError class="mt-2" :message="form.errors.firstName" />
                </div>
                <div>
                    <InputLabel for="lastName" value="Nama Belakang" />
                    <TextInput
                        id="lastName"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.lastName"
                        required
                        autocomplete="family-name"
                        placeholder="Masukkan nama belakang"
                    />
                    <InputError class="mt-2" :message="form.errors.lastName" />
                </div>
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                    placeholder="Masukkan email Anda"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="mt-4">
                <InputLabel for="username" value="Username" />

                <TextInput
                    id="username"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.username"
                    required
                    autocomplete="username"
                    placeholder="Masukkan username Anda"
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
                    Buat Akun
                </PrimaryButton>
            </div>
        </form>
        <div class="mt-3 flex justify-center gap-3 items-center">
            <span class="text-neutral-80">Sudah punya akun?</span>
            <Link
                :href="route('login')"
                class="text-primary font-bold underline"
            >
                Masuk di sini!
            </Link>
        </div>
    </GuestLayout>
</template>
