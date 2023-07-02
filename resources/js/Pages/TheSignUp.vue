<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Sign Up" />
        <form class="flex flex-col gap-2 justify-center">
            <h1 class="font-bold text-4xl text-center -tracking-wide">Let's get started!</h1>
            <h1 class="font-bold text-4xl text-center -tracking-wide">Create your account</h1>
            <div class="flex flex-col gap-4 text-center justify-center px-8 mt-8">
                <InputText
                    type="email"
                    placeholder="email address" />
                <InputText
                    type="password"
                    placeholder="password" />
                <Button label="Sign up" />
                <Button
                    outlined
                    icon="pi pi-google"
                    label="Sign up with Google" />
                <Link :href="route('sign-in')">
                    <span class="text-slate-600">Have an account? Sign-in here</span>
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
import InputText from 'primevue/inputtext';

const route = useRoute();

defineOptions({ layout: LayoutAuth });
</script>

<style scoped></style>
