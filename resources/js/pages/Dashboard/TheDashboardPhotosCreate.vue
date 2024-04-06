<template>
    <Meta title="Manage Photos" />
    <PageLayoutDashboard>
        <template #title>Upload Photo</template>
        <template #description>Start uploading your photos to your gallery.</template>
        <div class="grid place-content-center gap-4 rounded border border-slate-100 p-8 py-14">
            <div class="flex justify-center gap-2">
                <FileUpload
                    name="photos"
                    accept="image/*"
                    :maxFileSize="10000000"
                    :mode="'basic'"
                    :show-upload-button="true"
                    :show-cancel-button="true"
                    :custom-upload="true"
                    @uploader="onUpload"
                    choose-label="Upload Photos"
                    multiple />
                <Link :href="route('dashboard.photos-gallery.index')">
                    <Button
                        label="View Gallery"
                        outlined />
                </Link>
            </div>
            <p class="mx-auto max-w-md text-center text-sm text-slate-400">
                File upload limit is 10mb, and make sure this is a valid image extension.
            </p>
        </div>
    </PageLayoutDashboard>
</template>

<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import Button from 'primevue/button';
import FileUpload, { FileUploadUploaderEvent } from 'primevue/fileupload';
import { useToast } from 'primevue/usetoast';
import Meta from '@/components/Meta/Meta.vue';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoutes from '@/composables/useRoute';
import PageLayoutDashboard from '@/layouts/PageLayoutDashboard.vue';

type Form = {
    file: File | null;
};

const route = useRoutes();
const toast = useToast();
const form = useForm<Form>({
    file: null,
});

function onUpload(event: FileUploadUploaderEvent) {
    toast.add({
        detail: 'Preparing your image to upload.',
        life: 6000,
        severity: 'info',
        summary: 'Please wait...',
    });
    form.file = Array.isArray(event.files) ? event.files[0] : event.files;
    form.post(route('dashboard.photos.store'), {
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
        onError: () => {
            toast.removeAllGroups();
            toast.add({
                detail: 'Something went wrong, please try again.',
                life: 6000,
                severity: 'error',
                summary: 'Error',
            });
        },
        onSuccess: () => {
            const { error, success } = useFlashMessage();

            toast.removeAllGroups();

            if (success) {
                toast.add({
                    detail: success,
                    life: 6000,
                    severity: 'success',
                    summary: 'Success',
                });
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
</script>

<style scoped></style>
