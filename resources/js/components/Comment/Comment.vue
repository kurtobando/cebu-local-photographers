<template>
    <div class="flex flex-col gap-2">
        <div class="inline-flex items-center gap-4">
            <img
                referrerpolicy="no-referrer"
                :src="avatar"
                alt="avatar image"
                class="h-12 w-12 rounded-full object-cover" />
            <div class="flex flex-col">
                <Link
                    :href="route('members.show', { user: userId })"
                    class="text-sm">
                    {{ name }}
                </Link>
                <span class="text-sm text-accent"> {{ helper.formatDateFromNow(createdAt) }}</span>
            </div>
        </div>
        <p class="text-sm leading-relaxed">
            {{ comment }}
        </p>
        <p class="inline-flex items-center gap-2">
            <Heart :size="20" />
            <span>{{ heart }}</span>
        </p>
    </div>
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import { Heart } from 'lucide-vue-next';
import useHelper from '@/composables/useHelper';
import useRoutes from '@/composables/useRoute';

defineProps<Props>();

interface Props {
    avatar: string;
    userId: number;
    name: string;
    comment: string;
    createdAt: string;
    heart: number;
}

const route = useRoutes();
const helper = useHelper();
</script>

<style scoped></style>
