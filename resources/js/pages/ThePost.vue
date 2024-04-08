<template>
    <section class="">
        <Meta :title="post.title" />
        <div class="flex w-full flex-col lg:max-h-screen lg:flex-row">
            <div class="grid w-full place-content-center bg-[#171717] lg:w-7/12">
                <Image
                    :src="post.media?.xlarge"
                    :preview="true"
                    image-class="w-full lg:max-h-screen"
                    alt="media image" />
            </div>
            <div class="flex w-full flex-col gap-8 overflow-y-scroll p-8 md:p-12 lg:w-5/12">
                <div class="flex flex-col gap-4">
                    <h1 class="text-3xl font-bold capitalize leading-snug">
                        {{ post.title }}
                    </h1>
                    <div class="inline-flex items-center gap-4">
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            :alt="post_author.name"
                            :src="post_author?.avatar || ''" />
                        <div>
                            <ul class="inline-flex list-disc items-center gap-4 text-sm">
                                <li class="mr-1 list-none capitalize">{{ post_author.name }}</li>
                                <li class="mr-1">
                                    <a href="">Follow</a>
                                </li>
                                <li class="">
                                    <a
                                        href=""
                                        class="text-accent">
                                        Hire Me
                                    </a>
                                </li>
                            </ul>
                            <p class="text-sm text-slate-400">{{ helper.formatDate(post.created_at) }}</p>
                        </div>
                    </div>

                    <p class="leading-relaxed text-slate-500">
                        {{ post.description }}
                    </p>
                    <p class="flex flex-wrap gap-2 text-sm font-semibold">
                        {{ helper.parsePostTags(post.tags) }}
                    </p>
                </div>

                <div class="flex flex-row items-center justify-end gap-4 2xl:justify-between">
                    <div class="inline-flex w-full gap-2">
                        <template v-if="post_is_like">
                            <Button
                                class="!p-4"
                                @click="onPostUnlike(post.id)">
                                <Heart />
                            </Button>
                        </template>
                        <template v-else>
                            <Button
                                class="!p-4"
                                outlined
                                @click="onPostLike(post.id)">
                                <Heart />
                            </Button>
                        </template>
                        <Button
                            class="!p-4 !px-6"
                            outlined
                            @click="onPostSaveForLater(post.id)">
                            <span class="text-sm font-semibold">Save for later</span>
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

                <div class="">
                    <div class="inline-flex w-full justify-between">
                        <a
                            class="font-semibold"
                            href="">
                            Recent Comments
                        </a>
                        <a
                            class="font-semibold"
                            href="">
                            Leave Comment
                        </a>
                    </div>
                </div>
                <div>
                    <CommentForm />
                </div>
                <div class="flex flex-col gap-8">
                    <Comment
                        v-for="comment in comments"
                        :key="comment.id"
                        :comment="comment.comment"
                        :created-at="'6 days ago'"
                        :heart="12"
                        :image-source="comment.imageSource"
                        :name="comment.name" />
                </div>
            </div>
        </div>
    </section>
    <Toast />
</template>

<script lang="ts" setup>
import { useForm } from '@inertiajs/vue3';
import { Eye, Heart, MessageCircle } from 'lucide-vue-next';
import Button from 'primevue/button';
import Image from 'primevue/image';
import { useToast } from 'primevue/usetoast';
import Comment from '@/components/Comment/Comment.vue';
import CommentForm from '@/components/CommentForm/CommentForm.vue';
import Meta from '@/components/Meta/Meta.vue';
import useFlashMessage from '@/composables/useFlashMessage';
import useHelper from '@/composables/useHelper';
import useRoute from '@/composables/useRoute';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';
import { Post, PostAuthor } from '@/types';

interface Props {
    post: Post;
    post_author: PostAuthor;
    post_is_like: boolean;
}

defineProps<Props>();
defineOptions({ layout: PageLayoutPublic });

const toast = useToast();
const route = useRoute();
const helper = useHelper();
const comments = [
    {
        comment: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        createdAt: '1 day ago',
        hearts: 21,
        id: 1,
        imageSource:
            'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        name: 'John Doe',
    },
    {
        comment:
            'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        createdAt: '1 day ago',
        hearts: 21,
        id: 2,
        imageSource:
            'https://images.unsplash.com/photo-1687561114580-66fe98588cde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=683&q=80',
        name: 'Mary Doe',
    },
];

function onPostLike(id: number) {
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
        preserveState: true,
    });
}
function onPostUnlike(id: number) {
    useForm({ post_id: id }).post(route('post.unlike.store', { id }), {
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
        preserveState: true,
    });
}
function onPostSaveForLater(id: number) {
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
        preserveState: true,
    });
}
</script>

<style scoped></style>
