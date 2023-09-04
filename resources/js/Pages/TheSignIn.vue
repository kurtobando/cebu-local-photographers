<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Sign In" />
        <form
            class="flex flex-col justify-center gap-2"
            @submit.prevent="onSubmit">
            <h1 class="text-center text-3xl font-bold -tracking-wide">Hey, there!</h1>
            <h1 class="text-center text-3xl font-bold -tracking-wide">Welcome back</h1>
            <div class="mt-8 flex flex-col justify-center gap-4 px-8 text-center">
                <InputText
                    v-model="form.email"
                    placeholder="email address"
                    type="email" />
                <InputError
                    :text="form.errors.email"
                    v-if="form.errors.email" />
                <InputText
                    v-model="form.password"
                    placeholder="password"
                    type="password" />
                <InputError
                    :text="form.errors.password"
                    v-if="form.errors.password" />
                <Button
                    type="submit"
                    label="Sign in" />
                <a
                    :href="route('auth.google.redirect')"
                    class="block">
                    <Button
                        :loading="form.processing"
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
        <Toast />
    </section>
</template>

<script lang="ts" setup>
import { Link, useForm } from '@inertiajs/vue3';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import { useToast } from 'primevue/usetoast';
import { onMounted } from 'vue';
import InputError from '@/Components/InputError/InputError.vue';
import Meta from '@/Components/Meta/Meta.vue';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoute from '@/composables/useRoute';
import PageLayoutAuth from '@/Layouts/PageLayoutAuth.vue';

const { error, success } = useFlashMessage();
const route = useRoute();
const toast = useToast();
const form = useForm({
    email: '',
    password: '',
});

function onSubmit() {
    form.post(route('sign-in.store'), {
        onFinish: () => {
            if (error.value) {
                toast.add({
                    detail: error.value,
                    severity: 'error',
                });
            }
        },
        onSuccess: () => {
            form.reset();
        },
        preserveScroll: true,
    });
}

onMounted(() => {
    if (success.value) {
        toast.add({
            detail: success.value,
            severity: 'success',
        });
    }
});

defineOptions({ layout: PageLayoutAuth });
</script>

<style scoped></style>