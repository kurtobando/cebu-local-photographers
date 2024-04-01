<template>
    <div class="flex h-full flex-col gap-8 rounded">
        <div class="flex flex-col gap-4 text-sm">
            <Link
                class="flex items-center gap-3"
                :href="route('dashboard.profile')">
                <User :size="19" />
                Manage Profile
            </Link>
            <Link
                class="flex items-center gap-3"
                :href="route('dashboard.photos.create')">
                <Image :size="19" />
                Manage Photos
            </Link>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Image, User } from 'lucide-vue-next';
import useRoute from '@/composables/useRoute';

const route = useRoute();
</script>

<style scoped></style>
