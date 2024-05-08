<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Sign In" />
        <form
            class="flex flex-col justify-center gap-2"
            @submit.prevent="onSubmit">
            <h1 class="text-center text-3xl font-bold -tracking-wide">Hey, there!</h1>
            <h1 class="text-center text-3xl font-bold -tracking-wide">Welcome back</h1>
            <div class="mt-8 flex flex-col justify-center gap-2 px-8 text-center">
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
import InputError from '@/components/InputError/InputError.vue';
import Meta from '@/components/Meta/Meta.vue';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoute from '@/composables/useRoute';
import PageLayoutAuth from '@/layouts/PageLayoutAuth.vue';

interface Form {
    email: string;
    password: string;
}

const route = useRoute();
const toast = useToast();
const form = useForm<Form>({
    email: '',
    password: '',
});

function onSubmit() {
    form.post(route('sign-in.store'), {
        onError: (e) => console.error(e),
        onSuccess: () => {
            const { error, success } = useFlashMessage();

            if (error) {
                toast.add({
                    detail: error,
                    life: 6000,
                    severity: 'error',
                    summary: 'Error',
                });
            }
            if (success) {
                toast.add({
                    detail: success,
                    life: 6000,
                    severity: 'success',
                    summary: 'Success',
                });
            }
            form.reset();
        },
        preserveScroll: true,
    });
}

defineOptions({ layout: PageLayoutAuth });
</script>

<style scoped></style>
