<template>
    <PageLayoutPublic>
        <LayoutTheFold>
            <Meta title="Members" />
            <template v-slot:header>
                <h1 class="text-center text-2xl font-bold leading-relaxed">
                    Meet the people behind their amazing work
                </h1>
            </template>
            <div class="flex flex-row flex-wrap items-center justify-center gap-2 px-8">
                <CardMember
                    v-for="user in users"
                    :key="user.id"
                    :id="user.id"
                    :name="user.name"
                    :avatar="user.avatar" />
            </div>
        </LayoutTheFold>
    </PageLayoutPublic>
</template>

<script lang="ts" setup>
import CardMember from '@/components/CardMember/CardMember.vue';
import Meta from '@/components/Meta/Meta.vue';
import LayoutTheFold from '@/layouts/LayoutTheFold.vue';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';
import { User } from '@/types';

interface Props {
    users: User[];
}

defineProps<Props>();
</script>

<style scoped></style>
