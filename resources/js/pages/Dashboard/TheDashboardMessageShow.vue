<template>
    <Meta title="View Messages" />
    <PageLayoutDashboard>
        <template #title>View Messages</template>
        <template #description>See your recent conversation here.</template>
        <section>
            <form
                @submit.prevent="onSubmit"
                class="flex flex-col gap-4">
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
                            class="ml-8 mt-2 rounded !border p-4"
                            v-if="slotProps.data.sender.id === auth.user?.id">
                            <p class="text-sm leading-relaxed">{{ slotProps.data.message }}</p>
                            <p class="text-sm leading-relaxed text-slate-400">
                                {{ helper.formatDateFromNow(slotProps.data.created_at) }}
                            </p>
                        </div>
                        <div
                            class="mr-8 mt-2 rounded !border !border-l-4 !border-l-accent p-4"
                            v-else>
                            <p class="text-sm leading-relaxed">{{ slotProps.data.message }}</p>
                            <p class="text-sm leading-relaxed text-slate-400">
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
                <InputError
                    :text="form.errors.message"
                    v-if="form.errors.message" />
                <div class="flex justify-end">
                    <Button
                        type="submit"
                        :loading="form.processing"
                        :size="'small'"
                        :outlined="true"
                        :label="'Send Message'" />
                </div>
            </form>
        </section>
    </PageLayoutDashboard>
</template>

<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { Archive, MoveLeft } from 'lucide-vue-next';
import Button from 'primevue/button';
import DataView from 'primevue/dataview';
import { useToast } from 'primevue/usetoast';
import InputError from '@/components/InputError/InputError.vue';
import Meta from '@/components/Meta/Meta.vue';
import useAuth from '@/composables/useAuth';
import useFlashMessage from '@/composables/useFlashMessage';
import useHelper from '@/composables/useHelper';
import useRoute from '@/composables/useRoute';
import PageLayoutDashboard from '@/layouts/PageLayoutDashboard.vue';
import { MessageThread } from '@/types';

interface Props {
    message_uuid: string;
    messages_thread: MessageThread[];
    message_user_id_receiver: number;
    message_thread_mark_as_read: boolean;
}
interface Form {
    message: string;
    message_user_id_receiver: number;
    message_uuid: string;
}

const props = defineProps<Props>();
const toast = useToast();
const helper = useHelper();
const route = useRoute();
const auth = useAuth();
const form = useForm<Form>({
    message: '',
    message_user_id_receiver: props.message_user_id_receiver,
    message_uuid: props.message_uuid,
});

function onArchive(uuid: string) {
    useForm({}).patch(route('dashboard.message-archive.update', { uuid }), {
        onError: (e) => console.error(e),
        preserveScroll: true,
    });
}
function onSubmit() {
    form.post(route('dashboard.message-thread.store', { uuid: props.message_uuid }), {
        onError: (e) => console.error(e),
        onSuccess: () => {
            const { error, success } = useFlashMessage();

            if (error) {
                toast.add({
                    detail: error,
                    life: 6000,
                    severity: 'error',
                    summary: 'Error',
                });
            }
            if (success) {
                toast.add({
                    detail: success,
                    life: 6000,
                    severity: 'success',
                    summary: 'Success',
                });
            }
            form.reset();
        },
        preserveScroll: true,
    });
}
</script>

<style>
.p-dataview .p-paginator-bottom {
    border: none !important;
}
</style>
