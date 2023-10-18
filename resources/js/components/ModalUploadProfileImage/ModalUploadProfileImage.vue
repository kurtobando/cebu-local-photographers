<template>
    <Dialog
        :draggable="false"
        :modal="true"
        header="Change Profile Image"
        v-model:visible="isVisible">
        <div class="mt-2 flex min-w-[25rem] flex-col items-center justify-center gap-4 text-center">
            <FileUpload
                :custom-upload="true"
                :choose-label="'Choose Image'"
                :name="'file'"
                :accept="'image/*'"
                :with-credentials="true"
                :max-file-size="10000000"
                mode="basic"
                @uploader="onUpload" />
            <InputError
                :text="form.errors?.file"
                v-if="form.errors?.file" />
            <p class="max-w-md text-center text-sm">
                File upload limit is 10mb, and make sure this is a valid image extension.
            </p>
        </div>
    </Dialog>
</template>

<script lang="ts" setup>
import { useForm } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core';
import Dialog from 'primevue/dialog';
import FileUpload, { FileUploadUploaderEvent } from 'primevue/fileupload';
import { useToast } from 'primevue/usetoast';
import { ref } from 'vue';
import InputError from '@/components/InputError/InputError.vue';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoute from '@/composables/useRoute';

const toast = useToast();
const route = useRoute();
const form = useForm<{ file: File | null }>({
    file: null,
});
const isVisible = ref(false);

async function onUpload(event: FileUploadUploaderEvent) {
    toast.add({
        detail: 'Preparing your image to upload.',
        life: 6000,
        severity: 'info',
        summary: 'Please wait...',
    });

    form.file = Array.isArray(event.files) ? event.files[0] : event.files;
    form.post(route('dashboard.profile-image.store'), {
        onBefore: () => {
            if (form.file === null) {
                toast.add({
                    detail: 'Please select an image to upload.',
                    life: 6000,
                    severity: 'error',
                    summary: 'Error',
                });
                return false;
            }
        },
        onError: (e) => {
            console.error(e);
            toast.add({
                detail: 'Something went wrong, please try again.',
                life: 6000,
                severity: 'error',
                summary: 'Error',
            });
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
                isVisible.value = false;
                form.file = null;
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

useEventBus('modal:upload-profile-image').on(() => {
    isVisible.value = true;
});
</script>

<style scoped></style>
