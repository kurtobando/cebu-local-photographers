import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { SharedProps } from '@/types';

function useFlashMessage() {
    const success = computed(() => usePage<SharedProps>().props.flash.success);
    const error = computed(() => usePage<SharedProps>().props.flash.error);
    const warning = computed(() => usePage<SharedProps>().props.flash.warning);
    const info = computed(() => usePage<SharedProps>().props.flash.info);

    return {
        error,
        info,
        success,
        warning,
    };
}

export default useFlashMessage;
