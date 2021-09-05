<template>
    <Link :href="'/'">
        <img :src="route('front.index')+'/assets/images/gujarat_police_logo.png'" alt="" style="height: 10rem;">
    </Link>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        components: {
            Link,
        },
    }
</script>
