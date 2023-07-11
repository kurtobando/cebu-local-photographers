<template>
    <div class="flex flex-col md:flex-row justify-center gap-8 items-center text-center md:text-left max-w-3xl">
        <img
            :alt="name"
            :src="imageSource"
            class="rounded-full w-52 h-52 object-cover mx-auto" />
        <div class="flex flex-col gap-2">
            <h2 class="font-bold text-2xl">{{ name }}</h2>
            <p class="leading-relaxed">{{ about }}</p>
            <div class="inline-flex gap-4 mt-4 justify-center md:justify-start">
                <a href="#">Follow</a>
                <a href="#">Hire Me</a>
            </div>
            <div class="inline-flex gap-4 items-center justify-center md:justify-start">
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
