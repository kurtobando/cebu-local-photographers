<template>
    <Dialog
        class="mx-8 w-full md:w-[40rem]"
        :draggable="false"
        :modal="true"
        :close-on-escape="true"
        v-model:visible="isVisible">
        <template #header>
            <div class="flex flex-col">
                <h1 class="text-xl font-bold">Tell us more about the project</h1>
            </div>
        </template>
        <form
            @submit.prevent="onSubmit"
            class="mt-2 flex flex-col gap-4">
            <textarea
                class="w-full rounded !border-slate-300 p-4 !leading-relaxed"
                v-model="form.message"
                :rows="10"
                placeholder="Let me know how i can help ..."></textarea>
            <InputError
                v-if="form.errors.message"
                :text="form.errors.message" />
            <div class="flex flex-col items-center justify-between gap-2 md:flex-row">
                <p class="text-sm text-slate-400">
                    You have {{ auth?.user?.message_limit || 0 }} messages remaining this month.
                </p>
                <Button
                    :loading="form.processing"
                    type="submit"
                    class="!py-4 !text-sm"
                    outlined
                    label="Send Message" />
            </div>
        </form>
    </Dialog>
</template>

<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import { useToast } from 'primevue/usetoast';
import { ref } from 'vue';
import InputError from '@/components/InputError/InputError.vue';
import useAuth from '@/composables/useAuth';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoute from '@/composables/useRoute';

const toast = useToast();
const route = useRoute();
const auth = useAuth();
const form = useForm({
    message: '',
    user_id_receiver: '',
});
const isVisible = ref(false);

function onSubmit() {
    if (!auth.isAuthenticated) {
        return useEventBus('modal:sign-in-now').emit();
    }
    if (auth.isAuthenticated && !auth?.user?.message_limit) {
        return toast.add({
            detail: 'You have reached your message limit for this month.',
            life: 6000,
            severity: 'error',
            summary: 'Error',
        });
    }
    form.post(route('hire-me.message.store'), {
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
                router.visit(window.location.href, {
                    only: ['auth'],
                    onSuccess: () => {
                        toast.add({
                            detail: success,
                            life: 6000,
                            severity: 'success',
                            summary: 'Success',
                        });
                        form.reset();
                        isVisible.value = false;
                    },
                });
            }
        },
        preserveScroll: true,
        preserveState: true,
    });
}

useEventBus('modal:hire-me').on((event, payload) => {
    isVisible.value = true;

    form.reset();
    form.user_id_receiver = payload.user_id;
});
</script>

<style scoped></style>
