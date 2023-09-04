<template>
    <div class="hidden gap-16 text-sm lg:inline-flex">
        <nav class="inline-flex items-center gap-8">
            <Link :href="route('home')">Discover</Link>
            <Link :href="route('events')">Events</Link>
            <Link :href="route('members')">Members</Link>
        </nav>
        <nav
            v-if="isAuthenticated"
            class="font-sm inline-flex items-center gap-8 text-sm">
            <Link href="">My Photos</Link>
            <Link :href="route('dashboard.profile')">My Profile</Link>
            <Link
                as="button"
                :href="route('dashboard.sign-out')"
                method="post">
                Sign-out
            </Link>
            <Link href="">
                <Bell />
            </Link>
            <Link href="">
                <Button
                    :label="'Submit a Photo'"
                    class="!py-[0.9rem] !text-sm" />
            </Link>
        </nav>
        <nav
            v-if="!isAuthenticated"
            class="inline-flex items-center gap-8">
            <Link :href="route('sign-in')">Sign-in</Link>
            <Link :href="route('sign-up')">
                <Button
                    class="!py-[0.9rem] !text-sm"
                    label="Create an account" />
            </Link>
        </nav>
    </div>
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import { Bell } from 'lucide-vue-next';
import Button from 'primevue/button';
import useAuth from '@/composables/useAuth';

const { isAuthenticated } = useAuth();
</script>

<style scoped></style>
