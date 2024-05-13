import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { SharedProps } from '@/types';

function useApp() {
    const name = computed(() => usePage<SharedProps>().props.app.name);
    const url = computed(() => usePage<SharedProps>().props.app.url);
    const hostname = computed(() => url.value.replace('http://', '').replace('https://', ''));

    return {
        email: {
            support: `support@${hostname.value}`,
        },
        name,
        url,
    };
}

export default useApp;
