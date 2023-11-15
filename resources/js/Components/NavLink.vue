<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'flex items-center px-5 py-2 rounded-md border-transparent text-sm font-medium leading-5 text-gray-200 bg-indigo-400 focus:outline-none focus:border-transparent transition duration-150 ease-in-out'
        : 'flex items-center px-5 py-2 rounded-md border-transparent text-sm font-medium leading-5 text-gray-700 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes" class="hover:bg-indigo-500 hover:text-gray-200" >
        <slot />
    </Link>
</template>
