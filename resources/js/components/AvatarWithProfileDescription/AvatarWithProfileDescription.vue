<template>
    <div class="flex flex-row gap-8">
        <div class="flex w-1/3 items-center justify-end">
            <img
                class="h-[12rem] w-[12rem] rounded-full object-cover"
                width="200"
                height="200"
                :src="imageSource"
                :alt="name" />
        </div>
        <div class="flex w-2/3 flex-col justify-center gap-2">
            <h2 class="text-2xl font-bold">{{ name }}</h2>
            <p class="leading-relaxed">{{ about }}</p>
            <div class="flex flex-col gap-2">
                <ul class="inline-flex gap-4">
                    <li class="font-bold">Follow</li>
                    <li class="font-bold text-accent">Hire Me</li>
                </ul>
                <ul class="inline-flex gap-4">
                    <li class="inline-flex items-center gap-1">
                        <Camera />
                        <span>10</span>
                    </li>
                    <li class="inline-flex items-center gap-1">
                        <Users />
                        <span>1k</span>
                    </li>
                    <li class="inline-flex items-center gap-1">
                        <Award />
                        <span>Moderator</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Award, Camera, Users } from 'lucide-vue-next';
interface Props {
    imageSource: string;
    name: string;
    about: string;
}

defineProps<Props>();
</script>

<style scoped></style>
