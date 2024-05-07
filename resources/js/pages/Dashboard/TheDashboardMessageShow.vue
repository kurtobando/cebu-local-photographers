<template>
    <Meta title="View Messages" />
    <PageLayoutDashboard>
        <template #title>View Messages</template>
        <template #description>See your recent conversation here.</template>
        <section>
            <div class="flex flex-col gap-4">
                <div class="flex justify-between">
                    <Link
                        :href="route('dashboard.message.index')"
                        class="flex items-center gap-2 text-sm">
                        <MoveLeft />
                        Back to Messages
                    </Link>
                    <div class="text-sm">
                        <a
                            v-tooltip.top="'Archive this message'"
                            class="flex cursor-pointer items-center gap-2"
                            @click="onArchive(message_uuid)">
                            <Archive :size="18" />
                            Archive
                        </a>
                    </div>
                </div>
                <DataView
                    :rows="4"
                    :paginator="true"
                    :value="messages_thread"
                    :data-key="'uuid'">
                    <template #list="slotProps">
                        <div
                            class="mr-8 mt-4 rounded !border p-4"
                            v-if="slotProps.data.sender.id === auth.user?.id">
                            <p class="text-sm leading-relaxed">{{ slotProps.data.message }}</p>
                            <p class="text-xs leading-relaxed text-slate-400">
                                {{ helper.formatDateFromNow(slotProps.data.created_at) }}
                            </p>
                        </div>
                        <div
                            class="ml-8 mt-4 rounded !border !border-r-4 !border-r-accent p-4"
                            v-else>
                            <p class="text-sm leading-relaxed">{{ slotProps.data.message }}</p>
                            <p class="text-xs leading-relaxed text-slate-400">
                                {{ helper.formatDateFromNow(slotProps.data.created_at) }}
                            </p>
                        </div>
                    </template>
                </DataView>

                <textarea
                    v-model="form.message"
                    class="w-full rounded border-slate-200 p-4 text-sm leading-relaxed"
                    placeholder="Reply to this message..."
                    :rows="8">
                </textarea>
                <div class="flex justify-end">
                    <Button
                        :loading="form.processing"
                        :size="'small'"
                        :outlined="true"
                        :label="'Send Message'" />
                </div>
            </div>
        </section>
    </PageLayoutDashboard>
</template>

<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { Archive, MoveLeft } from 'lucide-vue-next';
import Button from 'primevue/button';
import DataView from 'primevue/dataview';
import Meta from '@/components/Meta/Meta.vue';
import useAuth from '@/composables/useAuth';
import useHelper from '@/composables/useHelper';
import useRoute from '@/composables/useRoute';
import PageLayoutDashboard from '@/layouts/PageLayoutDashboard.vue';
import { MessageThread } from '@/types';

interface Props {
    message_uuid: string;
    messages_thread: MessageThread[];
}

defineProps<Props>();

const helper = useHelper();
const route = useRoute();
const auth = useAuth();
const form = useForm({
    message: '',
});

function onArchive(uuid: string) {
    useForm({}).patch(route('dashboard.message-archive.update', { uuid }), {
        onError: (e) => console.error(e),
        preserveScroll: true,
    });
}
</script>

<style>
.p-dataview .p-paginator-bottom {
    border: none !important;
}
</style>
