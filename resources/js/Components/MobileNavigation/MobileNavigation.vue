<template>
    <Sidebar
        v-model:visible="visible"
        class="!w-[90%] md:!w-[50%] !p-4">
        <div>
            <Brand />
            <div class="flex flex-col gap-8 font-medium mt-14">
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
        class="cursor-pointer lg:hidden hover:text-accent"
        @click="visible = true" />
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Menu, User2, HeartHandshake, Users, Star } from 'lucide-vue-next';
import Sidebar from 'primevue/sidebar';
import Button from 'primevue/button';
import Brand from '@/Components/Brand/Brand.vue';

const visible = ref(false);

function toggleVisible() {
    visible.value = !visible.value;
}
</script>

<style scoped></style>
