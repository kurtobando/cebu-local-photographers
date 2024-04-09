<template>
    <PageLayoutPublic>
        <Meta :title="`${user.name}`" />
        <LayoutTheFold>
            <p>hello world</p>
        </LayoutTheFold>
    </PageLayoutPublic>
</template>

<script lang="ts" setup>
import Meta from '@/components/Meta/Meta.vue';
import LayoutTheFold from '@/layouts/LayoutTheFold.vue';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';
import { User } from '@/types';

interface Props {
    user: User;
}

defineProps<Props>();
</script>

<style scoped></style>
