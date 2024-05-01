<template>
    <section class="">
        <Meta :title="post.title" />
        <div class="flex w-full flex-col lg:max-h-screen lg:min-h-screen lg:flex-row">
            <div
                class="grid w-full place-content-center bg-[#171717] bg-center bg-blend-overlay lg:w-7/12"
                :style="`background-image: url('${post.media?.xlarge}')`">
                <Image
                    :src="post.media?.xlarge"
                    :preview="true"
                    image-class="w-full lg:max-h-screen"
                    alt="media image" />
            </div>
            <div class="flex w-full flex-col gap-8 overflow-y-scroll p-8 md:p-12 lg:w-5/12">
                <div class="flex flex-col gap-4">
                    <div class="inline-flex items-center justify-between gap-2">
                        <h1 class="text-2xl font-bold capitalize leading-snug">
                            {{ post.title }}
                        </h1>
                        <template v-if="post.user_id === auth.user?.id">
                            <div>
                                <a @click="onPostMenuToggle($event)">
                                    <EllipsisVertical :size="20" />
                                </a>
                                <Menu
                                    ref="menu"
                                    :model="menuItems"
                                    :popup="true">
                                    <template #item="slotProps">
                                        <p class="flex flex-row items-center gap-2 p-2 px-5 py-3">
                                            <span :class="slotProps.item.icon"></span>
                                            <span class="text-sm">{{ slotProps.item.label }}</span>
                                        </p>
                                    </template>
                                </Menu>
                            </div>
                        </template>
                    </div>

                    <div class="inline-flex items-center gap-4">
                        <img
                            referrerpolicy="no-referrer"
                            class="h-14 w-14 rounded-full object-cover"
                            :alt="post_author.name"
                            :src="post_author?.avatar || ''" />
                        <div>
                            <ul class="inline-flex list-disc items-center gap-4 text-sm">
                                <li class="mr-1 list-none capitalize">
                                    <Link :href="route('members.show', { user: post.user_id })">
                                        {{ post_author.name }}
                                    </Link>
                                </li>
                                <template v-if="auth.isAuthenticated && auth.user?.id !== post.user_id">
                                    <li class="mr-1">
                                        <template v-if="post_author_is_followed">
                                            <a
                                                class="cursor-pointer"
                                                @click="onMemberUnfollow(post_author.id)">
                                                Unfollow
                                            </a>
                                        </template>
                                        <template v-else>
                                            <a
                                                class="cursor-pointer"
                                                @click="onMemberFollow(post_author.id)">
                                                Follow
                                            </a>
                                        </template>
                                    </li>
                                    <li class="">
                                        <a
                                            href=""
                                            class="text-accent">
                                            Hire Me
                                        </a>
                                    </li>
                                </template>
                            </ul>
                            <p class="text-sm text-slate-400">
                                {{ helper.formatDate(post.created_at) }},
                                {{ helper.formatDateFromNow(post.created_at) }}.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <p class="mt-4 leading-relaxed text-slate-500">
                            {{ post.description }}
                        </p>
                        <p class="flex flex-wrap gap-2 text-sm font-semibold">
                            {{ helper.parsePostTags(post.tags) }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-col items-center gap-4 md:flex-row md:justify-end 2xl:justify-between">
                    <div class="inline-flex w-full justify-center gap-2 md:justify-start">
                        <template v-if="post_is_like">
                            <Button
                                v-tooltip.top="'Unlike'"
                                class="!border-accent !bg-white !p-4 !text-accent"
                                @click="onPostUnlike(post.id)">
                                <Heart />
                            </Button>
                        </template>
                        <template v-else>
                            <Button
                                v-tooltip.top="'Like'"
                                class="!p-4"
                                outlined
                                @click="onPostLike(post.id)">
                                <Heart />
                            </Button>
                        </template>
                        <Button
                            v-tooltip.top="'Save for later'"
                            class="!p-4"
                            outlined
                            @click="onPostSaveForLater(post.id)">
                            <Bookmark />
                        </Button>
                    </div>
                    <div class="inline-flex items-center justify-between gap-4">
                        <div class="inline-flex gap-2 hover:text-accent">
                            <Heart />
                            <span>{{ post.likes }}</span>
                        </div>
                        <div class="inline-flex gap-2 hover:text-accent">
                            <MessageCircle />
                            <span>{{ post.comments }}</span>
                        </div>
                        <div class="inline-flex gap-2 hover:text-accent">
                            <Eye />
                            <span>{{ post.views }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="inline-flex w-full justify-between">
                        <p class="font-semibold">Leave Comment</p>
                    </div>
                    <CommentForm :post-id="post.id" />
                </div>

                <div
                    class="flex flex-col gap-8"
                    v-if="post_comments.length">
                    <div class="inline-flex w-full justify-between">
                        <p class="font-semibold">Recent Comment</p>
                    </div>
                    <Comment
                        v-for="comment in post_comments"
                        :key="comment.id"
                        :id="comment.id"
                        :post-id="post.id"
                        :user-id="comment.user?.id || 0"
                        :comment="comment.comment"
                        :created-at="comment.created_at"
                        :heart="comment.likes"
                        :avatar="comment?.user?.avatar || ''"
                        :name="comment?.user?.name || ''"
                        :is-comment-like="comment.comment_is_like" />
                </div>
            </div>
        </div>
    </section>
    <Toast />
</template>

<script lang="ts" setup>
import { Link, router, useForm } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core';
import { Bookmark, EllipsisVertical, Eye, Heart, MessageCircle } from 'lucide-vue-next';
import Button from 'primevue/button';
import Image from 'primevue/image';
import Menu from 'primevue/menu';
import { useToast } from 'primevue/usetoast';
import { ref } from 'vue';
import Comment from '@/components/Comment/Comment.vue';
import CommentForm from '@/components/CommentForm/CommentForm.vue';
import Meta from '@/components/Meta/Meta.vue';
import useAuth from '@/composables/useAuth';
import useFlashMessage from '@/composables/useFlashMessage';
import useHelper from '@/composables/useHelper';
import useRoute from '@/composables/useRoute';
import { Post, PostAuthor, PostComment } from '@/types';

interface Props {
    post: Post;
    post_author: PostAuthor;
    post_author_is_followed: boolean;
    post_comments: PostComment[];
    post_is_like: boolean;
}

const props = defineProps<Props>();
const auth = useAuth();
const toast = useToast();
const route = useRoute();
const helper = useHelper();

const menu = ref();
const menuItems = ref([
    {
        command: () => router.visit(route('dashboard.photos.edit', { post: props.post.id })),
        icon: 'pi pi-file-edit',
        label: 'Edit Post',
    },
]);

function onPostLike(id: number) {
    if (!auth.isAuthenticated) {
        return useEventBus('modal:sign-in-now').emit();
    }
    useForm({ post_id: id }).post(route('post.like.store', { id }), {
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
        preserveState: true,
    });
}
function onPostUnlike(id: number) {
    if (!auth.isAuthenticated) {
        return useEventBus('modal:sign-in-now').emit();
    }
    useForm({ post_id: id }).delete(route('post.like.destroy', { id }), {
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
        preserveState: true,
    });
}
function onPostSaveForLater(id: number) {
    if (!auth.isAuthenticated) {
        return useEventBus('modal:sign-in-now').emit();
    }
    useForm({ post_id: id }).post(route('post.save-for-later.store', { id }), {
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
        preserveState: true,
    });
}
function onPostMenuToggle(e: Event) {
    menu.value.toggle(e);
}
function onMemberFollow(id: number) {
    if (!auth.isAuthenticated) {
        return useEventBus('modal:sign-in-now').emit();
    }
    useForm({}).post(route('members.follow.store', { user: id }), {
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
        preserveState: false,
    });
}
function onMemberUnfollow(id: number) {
    if (!auth.isAuthenticated) {
        return useEventBus('modal:sign-in-now').emit();
    }
    useForm({}).delete(route('members.follow.destroy', { user: id }), {
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
        preserveState: false,
    });
}
</script>

<style scoped></style>
