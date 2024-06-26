<template>
    <PageLayoutPublic>
        <Meta :title="`${user.name}`" />
        <LayoutTheFold>
            <section class="flex flex-col items-center gap-16">
                <div class="mx-auto flex w-full flex-col gap-8 px-8 md:w-[50rem] md:flex-row">
                    <div class="flex w-full flex-row items-center justify-center md:w-1/3 md:justify-end">
                        <img
                            class="h-48 w-48 rounded-full object-cover"
                            referrerpolicy="no-referrer"
                            :src="user.avatar.replace('=s96-c', '')"
                            :alt="user.name" />
                    </div>
                    <div class="flex w-full flex-col items-center justify-center gap-2 md:w-2/3 md:items-start">
                        <h2 class="text-2xl font-bold capitalize">{{ user.name }}</h2>
                        <p class="text-center text-sm leading-relaxed text-slate-400 md:text-left">{{ user.about }}</p>
                        <ul class="mt-4 inline-flex gap-2">
                            <template v-if="auth.isAuthenticated && auth.user?.id !== user.id">
                                <li>
                                    <template v-if="user_is_followed">
                                        <a
                                            class="cursor-pointer"
                                            @click="onMemberUnfollow(user.id)">
                                            Unfollow
                                        </a>
                                    </template>
                                    <template v-else>
                                        <a
                                            class="cursor-pointer"
                                            @click="onMemberFollow(user.id)">
                                            Follow
                                        </a>
                                    </template>
                                </li>
                            </template>
                            <li v-if="auth.user?.id !== user.id">
                                <a
                                    @click="onHireMe(user.id)"
                                    class="cursor-pointer text-accent">
                                    Hire Me
                                </a>
                            </li>
                        </ul>
                        <ul class="inline-flex gap-3 text-sm">
                            <li class="inline-flex items-center gap-1">
                                <Image :size="20" />
                                {{ posts_count }}
                            </li>
                            <li class="inline-flex items-center gap-1">
                                <Users :size="20" />
                                {{ user_follower_count }}
                            </li>
                            <li class="inline-flex items-center gap-1">
                                h

                                <Award :size="20" />
                                <span class="capitalize"> {{ user.role }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                    <template
                        v-for="post in posts"
                        :key="post.id">
                        <Link
                            :href="route('post', { id: post.id })"
                            class="custom-card-image relative inline-block">
                            <CardImage
                                class="!h-[30rem] !rounded-none"
                                :image-source="post?.media?.medium || ''"
                                :image-alt="post.title" />
                            <div
                                class="custom-card-image-caption absolute bottom-0 left-0 w-full bg-gradient-to-t from-gray-950 transition-opacity">
                                <div class="inline-flex items-center gap-4 p-6 pt-28">
                                    <img
                                        referrerpolicy="no-referrer"
                                        class="h-12 w-12 rounded-full bg-slate-50 object-cover"
                                        :src="post?.user?.avatar"
                                        :alt="post?.user?.name" />
                                    <div class="flex flex-col">
                                        <p class="capitalize text-white">{{ post?.user?.name }}</p>
                                        <p class="text-sm text-slate-400">{{ helper.formatDate(post?.created_at) }}</p>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </template>
                </div>
            </section>
        </LayoutTheFold>
    </PageLayoutPublic>
</template>

<script lang="ts" setup>
import { Link, useForm } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core';
import { Award, Image, Users } from 'lucide-vue-next';
import { useToast } from 'primevue/usetoast';
import CardImage from '@/components/CardImage/CardImage.vue';
import Meta from '@/components/Meta/Meta.vue';
import useAuth from '@/composables/useAuth';
import useFlashMessage from '@/composables/useFlashMessage';
import useHelper from '@/composables/useHelper';
import useRoute from '@/composables/useRoute';
import LayoutTheFold from '@/layouts/LayoutTheFold.vue';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';
import { Post, User } from '@/types';

interface Props {
    user: User;
    user_is_followed: boolean;
    user_follower_count: number;
    posts: Post[];
    posts_count: number;
}

defineProps<Props>();

const auth = useAuth();
const toast = useToast();
const route = useRoute();
const helper = useHelper();

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
function onHireMe(user_id: number) {
    if (!auth.isAuthenticated) {
        return useEventBus('modal:sign-in-now').emit();
    }
    useEventBus('modal:hire-me').emit(null, {
        user_id,
    });
}
</script>

<style>
.custom-card-image:hover > .custom-card-image-caption {
    opacity: 0 !important;
}
</style>
