<template>
    <div class="bg-white px-4 py-3 flex items-center justify-between border-gray-200 sm:px-6">

        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.from }}</span>
                    {{ ' ' }}
                    to
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.to }}</span>
                    {{ ' ' }}
                    of
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.total }}</span>
                    {{ ' ' }}
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <Link v-for="(link, key) in meta.links" :key="key" v-bind:class="isActive(link)"
                          class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                          :href="link.url" v-html="link.label"></Link>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    name: "Pagination",
    props:['meta'],
    components: {
        Link,
    },
    computed: {
        showPagination() {
            return this.meta.links.length > 3
        }
    },
    methods: {
        isActive(link) {
            return (link.active === true) ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
        },
        handleNoLink() {
            return false
        }
    }
}
</script>

<style scoped>
nav a:first-child{
    border-top-left-radius: .375rem;
    border-bottom-left-radius: .375rem;
}
nav a:last-child{
    border-top-right-radius: .375rem;
    border-bottom-right-radius: .375rem;
}
</style>
