<template>
    <form
        @submit.prevent="onSubmit"
        class="flex flex-col items-end gap-2">
        <textarea
            v-model="form.comment"
            class="h-32 w-full rounded !border-slate-300 p-4 text-sm"
            placeholder="Leave your comment here ..."></textarea>
        <div class="inline-flex gap-2">
            <InputError :text="form?.errors?.comment ?? ''" />
        </div>
        <div class="flex justify-end gap-2">
            <template v-if="form.isDirty">
                <Button
                    type="reset"
                    size="small"
                    :icon="'pi pi-times'"
                    :label="'Cancel'"
                    :loading="form.processing"
                    :disabled="form.processing"
                    outlined />
            </template>
            <Button
                type="submit"
                size="small"
                :outlined="true"
                :icon="'pi pi-send'"
                :loading="form.processing"
                :disabled="!form.isDirty || form.processing"
                :label="'Send'" />
        </div>
    </form>
</template>

<script lang="ts" setup>
import { useForm } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core';
import Button from 'primevue/button';
import { useToast } from 'primevue/usetoast';
import InputError from '@/components/InputError/InputError.vue';
import useAuth from '@/composables/useAuth';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoute from '@/composables/useRoute';

interface Props {
    postId: number;
}
interface Form {
    comment: string;
    post_id: number;
}

const props = defineProps<Props>();
const auth = useAuth();
const toast = useToast();
const route = useRoute();
const form = useForm<Form>({
    comment: '',
    post_id: props.postId,
});

function onSubmit() {
    if (!auth.isAuthenticated) {
        return useEventBus('modal:sign-in-now').emit();
    }
    form.post(route('post.comment.store', { id: props.postId }), {
        onError: () => {
            toast.removeAllGroups();
            toast.add({
                detail: 'Oops! Something went wrong. Please check the form for errors.',
                life: 6000,
                severity: 'error',
                summary: 'Error',
            });
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
                form.comment = '';
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
</script>

<style scoped></style>
