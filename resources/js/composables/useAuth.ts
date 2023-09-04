import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { SharedProps } from '@/types';

function useAuth() {
    const isAuthenticated = computed(() => usePage<SharedProps>().props.auth.user !== null);
    const user = computed(() => usePage<SharedProps>().props.auth.user);

    return {
        isAuthenticated,
        user,
    };
}

export default useAuth;
