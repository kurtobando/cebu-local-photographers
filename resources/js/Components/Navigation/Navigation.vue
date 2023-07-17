<template>
    <div class="hidden gap-16 text-sm lg:inline-flex">
        <nav class="inline-flex items-center gap-8">
            <Link :href="route('home')">Discover</Link>
            <Link :href="route('events')">Events</Link>
            <Link :href="route('members')">Members</Link>
        </nav>
        <nav class="inline-flex items-center gap-8">
            <Link :href="route('sign-in')">Sign-in</Link>
            <Link :href="route('sign-up')">
                <Button
                    label="Create an account"
                    class="!py-[0.9rem] !text-sm" />
            </Link>
        </nav>
    </div>
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import Button from 'primevue/button';
</script>

<style scoped></style>
