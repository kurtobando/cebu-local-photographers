<template>
    <Dialog
        class="mx-8 w-full md:w-[35rem]"
        :draggable="false"
        :modal="true"
        :close-on-escape="true"
        v-model:visible="isVisible">
        <template #header>
            <div class="flex flex-col">
                <h1 class="text-xl font-bold">Tell us more about the project</h1>
            </div>
        </template>
        <div class="mt-2 flex flex-col gap-4">
            <textarea
                class="w-full rounded !border-slate-300 p-4 !leading-relaxed"
                :rows="10"
                placeholder="Let me know how i can help ..."></textarea>
            <div class="flex flex-col items-center justify-between gap-2 md:flex-row">
                <p class="text-sm text-slate-400">10 messages remaining this month</p>
                <Button
                    class="!py-4 !text-sm"
                    outlined
                    label="Send Message" />
            </div>
        </div>
    </Dialog>
</template>

<script setup lang="ts">
import { useEventBus } from '@vueuse/core';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import { ref } from 'vue';

const isVisible = ref(false);

useEventBus('modal:hire-me').on((event, payload) => {
    isVisible.value = true;

    console.log({
        event,
        payload,
    });
});
</script>

<style scoped></style>
