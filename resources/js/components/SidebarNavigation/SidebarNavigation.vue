<template>
    <div class="flex h-full flex-col gap-8 rounded p-8 px-0">
        <div>
            <h2 class="max-w-[12rem] truncate text-2xl font-bold">{{ auth.user?.name }}</h2>
            <p class="flex flex-row gap-2 text-sm lowercase">
                <span class="inline-block w-[12rem] truncate text-ellipsis">{{ auth.user?.email }}</span>
            </p>
        </div>
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
import useAuth from '@/composables/useAuth';
import useRoute from '@/composables/useRoute';

const route = useRoute();
const auth = useAuth();
</script>

<style scoped></style>
