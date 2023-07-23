<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Sign In" />
        <form class="flex flex-col justify-center gap-2">
            <h1 class="text-center text-3xl font-bold -tracking-wide">Hey, there!</h1>
            <h1 class="text-center text-3xl font-bold -tracking-wide">Welcome back</h1>
            <div class="mt-8 flex flex-col justify-center gap-4 px-8 text-center">
                <InputText
                    placeholder="email address"
                    type="email" />
                <InputText
                    placeholder="password"
                    type="password" />
                <Button label="Sign in" />
                <a
                    :href="route('auth.google.redirect')"
                    class="block">
                    <Button
                        class="w-full"
                        icon="pi pi-google"
                        label="Sign in with Google"
                        outlined />
                </a>
                <div class="mt-4 flex flex-col gap-4">
                    <Link
                        class="text-sm"
                        :href="route('sign-up')">
                        Create an account? Click here
                    </Link>
                    <Link
                        :href="route('password-reset')"
                        class="text-sm text-slate-600">
                        Forgot password?
                    </Link>
                </div>
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
