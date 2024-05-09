import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { SharedProps } from '@/types';

function useAuth() {
    const isAuthenticated = computed(() => usePage<SharedProps>().props.auth.user !== null).value;
    const user = computed(() => usePage<SharedProps>().props.auth.user).value;
    const notification = computed(() => usePage<SharedProps>().props.auth.notification).value;

    return {
        isAuthenticated,
        notification,
        user,
    };
}

export default useAuth;
