<template>
    <app-layout title="Update Question">
        <div class="py-12">
            <form action="" @submit.prevent="formSubmit()">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="md:grid md:grid-cols-3 md:gap-6">

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="sm:overflow-hidden">
                                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="question_title" class="block text-sm font-medium text-gray-700">
                                            Question Title
                                        </label>
                                        <div class="mt-1">
                                            <input type="text" v-model="form.question_title" name="question_title" id="question_title" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="Question title" />
                                            <jet-input-error v-if="form.errors.question_title" :message="form.errors.question_title" class="mt-2" />
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">
                                            Right Answer
                                        </label>
                                        <div class="mt-1">
                                            <div class="flex items-center">
                                                <input id="yes" v-model="form.right_ans" value="1"  name="right_ans" type="radio" class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300" />
                                                <label for="yes" class="ml-3 block text-sm font-medium text-gray-700">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="flex items-center mt-3">
                                                <input id="no" v-model="form.right_ans"  value="0" name="right_ans" type="radio" class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300" />
                                                <label for="no" class="ml-3 block text-sm font-medium text-gray-700">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <jet-input-error v-if="form.errors.right_ans" :message="form.errors.right_ans" class="mt-2" />
                                        <p class="mt-2 text-sm text-gray-500">
                                            Select the answer. if answer is yes then choose yes or choose no
                                        </p>
                                    </div>

                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="hindi_audio" class="block text-sm font-medium text-gray-700">
                                            Hindi Question Audios
                                        </label>
                                        <div class="mt-1">
                                            <input type="file" @input="form.hindi_audio = $event.target.files[0]"  name="hindi_audio" id="hindi_audio" class="mt-1" accept=".mp3,audio/*" />
                                        </div>

                                        <div class="mt-2" v-if="question.hin_aud_path">
                                            <label for="hindi_audio" class="block text-sm font-medium text-gray-700">
                                                Old Audios
                                            </label>
                                            <audio controls>
                                                <source :src="question.hin_aud_path" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                        <jet-input-error v-if="form.errors.hindi_audio" :message="form.errors.hindi_audio" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="english_audio" class="block text-sm font-medium text-gray-700">
                                            English Question Audios
                                        </label>
                                        <div class="mt-1">
                                            <input type="file" @input="form.english_audio = $event.target.files[0]" name="english_audio" id="english_audio" class="mt-1" accept=".mp3,audio/*"/>
                                        </div>

                                        <div class="mt-2" v-if="question.eng_aud_path">
                                            <label for="english_audio" class="block text-sm font-medium text-gray-700">
                                                Old Audios
                                            </label>
                                            <audio controls>
                                                <source :src="question.eng_aud_path" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                        <jet-input-error v-if="form.errors.english_audio" :message="form.errors.english_audio" class="mt-2" />
                                    </div>
                                    <div>
                                        <label for="gujrati_audio" class="block text-sm font-medium text-gray-700">
                                            Gujrati Question Audios
                                        </label>
                                        <div class="mt-1">
                                            <input type="file" @input="form.gujrati_audio = $event.target.files[0]" name="gujrati_audio" id="gujrati_audio" accept=".mp3,audio/*" />
                                        </div>

                                        <div class="mt-2" v-if="question.guj_aud_path">
                                            <label for="gujrati_audio" class="block text-sm font-medium text-gray-700">
                                                Old Audios
                                            </label>
                                            <audio controls>
                                                <source :src="question.guj_aud_path" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                        <jet-input-error v-if="form.errors.gujrati_audio" :message="form.errors.gujrati_audio" class="mt-2" />
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
                                        <div class="space-y-1 text-center" v-if="!right_img_p">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="right_ans_img" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file</span>
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG up to 500KB
                                            </p>
                                        </div>
                                        <label for="right_ans_img" v-if="right_img_p">
                                            <img :src="right_img_p" alt="" style="height: 200px">
                                        </label>
                                        <input id="right_ans_img" name="right_ans_img" type="file" class="sr-only"
                                               ref="RightImagePath"
                                               @change="updateRightPreview"
                                               @input="form.right_ans_img = $event.target.files[0]"
                                               accept="image/jpeg,png,jpg"
                                        />
                                    </div>
                                    <jet-input-error v-if="form.errors.right_ans_img" :message="form.errors.right_ans_img" class="mt-2" />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Wrong Answer Image
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center" v-if="!wrong_img_p">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="wrong_ans_img" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file</span>
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG up to 500KB
                                            </p>
                                        </div>
                                        <label for="wrong_ans_img" v-if="wrong_img_p" >
                                            <img :src="wrong_img_p" alt="" style="height: 200px">
                                        </label>
                                        <input id="wrong_ans_img" name="wrong_ans_img" type="file" class="sr-only"
                                               ref="WrongImagePath"
                                               @change="updateWrongPreview"
                                               @input="form.wrong_ans_img = $event.target.files[0]"
                                               accept="image/jpeg,png,jpg"
                                        />
                                    </div>
                                    <jet-input-error v-if="form.errors.wrong_ans_img" :message="form.errors.wrong_ans_img" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-1">
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-12">
                            <jet-button type="submit" class="btn btn-success btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Update
                            </jet-button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetInputError from "@/Jetstream/InputError";
import JetButton from "@/Jetstream/Button";

export default {
    name: "UpdateQuestion",
    props:['question'],
    components: {
        AppLayout,
        JetInputError,
        JetButton
    },
    data(){
        return{
            form:this.$inertia.form({
                _method: 'PUT',
                question_title:'',
                hindi_audio:'',
                english_audio:'',
                gujrati_audio:'',
                right_ans:1,
                right_ans_img:'',
                wrong_ans_img:'',
            }),
            wrong_img_p: '',
            right_img_p: '',
        }
    },
    mounted() {
        if (this.question){
            this.form.question_title = this.question.question_title;
            this.form.right_ans = this.question.right_ans;
            this.right_img_p = this.question.right_img_path;
            this.wrong_img_p = this.question.wrong_img_path;
        }
    },
    methods:{
        formSubmit(){
            this.form.post(route('questions.update', this.question.question_id), {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => {
                    this.form.reset();
                }
            })
        },

        selectRightImg() {
            this.$refs.RightImagePath.click();
        },
        updateRightPreview() {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.right_img_p = e.target.result;
            };
            reader.readAsDataURL(this.$refs.RightImagePath.files[0]);
        },

        selectWrongImg() {
            this.$refs.WrongImagePath.click();
        },
        updateWrongPreview() {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.wrong_img_p = e.target.result;
            };
            reader.readAsDataURL(this.$refs.WrongImagePath.files[0]);
        },
    }
}
</script>

<style scoped>

</style>
