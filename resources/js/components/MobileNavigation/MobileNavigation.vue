<template>
    <Sidebar
        v-model:visible="visible"
        class="!w-[90%] !p-4 md:!w-[50%]">
        <div>
            <Brand @click="toggleVisible" />
            <div class="mt-14 flex flex-col gap-8 font-medium">
                <nav class="flex flex-col gap-8">
                    <Link
                        :href="route('home')"
                        class="inline-flex items-center gap-3"
                        @click="toggleVisible">
                        <HeartHandshake />
                        <span>Discover</span>
                    </Link>
                    <Link
                        :href="route('events')"
                        class="inline-flex items-center gap-3"
                        @click="toggleVisible">
                        <Star />
                        <span>Events</span>
                    </Link>
                    <Link
                        :href="route('members')"
                        class="inline-flex items-center gap-3"
                        @click="toggleVisible">
                        <Users />
                        <span>Members</span>
                    </Link>
                </nav>
                <nav
                    v-if="isAuthenticated"
                    class="flex flex-col gap-8">
                    <Link
                        class="inline-flex items-center gap-3"
                        :href="route('dashboard.photos.create')"
                        @click="toggleVisible">
                        <Image />
                        <span>My Photos</span>
                    </Link>
                    <Link
                        class="inline-flex items-center gap-3"
                        :href="route('dashboard.profile')"
                        @click="toggleVisible">
                        <User2 />
                        <span>My Profile</span>
                    </Link>
                    <Link
                        class="inline-flex items-center gap-3"
                        href=""
                        @click="toggleVisible">
                        <Bell />
                        <span>Notification</span>
                    </Link>
                    <Link
                        as="button"
                        :href="route('dashboard.sign-out')"
                        class="inline-flex items-center gap-3"
                        method="post"
                        @click="toggleVisible">
                        <LogOut />
                        <span>Sign-out</span>
                    </Link>
                    <Link
                        href=""
                        @click="toggleVisible">
                        <Button
                            :label="'Submit a Photo'"
                            class="w-full" />
                    </Link>
                </nav>
                <nav
                    v-if="!isAuthenticated"
                    class="flex flex-col gap-8">
                    <Link
                        :href="route('sign-in')"
                        class="inline-flex items-center gap-3"
                        @click="toggleVisible">
                        <User2 />
                        <span>Sign-in</span>
                    </Link>
                    <Link
                        :href="route('sign-up')"
                        @click="toggleVisible">
                        <Button
                            class="w-full"
                            label="Create an account" />
                    </Link>
                </nav>
            </div>
        </div>
    </Sidebar>
    <Menu
        :size="28"
        class="cursor-pointer hover:text-accent lg:hidden"
        @click="visible = true" />
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import { Bell, HeartHandshake, Image, LogOut, Menu, Star, User2, Users } from 'lucide-vue-next';
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';
import { ref } from 'vue';
import Brand from '@/components/Brand/Brand.vue';
import useAuth from '@/composables/useAuth';

const { isAuthenticated } = useAuth();
const visible = ref(false);

function toggleVisible() {
    visible.value = !visible.value;
}
</script>

<style scoped></style>
