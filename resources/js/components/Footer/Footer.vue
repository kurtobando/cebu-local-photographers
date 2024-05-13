<template>
    <footer class="w-full border-t border-slate-100 p-8">
        <div class="flex flex-col justify-center gap-4 text-sm text-slate-600 md:flex-row">
            <p class="text-center">
                <Link :href="route('privacy')">Privacy Policy</Link>
            </p>
            <p class="text-center">
                <Link :href="route('term-of-service')">Terms of Service</Link>
            </p>
            <p class="text-center">
                <a href="/sitemap.xml">Sitemap</a>
            </p>
            <p class="text-center">© {{ new Date().getFullYear() }} All rights reserved</p>
        </div>
    </footer>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import useRoutes from '@/composables/useRoute';

const route = useRoutes();
</script>

<style scoped></style>
