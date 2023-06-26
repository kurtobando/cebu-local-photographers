<template>
    <section>
        <Meta title="Sign In" />

        <form class="flex flex-col gap-4 justify-center">
            <h1 class="font-bold text-4xl text-center">Sign in</h1>
            <p class="leading-relaxed text-center text-slate-600">Welcome back! Sign-in now</p>
            <div class="flex flex-col gap-4 text-center justify-center px-8 mt-8">
                <Button
                    icon="pi pi-google"
                    label="Sign in with Google" />
                <Link :href="route('sign-up')">
                    <u class="text-slate-600">Create an account</u>
                </Link>
            </div>
        </form>
    </section>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Meta from '@/Components/Meta/Meta.vue';
import LayoutAuth from '@/Layouts/LayoutAuth.vue';
import useRoute from '@/composables/useRoute';

const route = useRoute();

defineOptions({ layout: LayoutAuth });
</script>

<style scoped></style>
