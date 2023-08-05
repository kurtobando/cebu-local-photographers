import {PageProps} from "@inertiajs/core";

export interface App {
    name: string;
    url: string;
}

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export interface FlashMessages {
    success: string;
    error: string;
    warning: string;
    info: string;
}

export interface SharedProps extends PageProps {
    app: App;
    auth: {
        user: User | null;
    };
    flash: FlashMessages;
}
