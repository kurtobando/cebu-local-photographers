<template>
    <form class="flex flex-col items-end gap-4">
        <textarea
            class="h-32 w-full rounded p-4"
            placeholder="Leave your comment here ..."></textarea>
        <div class="inline-flex gap-2">
            <Button
                :icon="'pi pi-times'"
                :label="'Cancel'"
                outlined />
            <Button
                :icon="'pi pi-send'"
                :label="'Send'" />
        </div>
    </form>
</template>

<script lang="ts" setup>
import Button from 'primevue/button';
</script>

<style scoped></style>
