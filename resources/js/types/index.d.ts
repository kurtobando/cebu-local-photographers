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
    message_limit: number;
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

export interface Message {
    created_at: string;
    id: number;
    subject: string;
    updated_at: string;
    uuid: string;
}

export interface MessageThread {
    created_at: string;
    id: number;
    is_read: number;
    message: string;
    receiver: {
        email: string;
        id: number;
        name: string;
    };
    sender: {
        email: string;
        id: number;
        name: string;
    };
    updated_at: string;
    uuid: string;
}

export interface SharedProps extends PageProps {
    app: App;
    auth: {
        user: User | null;
    };
    flash: FlashMessages;
}
