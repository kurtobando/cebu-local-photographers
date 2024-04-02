<template>
    <Meta title="Submit Photo" />
    <Header />
    <section class="flex min-h-screen flex-col md:flex-row">
        <div class="grid w-full place-content-center bg-slate-950 md:w-2/3">
            <Image
                :src="media"
                :preview="true"
                image-class="w-full shadow-lg"
                alt="media image" />
        </div>
        <div class="flex w-full flex-col gap-4 p-8 md:w-1/3">
            <InputText
                v-model="form.title"
                placeholder="Title" />
            <InputError
                :text="form.errors.title"
                v-if="form.errors.title" />

            <Textarea
                v-model="form.description"
                placeholder="description" />
            <InputError
                :text="form.errors.description"
                v-if="form.errors.description" />

            <Chips
                class="w-full"
                v-model="form.tags"
                separator="," />
            <InputError
                :text="form.errors.tags"
                v-if="form.errors.tags" />

            <Dropdown
                :options="getCategories"
                option-label="label"
                option-value="value"
                v-model="form.category_id" />
            <InputError
                :text="form.errors.category_id"
                v-if="form.errors.category_id" />

            <Button
                label="Post"
                @click="onSubmit"
                :loading="form.processing" />
        </div>
    </section>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Chips from 'primevue/chips';
import Dropdown from 'primevue/dropdown';
import Image from 'primevue/image';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import { useToast } from 'primevue/usetoast';
import { computed, onMounted } from 'vue';
import Header from '@/components/Header/Header.vue';
import InputError from '@/components/InputError/InputError.vue';
import Meta from '@/components/Meta/Meta.vue';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoute from '@/composables/useRoute';
import { Category, Post } from '@/types';

interface Props {
    categories: Category[];
    post: Post;
    media: string;
}

type Form = {
    id: number | null;
    title: string;
    description: string;
    category_id: number | null;
    tags: string[];
};

const props = defineProps<Props>();
const route = useRoute();
const toast = useToast();
const form = useForm<Form>({
    category_id: null,
    description: '',
    id: null,
    tags: [],
    title: '',
});

const getCategories = computed(() => {
    return props.categories.map((category) => ({
        label: category.name,
        value: category.id,
    }));
});

function onSubmit() {
    toast.add({
        detail: 'Saving your post.',
        life: 6000,
        severity: 'info',
        summary: 'Please wait...',
    });
    form.patch(route('dashboard.photos.update'), {
        onError: () => {
            toast.removeAllGroups();
            toast.add({
                detail: 'Oops! Something went wrong. Please check the form for errors.',
                life: 6000,
                severity: 'error',
                summary: 'Error',
            });
        },
        onSuccess: () => {
            const { error, success } = useFlashMessage();

            toast.removeAllGroups();

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
    });
}

onMounted(() => {
    form.title = props.post.title;
    form.description = props.post.description;
    form.category_id = props.post.category_id;
    form.id = props.post.id;
});

// defineOptions({ layout: PageLayoutDashboard });
</script>

<style scoped></style>
