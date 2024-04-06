<template>
    <div class="flex h-full min-w-[16rem] flex-col gap-8 rounded">
        <div class="flex flex-col text-sm">
            <Link
                class="flex w-full items-center gap-3 rounded border-b border-slate-100 py-3"
                :href="route('dashboard.profile')">
                <User :size="19" />
                <span>Manage Profile</span>
            </Link>
            <Link
                class="flex w-full items-center gap-3 rounded border-b border-slate-100 py-3"
                :href="route('dashboard.photos.create')">
                <ImagePlus :size="19" />
                <span>Manage Photos</span>
            </Link>
            <Link
                class="flex w-full items-center gap-3 rounded border-b border-slate-100 py-3"
                :href="route('dashboard.photos-gallery.index')">
                <Images :size="19" />
                <span>Manage Gallery</span>
            </Link>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ImagePlus, Images, User } from 'lucide-vue-next';
import useRoute from '@/composables/useRoute';

const route = useRoute();
</script>

<style scoped></style>
