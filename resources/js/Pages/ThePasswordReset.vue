<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Password Reset" />
        <form class="flex flex-col justify-center gap-2">
            <h1 class="text-center text-3xl font-bold -tracking-wide">Forgot password?</h1>
            <h1 class="text-center text-3xl font-bold -tracking-wide">Reset them now!</h1>
            <div class="mt-8 flex flex-col justify-center gap-4 px-8 text-center">
                <InputText
                    placeholder="email address"
                    type="email" />
                <Button label="Send Password Reset" />
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
import InputText from 'primevue/inputtext';
import Meta from '@/Components/Meta/Meta.vue';
import PageLayoutAuth from '@/Layouts/PageLayoutAuth.vue';

defineOptions({ layout: PageLayoutAuth });
</script>

<style scoped></style>
