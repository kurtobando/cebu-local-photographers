<template>
    <section class="mx-auto flex max-w-2xl flex-col gap-4 py-8">
        <Meta title="Manage Photos" />
        <div>
            <h2 class="text-lg font-bold">My Photos</h2>
            <p class="text-sm">Upload and share your recent work here</p>
        </div>
        <div class="flex gap-2">
            <FileUpload
                class="!py-3 !text-sm"
                name="photos"
                accept="image/*"
                :maxFileSize="1000000"
                :mode="'basic'"
                :show-upload-button="true"
                :show-cancel-button="true"
                choose-label="Upload Photos"
                multiple />
            <Button
                label="View Gallery"
                class="!py-3 !text-sm"
                outlined />
        </div>
    </section>
</template>

<script setup lang="ts">
import Button from 'primevue/button';
import FileUpload from 'primevue/fileupload';
import Meta from '@/Components/Meta/Meta.vue';
import PageLayoutDashboard from '@/Layouts/PageLayoutDashboard.vue';

defineOptions({ layout: PageLayoutDashboard });
</script>

<style scoped></style>
