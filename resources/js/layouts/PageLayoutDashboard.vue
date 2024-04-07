<template>
    <main class="flex min-h-screen w-full flex-col bg-slate-50">
        <Header />
        <section class="p-8">
            <div class="mx-auto flex w-full max-w-7xl flex-col gap-10 rounded bg-white p-8 shadow md:flex-row md:gap-8">
                <div class="md:pt-6">
                    <SidebarNavigation />
                </div>
                <div class="flex w-full flex-col gap-4">
                    <div>
                        <h2 class="text-2xl font-bold">
                            <slot name="title" />
                        </h2>
                        <p class="text-sm text-slate-400">
                            <slot name="description" />
                        </p>
                    </div>
                    <slot />
                </div>
            </div>
        </section>
    </main>
    <Toast />
</template>

<script lang="ts" setup>
import Toast from 'primevue/toast';
import Header from '@/components/Header/Header.vue';
import SidebarNavigation from '@/components/SidebarNavigation/SidebarNavigation.vue';
</script>

<style scoped></style>
