<template>
    <section class="-m-8">
        <Meta :title="post.title" />
        <div class="flex w-full flex-col lg:flex-row">
            <div class="w-full bg-gray-900 lg:w-7/12">
                <img
                    class="min-h-screen w-full object-contain"
                    :alt="post.title"
                    :src="post.media?.xlarge" />
            </div>
            <div class="flex w-full flex-col gap-8 p-8 md:p-12 lg:w-5/12">
                <h1 class="text-3xl font-semibold leading-relaxed">
                    {{ post.title }}
                </h1>
                <ul class="inline-flex items-center gap-4">
                    <li>
                        <img
                            alt="avatar image"
                            class="h-16 w-16 rounded-full object-cover"
                            src="https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80" />
                    </li>
                    <li class="font-semibold">John Doe</li>
                    <li>
                        <a href="">Follow</a>
                    </li>
                    <li>
                        <a href="">Hire Me</a>
                    </li>
                </ul>
                <p class="leading-relaxed">
                    {{ post.description }}
                </p>
                <p class="flex flex-wrap gap-2 text-sm font-semibold">
                    {{ post.tags }}
                    <a href="">#photography</a>
                    <a href="">#cebu</a>
                </p>
                <div class="flex flex-col items-center justify-between gap-8 xl:flex-row">
                    <div class="inline-flex w-full gap-4">
                        <Button>
                            <Heart />
                        </Button>
                        <Button
                            class="flex-grow xl:flex-grow-0"
                            label="Save for later"
                            outlined />
                    </div>
                    <div class="inline-flex items-center justify-between gap-8">
                        <p class="inline-flex gap-2 hover:text-accent">
                            <Heart />
                            <span>1.2k</span>
                        </p>
                        <p class="inline-flex gap-2 hover:text-accent">
                            <MessageCircle />
                            1.2k
                        </p>
                        <p class="inline-flex gap-2 hover:text-accent">
                            <Eye />
                            1.2k
                        </p>
                    </div>
                </div>
                <div class="mt-16">
                    <div class="inline-flex w-full justify-between">
                        <a
                            class="text-lg font-semibold"
                            href="">
                            Recent Comments
                        </a>
                        <a
                            class="text-lg font-semibold"
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
</template>

<script lang="ts" setup>
import { Eye, Heart, MessageCircle } from 'lucide-vue-next';
import Button from 'primevue/button';
import Comment from '@/components/Comment/Comment.vue';
import CommentForm from '@/components/CommentForm/CommentForm.vue';
import Meta from '@/components/Meta/Meta.vue';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';
import { Post } from '@/types';

interface Props {
    post: Post;
}

defineProps<Props>();
defineOptions({ layout: PageLayoutPublic });

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
</script>

<style scoped></style>
