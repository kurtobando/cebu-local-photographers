<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Sign Up" />
        <form class="flex flex-col justify-center gap-2">
            <h1 class="text-center text-3xl font-bold -tracking-wide">Let's get started!</h1>
            <h1 class="text-center text-3xl font-bold -tracking-wide">Create your account</h1>
            <div class="mt-8 flex flex-col justify-center gap-4 px-8 text-center">
                <InputText
                    placeholder="email address"
                    type="email" />
                <InputText
                    placeholder="password"
                    type="password" />
                <Button label="Sign up" />
                <Button
                    icon="pi pi-google"
                    label="Sign up with Google"
                    outlined />
                <Link
                    class="mt-4 text-sm"
                    :href="route('sign-in')">
                    Have an account? Sign-in here
                </Link>
            </div>
        </form>
    </section>
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Meta from '@/Components/Meta/Meta.vue';
import PageLayoutAuth from '@/Layouts/PageLayoutAuth.vue';
import InputText from 'primevue/inputtext';

defineOptions({ layout: PageLayoutAuth });
</script>

<style scoped></style>
