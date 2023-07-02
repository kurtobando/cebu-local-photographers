<template>
    <div class="hidden lg:inline-flex gap-12">
        <nav class="inline-flex items-center gap-8">
            <Link href="">Discover</Link>
            <Link href="">Events</Link>
            <Link href="">Members</Link>
        </nav>
        <nav class="inline-flex items-center gap-8">
            <Link :href="route('sign-in')">Sign-in</Link>
            <Link :href="route('sign-up')">
                <Button label="Create an account" />
            </Link>
        </nav>
    </div>
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import Button from 'primevue/button';
import useRoute from '@/composables/useRoute';

const route = useRoute();
</script>

<style scoped></style>
