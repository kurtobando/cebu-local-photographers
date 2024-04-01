import {PageProps} from "@inertiajs/core";

export interface App {
    name: string;
    url: string;
}

export interface User {
    id: number;
    name: string;
    email: string;
    role: string;
    provider: string;
    about: string;
    avatar: string;
}

export interface FlashMessages {
    success: string;
    error: string;
    warning: string;
    info: string;
}

export interface Category {
    id: number;
    name: string;
}

export interface Post {
    id: number;
    title: string;
    description: string;
    status: string;
    tag: string;
    views: number;
    likes: number;
    comments: number;
    created_at: string;
    updated_at: string;
    category_id: number;
    user_id: number;
}

export interface SharedProps extends PageProps {
    app: App;
    auth: {
        user: User | null;
    };
    flash: FlashMessages;
}
