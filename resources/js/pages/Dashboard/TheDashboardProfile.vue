<template>
    <Meta title="Manage Profile" />
    <PageLayoutDashboard>
        <template #title>Manage Profile</template>
        <template #description>Manage your profile details.</template>
        <form
            @submit.prevent="onSubmit"
            class="flex w-full flex-col gap-2">
            <div class="flex items-center gap-2 rounded border border-slate-100 p-4">
                <Avatar
                    @click="onClickUploadProfileImage"
                    class="custom-avatar cursor-pointer uppercase"
                    :image="auth.user?.avatar"
                    :label="auth.user?.avatar ? '' : auth.user?.name.slice(0, 1)"
                    :shape="'circle'"
                    :size="'xlarge'" />
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-sm">Email Address</label>
                <InputText
                    readonly
                    :value="auth.user?.email" />
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-sm">Name</label>
                <InputText
                    v-model="form.name"
                    placeholder="name" />
                <InputError
                    v-if="form.errors.name"
                    :text="form.errors.name" />
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-sm">Tell me about yourself</label>
                <Textarea
                    class="leading-relaxed"
                    :rows="5"
                    v-model="form.about"
                    placeholder="Tell me something interesting about yourself..." />
                <InputError
                    v-if="form.errors.about"
                    :text="form.errors.about" />
            </div>
            <div
                v-if="!isProviderGoogle"
                class="flex flex-col gap-2">
                <div class="my-2 flex flex-row items-center gap-1">
                    <Checkbox
                        v-model="form.is_change_password"
                        :binary="true"
                        label="Change Password" />
                    <label class="text-sm">Would you like to change your password?</label>
                </div>
                <template v-if="form.is_change_password">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm">New Password</label>
                        <InputText
                            type="password"
                            v-model="form.password"
                            placeholder="password" />
                        <InputError
                            v-if="form.errors.password"
                            :text="form.errors.password" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm">Confirm Password</label>
                        <InputText
                            type="password"
                            v-model="form.password_confirmation"
                            placeholder="confirm password" />
                        <InputError
                            v-if="form.errors.password_confirmation"
                            :text="form.errors.password_confirmation" />
                    </div>
                </template>
            </div>
            <div v-if="isProviderGoogle">
                <Message
                    class="!mt-0"
                    :severity="'success'"
                    :closable="false"
                    icon="pi pi-google">
                    <div class="flex items-center">
                        <p class="pl-2 text-sm leading-relaxed">
                            Your profile is tied to your
                            <span class="capitalize">{{ auth.user?.provider }}</span>
                            Account.
                        </p>
                    </div>
                </Message>
            </div>
            <div>
                <Button
                    type="submit"
                    :loading="form.processing"
                    label="Save Changes" />
            </div>
        </form>
    </PageLayoutDashboard>
    <ModalUploadProfileImage />
</template>

<script lang="ts" setup>
import { useForm } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core';
import Avatar from 'primevue/avatar';
import Button from 'primevue/button';
import Checkbox from 'primevue/checkbox';
import InputText from 'primevue/inputtext';
import Message from 'primevue/message';
import Textarea from 'primevue/textarea';
import { useToast } from 'primevue/usetoast';
import { computed, onMounted } from 'vue';
import InputError from '@/components/InputError/InputError.vue';
import Meta from '@/components/Meta/Meta.vue';
import ModalUploadProfileImage from '@/components/ModalUploadProfileImage/ModalUploadProfileImage.vue';
import useAuth from '@/composables/useAuth';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoutes from '@/composables/useRoute';
import PageLayoutDashboard from '@/layouts/PageLayoutDashboard.vue';

interface Form {
    about: string;
    is_change_password: boolean;
    name: string;
    password: string;
    password_confirmation: string;
    provider: string;
}

const toast = useToast();
const route = useRoutes();
const auth = useAuth();
const form = useForm<Form>({
    about: '',
    is_change_password: false,
    name: '',
    password: '',
    password_confirmation: '',
    provider: '',
});

const isProviderGoogle = computed(() => auth?.user?.provider === 'google');

function onSubmit() {
    toast.add({
        detail: 'Saving your changes.',
        life: 6000,
        severity: 'info',
        summary: 'Please wait...',
    });
    form.patch(route('dashboard.profile.update'), {
        onError: () => {
            toast.removeAllGroups();
        },
        onSuccess: () => {
            const { error, success } = useFlashMessage();

            toast.removeAllGroups();

            if (error) {
                toast.add({
                    detail: error,
                    life: 6000,
                    severity: 'error',
                    summary: 'Error',
                });
            }
            if (success) {
                form.is_change_password = false;
                form.password = '';
                form.password_confirmation = '';
                toast.add({
                    detail: success,
                    life: 6000,
                    severity: 'success',
                    summary: 'Success',
                });
            }
        },
        preserveScroll: true,
    });
}
function onClickUploadProfileImage() {
    useEventBus('modal:upload-profile-image').emit();
}

onMounted(() => {
    form.name = auth?.user?.name as string;
    form.about = auth?.user?.about as string;
    form.provider = auth?.user?.provider as string;
});
</script>

<style>
.custom-avatar img {
    object-fit: cover !important;
}
</style>
