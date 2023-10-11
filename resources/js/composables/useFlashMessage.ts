import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { SharedProps } from '@/types';

function useFlashMessage() {
    const success = computed(() => usePage<SharedProps>().props.flash.success).value;
    const error = computed(() => usePage<SharedProps>().props.flash.error).value;
    const warning = computed(() => usePage<SharedProps>().props.flash.warning).value;
    const info = computed(() => usePage<SharedProps>().props.flash.info).value;

    return {
        error,
        info,
        success,
        warning,
    };
}

export default useFlashMessage;
