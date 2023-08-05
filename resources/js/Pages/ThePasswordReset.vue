<template>
    <section class="w-full max-w-[24rem]">
        <Meta title="Password Reset" />
        <form
            class="flex flex-col justify-center gap-2"
            @submit.prevent="onSubmit">
            <h1 class="text-center text-3xl font-bold -tracking-wide">Forgot password?</h1>
            <h1 class="text-center text-3xl font-bold -tracking-wide">Reset them now!</h1>
            <div class="mt-8 flex flex-col justify-center gap-4 px-8 text-center">
                <InputText
                    v-model="form.email"
                    placeholder="email address"
                    type="email" />
                <InputError
                    :text="form.errors.email"
                    v-if="form.errors.email" />
                <Button
                    :loading="form.processing"
                    type="submit"
                    label="Send Password Reset" />
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
import InputText from 'primevue/inputtext';
import InputError from '@/Components/InputError/InputError.vue';
import Meta from '@/Components/Meta/Meta.vue';
import useRoute from '@/composables/useRoute';
import PageLayoutAuth from '@/Layouts/PageLayoutAuth.vue';

const route = useRoute();
const form = useForm({
    email: '',
});

function onSubmit() {
    form.post(route('password-reset.store'), {
        onSuccess: () => {
            form.reset();
        },
        preserveScroll: true,
    });
}

defineOptions({ layout: PageLayoutAuth });
</script>

<style scoped></style>
