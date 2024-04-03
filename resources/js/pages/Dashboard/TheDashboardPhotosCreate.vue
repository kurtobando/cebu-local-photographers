<template>
    <Meta title="Manage Photos" />
    <section class="flex flex-col gap-8 md:flex-row">
        <div class="md:pr-14 md:pt-20">
            <SidebarNavigation />
        </div>
        <div class="flex flex-grow flex-col gap-4">
            <div class="">
                <h2 class="text-2xl font-bold">Manage Photos</h2>
                <p class="text-sm">Upload and share your recent work here</p>
            </div>
            <div class="mt-4 grid place-content-center gap-4 rounded border border-slate-100 p-8 py-14">
                <div class="flex justify-center gap-2">
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
                    <Link :href="route('dashboard.photos-gallery.index')">
                        <Button
                            label="View Gallery"
                            class="!py-3 !text-sm"
                            outlined />
                    </Link>
                </div>
                <p class="mx-auto max-w-md text-center text-sm text-slate-400">
                    File upload limit is 10mb, and make sure this is a valid image extension.
                </p>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import Button from 'primevue/button';
import FileUpload, { FileUploadUploaderEvent } from 'primevue/fileupload';
import { useToast } from 'primevue/usetoast';
import Meta from '@/components/Meta/Meta.vue';
import SidebarNavigation from '@/components/SidebarNavigation/SidebarNavigation.vue';
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

defineOptions({ layout: PageLayoutDashboard });
</script>

<style scoped></style>
