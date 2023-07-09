<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Sign In" />
        <form class="flex flex-col gap-2 justify-center">
            <h1 class="font-bold text-4xl text-center -tracking-wide">Hey, there!</h1>
            <h1 class="font-bold text-4xl text-center -tracking-wide">Welcome back</h1>
            <div class="flex flex-col gap-4 text-center justify-center px-8 mt-8">
                <InputText
                    placeholder="email address"
                    type="email" />
                <InputText
                    placeholder="password"
                    type="password" />
                <Button label="Sign in" />
                <Button
                    icon="pi pi-google"
                    label="Sign in with Google"
                    outlined />
                <Link :href="route('sign-up')">Create an account? Click here </Link>
                <Link
                    :href="route('password-reset')"
                    class="text-slate-600">
                    Forgot password?
                </Link>
            </div>
        </form>
    </section>
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Meta from '@/Components/Meta/Meta.vue';
import PageLayoutAuth from '@/Layouts/PageLayoutAuth.vue';

defineOptions({ layout: PageLayoutAuth });
</script>

<style scoped></style>
