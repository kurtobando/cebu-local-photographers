<template>
    <div class="flex max-w-3xl flex-col items-center justify-center gap-8 text-center md:flex-row md:text-left">
        <img
            referrerpolicy="no-referrer"
            :alt="name"
            :src="imageSource"
            class="mx-auto h-52 w-52 rounded-full object-cover" />
        <div class="flex flex-col gap-2">
            <h2 class="text-2xl font-bold">{{ name }}</h2>
            <p class="leading-relaxed">{{ about }}</p>
            <div class="mt-4 inline-flex justify-center gap-4 md:justify-start">
                <a href="#">Follow</a>
                <a href="#">Hire Me</a>
            </div>
            <div class="inline-flex items-center justify-center gap-4 md:justify-start">
                <p class="inline-flex items-center gap-2">
                    <Image />
                    {{ posts }}
                </p>
                <p class="inline-flex items-center gap-2">
                    <UserSquare2 />
                    {{ followers }}
                </p>
                <p class="inline-flex items-center gap-2">
                    <Medal />
                    {{ role }}
                </p>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { Image, Medal, UserSquare2 } from 'lucide-vue-next';

defineProps<Props>();

interface Props {
    imageSource: string;
    name: string;
    about: string;
    followers: number;
    posts: number;
    role: string;
}
</script>

<style scoped></style>
