<template>
    <div class="flex flex-col gap-8 rounded bg-slate-50 p-8 text-slate-600">
        <div>
            <h2 class="text-2xl font-bold">{{ auth.user?.name }}</h2>
            <p class="text-sm capitalize text-slate-400">{{ auth.user?.role }}</p>
        </div>
        <div class="flex flex-col gap-4 text-sm">
            <Link
                class="flex items-center gap-2"
                :href="route('dashboard.profile')">
                <User />
                Manage Profile
            </Link>
            <Link
                class="flex items-center gap-2"
                :href="route('dashboard.photos.create')">
                <Image />
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

2;

const route = useRoute();
const auth = useAuth();
</script>

<style scoped></style>
