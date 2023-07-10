<template>
    <LayoutTheFold>
        <Meta title="Portfolio" />
        <template v-slot:header>
            <div class="grid place-content-center -mt-8">
                <div
                    class="flex flex-col md:flex-row justify-center gap-8 items-center text-center md:text-left max-w-3xl">
                    <img
                        alt="avatar"
                        class="rounded-full w-52 h-52 object-cover mx-auto"
                        src="https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80" />
                    <div class="flex flex-col gap-2">
                        <h2 class="font-bold text-2xl">John Doe</h2>
                        <p class="leading-relaxed">
                            I’m John Doe, located in Cebu. I am a freelance photographer, send me a message if you are
                            interested.
                        </p>
                        <div class="inline-flex gap-4 mt-4 justify-center md:justify-start">
                            <a href="#">Follow</a>
                            <a href="#">Hire Me</a>
                        </div>
                        <div class="inline-flex gap-4 items-center justify-center md:justify-start">
                            <p class="inline-flex items-center gap-2">
                                <Image />
                                12
                            </p>
                            <p class="inline-flex items-center gap-2">
                                <UserSquare2 />
                                1k
                            </p>
                            <p class="inline-flex items-center gap-2">
                                <Medal />
                                Contributor
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6 gap-4">
            <CardAvatarImage
                v-for="(image, key) in images"
                :key="key"
                :image-alt="image.alt"
                :image-source="image.source" />
        </div>
    </LayoutTheFold>
</template>

<script lang="ts" setup>
import PageLayoutPublic from '@/Layouts/PageLayoutPublic.vue';
import LayoutTheFold from '@/Layouts/LayoutTheFold.vue';
import CardAvatarImage from '@/Components/CardAvatarImage/CardAvatarImage.vue';
import Meta from '@/Components/Meta/Meta.vue';
import { Image, UserSquare2, Medal } from 'lucide-vue-next';

const images = [
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687561114580-66fe98588cde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=683&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687365414421-147891bed96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579521846-7e8760eafe04?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=775&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1682687220305-ce8a9ab237b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
        alt: 'demo',
    },
    {
        source: 'https://plus.unsplash.com/premium_photo-1670333291486-6c29ace33919?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687360441387-0179af118555?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=627&q=80',
        alt: 'demo',
    },
    {
        source: 'https://plus.unsplash.com/premium_photo-1676654935906-570ac2f94180?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687561114580-66fe98588cde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=683&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687365414421-147891bed96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687561114580-66fe98588cde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=683&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687365414421-147891bed96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579521846-7e8760eafe04?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=775&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1682687220305-ce8a9ab237b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
        alt: 'demo',
    },
    {
        source: 'https://plus.unsplash.com/premium_photo-1670333291486-6c29ace33919?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687360441387-0179af118555?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=627&q=80',
        alt: 'demo',
    },
    {
        source: 'https://plus.unsplash.com/premium_photo-1676654935906-570ac2f94180?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687561114580-66fe98588cde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=683&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687365414421-147891bed96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
];

defineOptions({ layout: PageLayoutPublic });
</script>

<style scoped></style>
