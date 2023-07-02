<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Sign Up" />
        <form class="flex flex-col gap-2 justify-center">
            <h1 class="font-bold text-4xl text-center -tracking-wide">Let's get started!</h1>
            <h1 class="font-bold text-4xl text-center -tracking-wide">Create your account</h1>
            <div class="flex flex-col gap-4 text-center justify-center px-8 mt-8">
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
                <Link :href="route('sign-in')">Have an account? Sign-in here </Link>
            </div>
        </form>
    </section>
</template>

<script lang="ts" setup>
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
