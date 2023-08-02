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
                <nav class="flex flex-col gap-8">
                    <Link
                        class="inline-flex items-center gap-3"
                        href=""
                        @click="toggleVisible">
                        <Image />
                        <span>My Photos</span>
                    </Link>
                    <Link
                        class="inline-flex items-center gap-3"
                        href=""
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
                        href=""
                        @click="toggleVisible">
                        <Button
                            :label="'Submit a Photo'"
                            class="w-full" />
                    </Link>
                </nav>
                <nav class="flex flex-col gap-8">
                    <Link
                        :href="route('dashboard.sign-out')"
                        class="inline-flex items-center gap-3"
                        method="POST"
                        @click="toggleVisible">
                        <LogOut />
                        <span>Sign-out</span>
                    </Link>
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
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Menu, User2, HeartHandshake, Users, Star, Bell, Image, LogOut } from 'lucide-vue-next';
import Sidebar from 'primevue/sidebar';
import Button from 'primevue/button';
import Brand from '@/Components/Brand/Brand.vue';

const visible = ref(false);

function toggleVisible() {
    visible.value = !visible.value;
}
</script>

<style scoped></style>
