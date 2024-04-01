<template>
    <Head>
        <title>{{ title }}</title>
    </Head>
    <div
        class="mx-auto flex min-h-screen max-w-2xl flex-col items-center justify-center p-6 text-center text-xl uppercase leading-relaxed tracking-wider text-slate-600">
        <div class="mb-4">
            <CloudOff
                class="text-slate-200"
                size="90" />
        </div>
        <h1 class="text-slate-500">{{ title }}</h1>
        <p class="text-sm text-slate-400">{{ message === '' ? description : message }}</p>
        <Link
            :href="route('home')"
            class="mt-8 border-b-2 text-xs -tracking-wide text-slate-400 hover:border-primary hover:text-primary">
            Go back to home
        </Link>
    </div>
</template>

<script setup>
import { CloudOff } from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps({
    message: {
        default: `Oops, something went wrong. We are working on it. Please try again later, if issue persist, please contact our support team to assist you further.`,
        required: false,
        type: String,
    },
    status: {
        default: 404,
        required: false,
        type: Number,
    },
});

const title = computed(() => {
    return {
        400: 'Bad Request',
        401: 'Unauthorized',
        403: 'Forbidden',
        404: 'Page Not Found',
        500: 'Server Error',
        503: 'Service Unavailable',
    }[props.status];
});
const description = computed(() => {
    return {
        400: 'Sorry, the request was unacceptable, often due to missing a required parameter.',
        401: 'Sorry, you are not authorized to access this page.',
        403: 'Sorry, you are forbidden from accessing this page.',
        404: 'Sorry, the page you are looking for was not found.',
        500: 'Sorry, something went wrong on our servers.',
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
    }[props.status];
});
</script>
