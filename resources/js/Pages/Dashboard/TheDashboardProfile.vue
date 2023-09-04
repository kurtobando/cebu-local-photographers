<template>
    <section class="mx-auto flex max-w-2xl flex-col gap-4 py-8">
        <Meta title="Manage Profile" />
        <div>
            <h2 class="text-lg font-bold">My Profile</h2>
            <p class="text-sm">Manage your profile details here</p>
        </div>
        <form
            @submit.prevent="onSubmit"
            class="flex flex-col gap-2">
            <!-- TODO! -->
            <div class="flex items-center gap-2 rounded border border-slate-100 p-4">
                <Avatar
                    :shape="'square'"
                    :size="'xlarge'" />
                <Button
                    :size="'small'"
                    label="Change Image"
                    outlined />
            </div>

            <!-- readonly -->
            <InputText
                readonly
                disabled
                :value="auth.user.value?.email" />

            <!-- name -->
            <InputText
                :value="form.name"
                placeholder="name" />
            <InputError
                v-if="form.errors.name"
                :text="form.errors.name" />

            <!-- about -->
            <Textarea
                :value="form.about"
                placeholder="Tell me something interesting about yourself..." />
            <InputError
                v-if="form.errors.about"
                :text="form.errors.about" />

            <!-- current password -->
            <InputText
                :value="form.current_password"
                placeholder="current password" />
            <InputError
                v-if="form.errors.current_password"
                :text="form.errors.current_password" />

            <!-- new password -->
            <InputText
                :value="form.password"
                placeholder="password" />
            <InputError
                v-if="form.errors.password"
                :text="form.errors.password" />

            <!-- password confirmation -->
            <InputText
                :value="form.password_confirmation"
                placeholder="confirm password" />
            <InputError
                v-if="form.errors.password_confirmation"
                :text="form.errors.password_confirmation" />

            <!-- call to action -->
            <Button
                type="submit"
                :loading="form.processing"
                label="Save Changes" />
        </form>
    </section>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Avatar from 'primevue/avatar';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import { useToast } from 'primevue/usetoast';
import InputError from '@/Components/InputError/InputError.vue';
import Meta from '@/Components/Meta/Meta.vue';
import useAuth from '@/composables/useAuth';
import useRoutes from '@/composables/useRoute';
import PageLayoutDashboard from '@/Layouts/PageLayoutDashboard.vue';

const toast = useToast();
const route = useRoutes();
const auth = useAuth();
const form = useForm({
    about: '',
    current_password: '',
    name: '',
    password: '',
    password_confirmation: '',
});

function onSubmit() {
    form.patch(route('dashboard.profile.update'), {
        onError: (e) => {
            console.error(e);
            toast.add({
                detail: 'Oops! Something went wrong. Please try again.',
                severity: 'error',
                summary: 'Error',
            });
        },
        onFinish: () => {
            toast.add({
                detail: 'Your profile has been updated.',
                severity: 'success',
                summary: 'Success',
            });
        },
        onSuccess: () => {
            // TODO!
        },
    });
}

defineOptions({ layout: PageLayoutDashboard });
</script>

<style scoped></style>
