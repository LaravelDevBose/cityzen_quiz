<template>
    <app-layout title="Quiz Result">
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
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Contact no
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Email
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                City
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Pin Code
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Result
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="(userResult, index) of quizResults.data" :key="index">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{userResult.first_name }} {{ userResult.last_name? userResult.last_name: ''}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ userResult.phone_no }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ userResult.email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ userResult.city }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ userResult.pin_code }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span v-if="!userResult.result" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                  Cancel
                                                </span>
                                                <span v-else-if="userResult.result >= 50" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                  {{ userResult.result}} %
                                                </span>
                                                <span v-else-if="userResult.result < 50" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                  {{ userResult.result}} %
                                                </span>
                                                <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                  No result
                                                </span>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <pagination :meta="quizResults.meta"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Pagination from "@/Jetstream/Pagination";
    export default {
        name: 'QuizResult',
        components: {
            AppLayout,
            Pagination,
        },
        props:['quizResults']
    }
</script>
