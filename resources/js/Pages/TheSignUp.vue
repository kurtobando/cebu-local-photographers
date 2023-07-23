<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Sign Up" />
        <form class="flex flex-col justify-center gap-2">
            <h1 class="text-center text-3xl font-bold -tracking-wide">Let's get started!</h1>
            <h1 class="text-center text-3xl font-bold -tracking-wide">Create your account</h1>
            <div class="mt-8 flex flex-col justify-center gap-4 px-8 text-center">
                <div class="flex flex-col gap-2">
                    <InputText
                        v-model="form.email"
                        placeholder="email address"
                        type="email" />
                    <InputError
                        v-if="form.errors.email"
                        :text="form.errors.email" />
                </div>
                <div class="flex flex-col gap-2">
                    <InputText
                        v-model="form.password"
                        placeholder="password"
                        type="password" />
                    <InputError
                        v-if="form.errors.password"
                        :text="form.errors.password" />
                </div>
                <Button
                    label="Sign up"
                    :loading="form.processing"
                    @click="onSubmit" />
                <a :href="route('auth.google.redirect')">
                    <Button
                        class="w-full"
                        icon="pi pi-google"
                        label="Sign up with Google"
                        outlined />
                </a>
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
import { Link, useForm } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Meta from '@/Components/Meta/Meta.vue';
import PageLayoutAuth from '@/Layouts/PageLayoutAuth.vue';
import InputText from 'primevue/inputtext';
import InputError from '@/Components/InputError/InputError.vue';
import useRoute from '@/composables/useRoute';

const route = useRoute();
const form = useForm({
    email: '',
    password: '',
});

function onSubmit() {
    form.post(route('sign-up'), {
        preserveScroll: true,
        onSuccess: () => {
            // form.reset();
        },
    });
}

defineOptions({ layout: PageLayoutAuth });
</script>

<style scoped></style>
