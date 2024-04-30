<template>
    <Dialog
        :close-on-escape="true"
        class="w-full !rounded md:w-1/3"
        :draggable="false"
        :modal="true"
        :closable="false"
        v-model:visible="isVisible">
        <div ref="modalRef">
            <div class="flex flex-col gap-2">
                <h1 class="text-2xl font-bold">Hey there! Looks like you're trying to access a cool feature.</h1>
                <p>Just a heads-up: you'll need to sign in first to unlock it. Don't worry, it's quick and easy!</p>
            </div>
            <div class="mt-8 flex flex-col justify-end gap-2 lg:flex-row">
                <Button
                    severity="primary"
                    class=""
                    outlined
                    @click="onCreateAccount">
                    Create account
                </Button>
                <Button
                    severity="primary"
                    class="!font-bold"
                    @click="onSignIn">
                    Sign-in
                </Button>
            </div>
        </div>
    </Dialog>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { onClickOutside, useEventBus } from '@vueuse/core';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import { ref } from 'vue';
import useRoutes from '@/composables/useRoute';

const route = useRoutes();
const modalRef = ref(null);
const isVisible = ref(false);

function onSignIn() {
    router.visit(route('sign-in'));
}
function onCreateAccount() {
    router.visit(route('sign-up'));
}

useEventBus('modal:sign-in-now').on(() => {
    isVisible.value = true;
});

onClickOutside(modalRef, () => (isVisible.value = false));
</script>

<style scoped></style>
