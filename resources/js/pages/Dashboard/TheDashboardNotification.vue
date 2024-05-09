<template>
    <Meta title="Notification" />
    <PageLayoutDashboard>
        <template #title>Notification</template>
        <template #description>Manage your recent notification</template>

        <DataView
            :rows="4"
            :paginator="true"
            :value="notification_unread ?? []"
            :data-key="'id'">
            <template #list="slotProps">
                <div
                    :class="{
                        '!border-l-4 !border-l-accent': !slotProps.data.is_read,
                    }"
                    class="mt-2 rounded !border !border-slate-200 p-4">
                    <p class="text-sm font-bold leading-relaxed">{{ slotProps.data?.data?.subject }}</p>
                    <p class="text-sm leading-relaxed">{{ slotProps.data?.data?.message }}</p>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-sm leading-relaxed text-slate-400">
                            {{ helper.formatDate(slotProps.data.created_at) }},
                            {{ helper.formatDateFromNow(slotProps.data.created_at) }}
                        </p>
                        <p class="flex items-center gap-2">
                            <a
                                @click="onRead(slotProps.data.id, slotProps.data?.data?.action)"
                                class="flex cursor-pointer items-center gap-1 text-sm">
                                <Eye :size="18" />
                                <span>Read</span>
                            </a>
                            <a
                                @click="onMarkAsRead(slotProps.data.id)"
                                class="flex cursor-pointer items-center gap-1 text-sm">
                                <EyeOff :size="18" />
                                <span>Mark as read</span>
                            </a>
                        </p>
                    </div>
                </div>
            </template>
        </DataView>
    </PageLayoutDashboard>
</template>

<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import { Eye, EyeOff } from 'lucide-vue-next';
import DataView from 'primevue/dataview';
import { useToast } from 'primevue/usetoast';
import Meta from '@/components/Meta/Meta.vue';
import useFlashMessage from '@/composables/useFlashMessage';
import useHelper from '@/composables/useHelper';
import useRoute from '@/composables/useRoute';
import PageLayoutDashboard from '@/layouts/PageLayoutDashboard.vue';
import { NotificationUnread } from '@/types';

interface Props {
    notification_unread: NotificationUnread[] | null;
}

defineProps<Props>();

const toast = useToast();
const route = useRoute();
const helper = useHelper();

// TODO! implement a better way to handle this, cause we need to refresh prior redirect to action
function onRead(id: string, action: string) {
    useForm({}).patch(route('dashboard.notification.update', { uuid: id }), {
        onError: (e) => console.error(e),
        onSuccess: () => {
            const { error, success } = useFlashMessage();

            if (success) {
                router.visit(action);
            }
            if (error) {
                toast.add({
                    detail: error,
                    life: 6000,
                    severity: 'error',
                    summary: 'Error',
                });
            }
        },
        preserveScroll: true,
        preserveState: false,
    });
}
function onMarkAsRead(id: string) {
    useForm({}).patch(route('dashboard.notification.update', { uuid: id }), {
        onError: (e) => console.error(e),
        onSuccess: () => {
            const { error, success } = useFlashMessage();

            if (success) {
                toast.add({
                    detail: success,
                    life: 6000,
                    severity: 'success',
                    summary: 'Success',
                });
            }
            if (error) {
                toast.add({
                    detail: error,
                    life: 6000,
                    severity: 'error',
                    summary: 'Error',
                });
            }
        },
        preserveScroll: true,
        preserveState: false,
    });
}
</script>

<style scoped></style>
