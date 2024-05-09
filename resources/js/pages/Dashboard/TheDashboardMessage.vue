<template>
    <Meta title="Messages" />
    <PageLayoutDashboard>
        <template #title>Messages</template>
        <template #description>See your recent conversation here.</template>
        <section>
            <div class="flex flex-col gap-4">
                <DataView
                    :rows="4"
                    :paginator="true"
                    :value="messages"
                    :data-key="'id'">
                    <template #list="slotProps">
                        <div
                            :class="{
                                '!border-l-4 !border-l-accent': slotProps.data.is_unread,
                            }"
                            class="mt-2 rounded !border p-4">
                            <Link
                                :class="{
                                    '!font-bold': slotProps.data.is_unread,
                                }"
                                class="inline-block text-sm leading-relaxed"
                                :href="route('dashboard.message.show', { uuid: slotProps.data.uuid })">
                                {{ slotProps.data.subject }}
                            </Link>
                            <p class="text-sm leading-relaxed text-slate-400">
                                {{ helper.formatDate(slotProps.data.created_at) }},
                                {{ helper.formatDateFromNow(slotProps.data.created_at) }}
                            </p>
                        </div>
                    </template>
                    <template #empty>
                        <p class="py-4 text-sm text-slate-400">No message yet, come back later.</p>
                    </template>
                </DataView>
            </div>
        </section>
    </PageLayoutDashboard>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import DataView from 'primevue/dataview';
import Meta from '@/components/Meta/Meta.vue';
import useHelper from '@/composables/useHelper';
import useRoute from '@/composables/useRoute';
import PageLayoutDashboard from '@/layouts/PageLayoutDashboard.vue';
import { Message } from '@/types';

interface Props {
    messages: Message[];
}

defineProps<Props>();

const route = useRoute();
const helper = useHelper();
</script>

<style>
.p-dataview .p-paginator-bottom {
    border: none !important;
}
</style>
