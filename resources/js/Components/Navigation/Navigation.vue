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
                class="uppercase"
                :size="'large'"
                :label="user?.name.slice(0, 1)"
                @click="onToggle($event)" />
            <Menu
                ref="menu"
                :model="items"
                :popup="true">
                <template #start>
                    <div class="flex flex-col p-4 px-5">
                        <p class="font-bold capitalize">{{ user?.name }}</p>
                        <p class="text-sm capitalize">{{ user?.role }}</p>
                    </div>
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

const route = useRoute();
const { isAuthenticated, user } = useAuth();

const menu = ref();
const items = ref([
    {
        items: [
            {
                command: () => router.visit(route('dashboard.profile')),
                icon: 'pi pi-user',
                label: 'Profile',
            },
            {
                command: () => router.visit(route('dashboard.photos.create')),
                icon: 'pi pi-image',
                label: 'Submit Photo',
            },
            {
                command: () => router.post(route('dashboard.sign-out')),
                icon: 'pi pi-sign-out',
                label: 'Sign-out',
            },
        ],
        label: 'Menus',
    },
]);

function onToggle(e: Event) {
    menu.value.toggle(e);
}
</script>

<style scoped></style>
