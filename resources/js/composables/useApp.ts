import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { SharedProps } from '@/types';

function useApp() {
    const name = computed(() => usePage<SharedProps>().props.app.name);
    const url = computed(() => usePage<SharedProps>().props.app.url);

    return {
        name,
        url,
    };
}

export default useApp;
