<template>
    <div class="hidden items-center justify-between gap-8 text-sm lg:inline-flex">
        <nav class="inline-flex items-center gap-8">
            <Link :href="route('home')">Discover</Link>
            <Link :href="route('events')">Events</Link>
            <Link :href="route('members')">Members</Link>
        </nav>
        <nav
            v-if="isAuthenticated"
            class="font-sm inline-flex items-center gap-8 text-sm">
            <Link href="">
                <Bell />
            </Link>
            <Avatar
                class="custom-avatar uppercase"
                :shape="'circle'"
                :size="'large'"
                :image="auth.user?.avatar"
                :label="auth.user?.avatar ? '' : user?.name.slice(0, 1)"
                @click="onToggle($event)" />
            <Menu
                ref="menu"
                :model="items"
                :popup="true">
                <template #start>
                    <div class="flex flex-col p-4 px-5">
                        <p class="truncate font-bold">{{ user?.name }}</p>
                        <p class="truncate text-sm text-slate-400">{{ user?.email }}</p>
                    </div>
                </template>
                <template #item="slotProps">
                    <p class="flex flex-row items-center gap-2 p-2 px-5 py-3">
                        <span :class="slotProps.item.icon"></span>
                        <span class="text-sm">{{ slotProps.item.label }}</span>
                    </p>
                </template>
            </Menu>
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
import { Link, router } from '@inertiajs/vue3';
import { Bell } from 'lucide-vue-next';
import Avatar from 'primevue/avatar';
import Button from 'primevue/button';
import Menu from 'primevue/menu';
import { ref } from 'vue';
import useAuth from '@/composables/useAuth';
import useRoute from '@/composables/useRoute';

const auth = useAuth();
const route = useRoute();
const { isAuthenticated, user } = useAuth();

const menu = ref();
const items = ref([
    {
        command: () => router.visit(route('dashboard.profile')),
        icon: 'pi pi-user',
        label: 'Profile',
    },
    {
        command: () => router.visit(route('dashboard.photos.create')),
        icon: 'pi pi-upload',
        label: 'Upload Photo',
    },
    {
        command: () => router.post(route('dashboard.sign-out')),
        icon: 'pi pi-sign-out',
        label: 'Sign-out',
    },
]);

function onToggle(e: Event) {
    menu.value.toggle(e);
}
</script>

<style>
.custom-avatar img {
    object-fit: cover !important;
}
</style>
