<template>
    <Meta title="Edit A Post" />
    <section class="flex max-h-screen min-h-[90vh] flex-col md:flex-row">
        <div class="grid w-full place-content-center bg-[#171717] lg:w-7/12">
            <Image
                :src="post.media?.xlarge"
                :preview="true"
                image-class="w-full  max-h-screen"
                alt="media image" />
        </div>
        <div class="flex w-full flex-col gap-4 p-8 lg:w-5/12">
            <div>
                <h1 class="text-2xl font-bold">Edit a Post</h1>
                <p class="leading-relaxed text-slate-400">Tell us more about this photo</p>
            </div>
            <div class="flex flex-col gap-1">
                <InputText
                    v-model="form.title"
                    placeholder="Title" />
                <InputError
                    :text="form.errors.title"
                    v-if="form.errors.title" />
            </div>
            <div class="flex flex-col gap-1">
                <Textarea
                    v-model="form.description"
                    placeholder="Write a caption"
                    :rows="8" />
                <InputError
                    :text="form.errors.description"
                    v-if="form.errors.description" />
            </div>
            <div class="flex flex-col gap-1">
                <Chips
                    class="w-full"
                    v-model="form.tags"
                    separator=","
                    placeholder="Type tags, separate by comma (,)" />
                <InputError
                    :text="form.errors.tags"
                    v-if="form.errors.tags" />
            </div>
            <div class="flex flex-col gap-1">
                <Dropdown
                    :options="getCategories"
                    option-label="label"
                    option-value="value"
                    placeholder="Choose a category"
                    v-model="form.post_category_id" />
                <InputError
                    :text="form.errors.post_category_id"
                    v-if="form.errors.post_category_id" />
            </div>

            <!-- TODO! add location input field with geo map -->

            <Button
                label="Save Changes"
                @click="onSubmit"
                :loading="form.processing" />
        </div>
    </section>
    <Toast />
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
import InputError from '@/components/InputError/InputError.vue';
import Meta from '@/components/Meta/Meta.vue';
import useFlashMessage from '@/composables/useFlashMessage';
import useRoute from '@/composables/useRoute';
import { Category, Post } from '@/types';

interface Props {
    categories: Category[];
    post: Post;
}
interface Form {
    id: number | null;
    title: string;
    description: string;
    post_category_id: number | null;
    tags: string[];
}

const props = defineProps<Props>();
const route = useRoute();
const toast = useToast();
const form = useForm<Form>({
    description: '',
    id: null,
    post_category_id: null,
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
    form.post_category_id = props.post.post_category_id;
    form.id = props.post.id;

    try {
        form.tags = JSON.parse(props.post.tags);
    } catch (e) {
        form.tags = [];
    }
});
</script>

<style scoped></style>
