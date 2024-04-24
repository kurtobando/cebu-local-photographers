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
            <template v-if="isCommentLike">
                <a @click="onPostCommentUnlike()">
                    <Heart
                        :color="'#ff7d00'"
                        :size="20" />
                </a>
            </template>
            <template v-else>
                <a @click="onPostCommentLike()">
                    <Heart :size="20" />
                </a>
            </template>
            <span>{{ heart }}</span>
        </p>
    </div>
</template>

<script lang="ts" setup>
import { Link, useForm } from '@inertiajs/vue3';
import { Heart } from 'lucide-vue-next';
import { useToast } from 'primevue/usetoast';
import useFlashMessage from '@/composables/useFlashMessage';
import useHelper from '@/composables/useHelper';
import useRoutes from '@/composables/useRoute';

interface Props {
    avatar: string;
    postId: number;
    userId: number;
    name: string;
    comment: string;
    createdAt: string;
    heart: number;
    id: number;
    isCommentLike: boolean;
}

const props = defineProps<Props>();
const toast = useToast();
const route = useRoutes();
const helper = useHelper();

function onPostCommentLike() {
    useForm({
        comment_id: props.id,
        post_id: props.postId,
    }).post(route('post.comment.like.store', { commentId: props.id, id: props.postId }), {
        onError: (e) => console.error(e),
        onSuccess: () => {
            const { error, success } = useFlashMessage();

            if (success) {
                toast.add({
                    detail: success,
                    life: 6000,
                    severity: 'success',
                    summary: 'Success',
                });
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
function onPostCommentUnlike() {
    useForm({
        comment_id: props.id,
        post_id: props.postId,
    }).delete(route('post.comment.like.destroy', { commentId: props.id, id: props.postId }), {
        onError: (e) => console.error(e),
        onSuccess: () => {
            const { error, success } = useFlashMessage();

            if (success) {
                toast.add({
                    detail: success,
                    life: 6000,
                    severity: 'success',
                    summary: 'Success',
                });
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
