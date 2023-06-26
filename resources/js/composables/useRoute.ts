import { Ziggy } from '@/ziggy';

function useRoutes() {
    const { routes, url } = Ziggy;

    return <T extends keyof typeof routes>(name: T | string, params?: { [keys: string]: string | number }) => {
        if (!Object.keys(routes).includes(name)) {
            console.error(`Route name "${name}" was not found`);
            return `${url}`;
        }

        const uri = routes[name as keyof typeof routes].uri;

        if (params === undefined || Object.keys(params).length === 0) {
            if (uri === '/') return `${url}`;
            return `${url}/${uri}`;
        }

        let uriWithParams = uri;
        for (const [key, value] of Object.entries(params)) {
            if (!uri.includes(`{${key}}`)) {
                if (uriWithParams === '/') {
                    uriWithParams = uriWithParams.replace('/', '');
                }
                uriWithParams = uriWithParams.includes('?') ? uriWithParams : `${uriWithParams}?`;
                uriWithParams = `${uriWithParams}&${key}=${value}`;
            }
            uriWithParams = uriWithParams.replace(`{${key}}`, value.toString());
        }

        return `${url}/${uriWithParams}`;
    };
}

export default useRoutes;
