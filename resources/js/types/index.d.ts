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
    tags: string;
    comments: number;
    views: number;
    likes: number;
    user_id: number;
    user: ?User;
    post_category_id: number;
    category: ?string;
    media: ?PostMedia;
    created_at: string;
    updated_at: string;
}

export interface PostAuthor {
    id: number;
    name: string;
    email: string;
    role: string;
    about: ?string;
    avatar: ?string;
}

export interface PostMedia {
    thumbnail: string;
    medium: string;
    large: string;
    xlarge: string;
    original: string;
}

export interface PostComment {
    id: number;
    comment: string;
    likes: number;
    views: number;
    user_id: number;
    user: ?User;
    post_id: number;
    created_at: string;
    updated_at: string;
    comment_is_like: boolean;
}

export interface SharedProps extends PageProps {
    app: App;
    auth: {
        user: User | null;
    };
    flash: FlashMessages;
}
