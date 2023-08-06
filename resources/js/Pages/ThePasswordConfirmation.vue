<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Change Your Password" />
        <form
            @submit.prevent="onSubmit"
            class="flex flex-col justify-center gap-2">
            <h1 class="text-center text-3xl font-bold -tracking-wide">Change your password</h1>
            <div class="mt-8 flex flex-col justify-center gap-4 px-8 text-center">
                <InputText
                    v-model="form.email"
                    placeholder="email address"
                    readonly
                    disabled
                    type="text" />
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
                <InputText
                    v-model="form.password_confirmation"
                    placeholder="confirm password"
                    type="password" />
                <InputError
                    :text="form.errors.password_confirmation"
                    v-if="form.errors.password_confirmation" />
                <Button
                    :loading="form.processing"
                    type="submit"
                    label="Change Password" />
            </div>
        </form>
        <Toast />
    </section>
</template>

<script setup lang="ts">
import { useForm, usePage } from '@inertiajs/vue3';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import { useToast } from 'primevue/usetoast';
import { computed } from 'vue';
import InputError from '@/Components/InputError/InputError.vue';
import Meta from '@/Components/Meta/Meta.vue';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoute from '@/composables/useRoute';
import PageLayoutAuth from '@/Layouts/PageLayoutAuth.vue';
import { SharedProps } from '@/types';

const email = computed(() => usePage<SharedProps>().props.email as string);
const token = computed(() => usePage<SharedProps>().props.token as string);
const { error } = useFlashMessage();
const toast = useToast();
const route = useRoute();
const form = useForm({
    email: email.value,
    password: '',
    password_confirmation: '',
    token: token.value,
});

function onSubmit() {
    form.post(route('password-confirmation.update'), {
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
    });
}

defineOptions({ layout: PageLayoutAuth });
</script>

<style scoped></style>
