<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Password Reset" />
        <form class="flex flex-col gap-2 justify-center">
            <h1 class="font-bold text-4xl text-center -tracking-wide">Forgot password?</h1>
            <h1 class="font-bold text-4xl text-center -tracking-wide">Reset them now!</h1>
            <div class="flex flex-col gap-4 text-center justify-center px-8 mt-8">
                <InputText
                    placeholder="email address"
                    type="email" />
                <Button label="Send Password Reset" />
                <Link :href="route('sign-in')">Have an account? Sign-in here </Link>
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
