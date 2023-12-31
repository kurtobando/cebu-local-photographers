<template>
    <Meta title="Manage Photos" />
    <section class="flex gap-12">
        <div class="">
            <SidebarNavigation />
        </div>
        <div class="flex flex-grow flex-col gap-4">
            <div class="mt-8">
                <h2 class="text-2xl font-bold">Manage Photos</h2>
                <p class="text-sm">Upload and share your recent work here</p>
            </div>
            <div class="flex gap-2">
                <FileUpload
                    class="!py-3 !text-sm"
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
                <Button
                    label="View Gallery"
                    class="!py-3 !text-sm"
                    outlined />
            </div>
            <p class="max-w-md text-center text-sm">
                File upload limit is 10mb, and make sure this is a valid image extension.
            </p>
        </div>
    </section>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Button from 'primevue/button';
import FileUpload, { FileUploadUploaderEvent } from 'primevue/fileupload';
import { useToast } from 'primevue/usetoast';
import Meta from '@/components/Meta/Meta.vue';
import SidebarNavigation from '@/components/SidebarNavigation/SidebarNavigation.vue';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoutes from '@/composables/useRoute';
import PageLayoutDashboard from '@/layouts/PageLayoutDashboard.vue';

const route = useRoutes();
const toast = useToast();
const form = useForm<{ file: File | null }>({
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

defineOptions({ layout: PageLayoutDashboard });
</script>

<style scoped></style>
