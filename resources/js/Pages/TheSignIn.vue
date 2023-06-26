<template>
    <section>
        <Meta title="Sign In" />

        <form class="flex flex-col gap-4 justify-center">
            <h1 class="font-bold text-4xl text-center">Sign-in</h1>
            <p class="leading-relaxed">Welcome back! Sign-in to your account now</p>
            <div class="flex flex-col gap-4 text-center justify-center px-8">
                <Button
                    icon="pi pi-google"
                    label="Sign-in with Google" />
                <Link href="">
                    <u>Create an account</u>
                </Link>
            </div>
        </form>
    </section>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Meta from '@/Components/Meta/Meta.vue';
import LayoutAuth from '@/Layouts/LayoutAuth.vue';

defineOptions({ layout: LayoutAuth });
</script>

<style scoped></style>
