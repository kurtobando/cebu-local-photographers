<template>
    <Meta title="Manage Profile" />
    <section class="flex gap-8">
        <div class="pt-[4.3rem]">
            <SidebarNavigation />
        </div>
        <div class="flex flex-grow flex-col gap-4">
            <div>
                <h2 class="text-2xl font-bold">Profile</h2>
                <p class="text-sm">Manage your profile details here</p>
            </div>
            <form
                @submit.prevent="onSubmit"
                class="flex flex-col gap-2">
                <!-- TODO! -->
                <div class="flex items-center gap-2 rounded border border-slate-100 p-4">
                    <Avatar
                        :label="auth.user?.name.slice(0, 1)"
                        :shape="'square'"
                        :size="'xlarge'" />
                    <Button
                        :size="'small'"
                        label="Change Image"
                        outlined />
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
                </div>
                <div v-if="isProviderGoogle">
                    <Message
                        :severity="'success'"
                        :closable="false"
                        icon="pi pi-google">
                        <div class="flex items-center">
                            <p class="pl-2 leading-relaxed">
                                You cant change password, you You opt-in for {{ auth.user?.provider }}
                            </p>
                        </div>
                    </Message>
                </div>

                <!-- call to action -->
                <Button
                    type="submit"
                    :loading="form.processing"
                    label="Save Changes" />
            </form>
        </div>
    </section>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Avatar from 'primevue/avatar';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Message from 'primevue/message';
import Textarea from 'primevue/textarea';
import { useToast } from 'primevue/usetoast';
import { computed, onMounted } from 'vue';
import InputError from '@/Components/InputError/InputError.vue';
import Meta from '@/Components/Meta/Meta.vue';
import SidebarNavigation from '@/Components/SidebarNavigation/SidebarNavigation.vue';
import useAuth from '@/composables/useAuth';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoutes from '@/composables/useRoute';
import PageLayoutDashboard from '@/Layouts/PageLayoutDashboard.vue';

const toast = useToast();
const route = useRoutes();
const auth = useAuth();
const form = useForm({
    about: '',
    name: '',
    password: '',
    password_confirmation: '',
    provider: '',
});

const isProviderGoogle = computed(() => auth?.user?.provider === 'google');

function onSubmit() {
    form.patch(route('dashboard.profile.update'), {
        onError: (e) => {
            console.error(e);
        },
        onSuccess: () => {
            const { error, success } = useFlashMessage();

            if (success) {
                toast.add({
                    detail: success,
                    life: 6000,
                    severity: 'success',
                    summary: 'Success',
                });
            }
            if (error) {
                toast.add({
                    detail: error,
                    life: 6000,
                    severity: 'error',
                    summary: 'Error',
                });
            }
        },
        preserveScroll: true,
    });
}

onMounted(() => {
    form.name = auth?.user?.name as string;
    form.about = auth?.user?.about as string;
    form.provider = auth?.user?.provider as string;
});

defineOptions({ layout: PageLayoutDashboard });
</script>

<style scoped></style>
