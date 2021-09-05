<template>
    <app-layout title="Show Question">
        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="md:grid md:grid-cols-3 md:gap-6">

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="sm:overflow-hidden">
                                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Question Title
                                        </label>
                                        <div class="mt-1">
                                            <p>{{ question.question_title}}</p>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">
                                            Right Answer
                                        </label>
                                        <div class="mt-1">
                                            <b>{{ question.right_ans === 1? 'Yes': 'No'}}</b>
                                        </div>
                                    </div>

                                    <div class="col-span-3 sm:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Hindi Question Audios
                                        </label>
                                        <div class="mt-2">
                                            <audio controls>
                                                <source :src="question.hin_aud_path" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">
                                            English Question Audios
                                        </label>
                                        <div class="mt-2">
                                            <audio controls>
                                                <source :src="question.eng_aud_path" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">
                                            Gujrati Question Audios
                                        </label>
                                        <div class="mt-2">
                                            <audio controls>
                                                <source :src="question.guj_aud_path" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="md:col-span-1">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Right Answer Image
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <img :src="question.right_img_path" alt="" style="height: 200px">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Wrong Answer Image
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <img :src="question.wrong_img_path" alt="" style="height: 200px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-1">
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-12">
                            <Link class="btn bg-blue text-blue-800" :href="route('questions.edit', question.question_id)" >
                                Edit
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
export default {
    name: "ShowQuestion",
    props:['question'],
    components: {
        AppLayout,
        Link
    },
    data(){
        return{

        }
    },
    mounted() {

    },
    methods:{

    }
}
</script>

<style scoped>

</style>
