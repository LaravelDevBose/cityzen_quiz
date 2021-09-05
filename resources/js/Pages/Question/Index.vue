<template>
    <app-layout title="Question List">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Question
                                            </th>

                                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Answer
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" v-if="questions.data && questions.data.length > 0">
                                        <tr v-for="(question, index) in questions.data" :key="question.question_id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ question.question_title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                  {{ question.right_ans == 1? 'Yes': 'No'}}
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <Link :href="route('questions.show', question.question_id)" class="text-green-600 hover:text-green-900">Show</Link>
                                                <Link :href="route('questions.edit', question.question_id)" class="text-blue-600 hover:text-blue-900 mx-2">Edit</Link>
                                                <Link href="#" @click.prevent="deleteQuestion(question)" class="text-red-600 hover:text-red-900">Delete</Link>
                                            </td>
                                        </tr>

                                        <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                                <pagination :meta="questions.meta"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Jetstream/Pagination";
import { Link } from '@inertiajs/inertia-vue3';

export default {
    name: "Index",
    components: {
        AppLayout,
        Pagination,
        Link
    },
    props:['questions'],
    data(){
        return{
            deleteForm: this.$inertia.form({
                method:'_DELETE',
            }),
        }
    },
    methods:{
        deleteQuestion: function (data) {
            if (!confirm('Are you sure want to remove?')) return;
            this.deleteForm.delete(route('questions.destroy', data.question_id));
        },
    }
}
</script>

<style scoped>

</style>
