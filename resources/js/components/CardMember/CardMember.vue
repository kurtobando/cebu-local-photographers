<template>
    <Link
        :href="route('members.show', { user: id })"
        class="inline-block">
        <img
            referrerpolicy="no-referrer"
            :src="avatar"
            class="h-20 w-20 rounded-full object-cover"
            :alt="name" />
    </Link>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import useRoutes from '@/composables/useRoute';

interface Props {
    id: number;
    name: string;
    avatar: string;
}

defineProps<Props>();

const route = useRoutes();
</script>

<style scoped></style>
