<template>
    <div>
        <Link :href="route('portfolio')">
            <img
                :alt="imageAlt"
                :src="imageSource"
                class="w-full h-[18rem] object-cover rounded" />
        </Link>
    </div>
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';

defineProps<Props>();

interface Props {
    imageSource: string;
    imageAlt: string;
}
</script>

<style scoped></style>
