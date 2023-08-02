import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { SharedProps } from '@/types';

function useAuth() {
    const isAuthenticated = computed(() => usePage<SharedProps>().props.auth.user !== null);

    return {
        isAuthenticated,
    };
}

export default useAuth;
