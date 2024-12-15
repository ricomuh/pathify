<script setup lang="ts">
import { Link, useForm, Head } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { Progress } from "@/Components/ui/progress";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const isStart = ref(false);
const progress = ref(0);
const currentQuestionIndex = ref(0);
const selectedAnswer = ref(null);
const answers = ref([]);
const isAnswering = ref(false);

const form = useForm({
    answers: [],
});

const handleSelect = (answer, answerId) => {
    if (isAnswering.value) return; // Prevent double-clicking
    isAnswering.value = true;
    selectedAnswer.value = answer;
    answers.value[currentQuestionIndex.value] = { id: answerId };
    setTimeout(() => {
        nextQuestion();
        isAnswering.value = false; // Re-enable the buttons
    }, 500); // Add a slight delay for better UX
};

const nextQuestion = () => {
    if (currentQuestionIndex.value < props.questionnaireQuestions.length - 1) {
        currentQuestionIndex.value++;
        selectedAnswer.value = null; // Reset the selected answer for the next question
    } else {
        // Show confirmation modal
        showModal.value = true;
    }
};

const showModal = ref(false);

const submitForm = () => {
    form.answers = answers.value;
    form.post(route("questionnaire.store"));
};

watch(currentQuestionIndex, (newIndex) => {
    progress.value = Number(
        (((newIndex + 1) / props.questionnaireQuestions.length) * 100).toFixed(
            0
        )
    );
});

interface Question {
    question: string;
    answers: {
        answer: string;
        id: number;
    }[];
}

const props = defineProps<{
    questionnaireQuestions: Question[];
}>();
</script>

<template>
    <Head title="Quisioner Personifikasi" />

    <AuthenticatedLayout v-if="!isStart">
        <!-- Content -->
        <div
            class="bg-neutral-20 flex justify-center flex-col pt-32 pb-12 md:w-5/6 mx-auto"
        >
            <div class="container">
                <div
                    class="bg-neutral-10 rounded-3xl xl:w-4/5 py-12 px-6 mx-auto"
                >
                    <img
                        src="/media/illustrations/test.png"
                        class="mx-auto max-h-96 xl:max-h-[30rem]"
                        alt=""
                    />
                    <div class="flex flex-col justify-between">
                        <div class="flex flex-col gap-3">
                            <h1
                                class="text-3xl md:text-4xl md:leading-[3rem] leading-10 xl:text-5xl xl:leading-[3.75rem] font-bold"
                            >
                                Luangkan waktu untuk mengenali potensi dirimu
                            </h1>
                            <p
                                class="text-xl xl:text-2xl text-neutral-90 xl:leading-[2rem]"
                            >
                                Selamat datang di Quisioner Personifikasi!
                                Setiap jawaban yang anda pilih merepresentasikan
                                diri anda. Kenali potensi dirimu untuk karir
                                yang lebih cemerlang.
                            </p>
                            <p
                                class="text-xl xl:text-2xl text-neutral-90 xl:leading-[2rem]"
                            >
                                Setelah anda mengisikan quisioner ini, kami akan
                                memberikan rekomendasi kursus yang sesuai hanya
                                untuk anda!
                            </p>
                            <p
                                class="text-xl xl:text-2xl text-neutral-90 xl:leading-[2rem]"
                            >
                                Ingatlah untuk meluangkan waktu dan tidak
                                mengisi dengan tergesa - gesa agar mendapatkan
                                hasil yang lebih maksimal
                            </p>
                            <p
                                class="text-xl xl:text-2xl text-neutral-90 xl:leading-[2rem]"
                            >
                                Siapkah kalian untuk menggali potensi anda lebih
                                dalam?
                            </p>
                        </div>
                        <button
                            @click="isStart = true"
                            type="button"
                            class="text-white mt-12 w-full font-bold text-xl xl:text-2xl py-4 px-9 bg-primary rounded-3xl block"
                        >
                            Ikuti Tes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <!-- Start -->
    <div v-else>
        <!-- Header -->
        <div class="bg-primary-pressed py-3">
            <div class="container">
                <div class="flex gap-6 items-center py-2">
                    <Progress
                        :model-value="progress"
                        class="bg-white w-full border-none h-3"
                    />
                    <p class="text-white font-bold text-2xl xl:text-2xl-plus">
                        {{ progress }}%
                    </p>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div
            class="bg-neutral-20 h-[calc(100vh-85px)] flex justify-center flex-col"
        >
            <div class="container">
                <div
                    class="md:w-5/6 lg:w-4/5 xl:w-3/5 mx-auto h-[calc(100vh-200px)] flex flex-col justify-between"
                >
                    <transition name="slide-fade" mode="out-in">
                        <div
                            :key="currentQuestionIndex"
                            class="flex flex-col gap-12"
                        >
                            <div class="flex flex-col gap-3">
                                <p
                                    class="text-2xl xl:text-2xl-plus text-primary leading-[2.1rem]"
                                >
                                    Soal {{ currentQuestionIndex + 1 }}
                                </p>
                                <h1
                                    class="text-3xl-plus xl:text-4xl-plus font-bold leading-[2.775rem] text-neutral-90"
                                >
                                    {{
                                        props.questionnaireQuestions[
                                            currentQuestionIndex
                                        ].question
                                    }}
                                </h1>
                            </div>
                            <div class="flex flex-col gap-3">
                                <div
                                    v-for="(answer, index) in props
                                        .questionnaireQuestions[
                                        currentQuestionIndex
                                    ].answers"
                                    :key="index"
                                    class="rounded-xl p-4 md:p-6 flex gap-6 items-center cursor-pointer"
                                    @click="
                                        handleSelect(answer.answer, answer.id)
                                    "
                                    :class="
                                        selectedAnswer === answer.answer
                                            ? 'bg-primary-pressed'
                                            : 'bg-primary'
                                    "
                                    :disabled="isAnswering"
                                >
                                    <p
                                        class="text-2xl xl:text-2xl-plus text-white"
                                    >
                                        {{ answer.answer }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div
        v-if="showModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
    >
        <div class="bg-white p-6 rounded-xl">
            <h2 class="text-2xl font-bold mb-4">Confirm Submission</h2>
            <p class="mb-4">Are you sure you want to submit your answers?</p>
            <div class="flex gap-4">
                <button
                    @click="submitForm"
                    class="bg-primary text-white py-2 px-4 rounded-xl"
                >
                    Yes
                </button>
                <button
                    @click="showModal = false"
                    class="bg-neutral-500 text-white py-2 px-4 rounded-xl"
                >
                    No
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden Form -->
    <form @submit.prevent="submitForm" class="hidden">
        <div v-for="(answer, index) in answers" :key="index">
            <input
                type="hidden"
                :name="'answers[' + index + '][id]'"
                :value="answer.id"
            />
        </div>
    </form>
</template>

<style scoped>
.hidden {
    display: none;
}

.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.5s ease;
}

.slide-fade-enter, .slide-fade-leave-to /* .slide-fade-leave-active in <2.1.8 */ {
    transform: translateX(100%);
    opacity: 0;
}

.slide-fade-leave-active {
    transform: translateX(-100%);
    opacity: 0;
}
</style>
