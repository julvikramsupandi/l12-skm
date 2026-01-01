export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};

export interface skm {
    id: number
    uuid: string
    unor_id: number
    created_at: string
    updated_at: string
    unor: Unor
}


export interface Unor {
    id: number
    name: string
    address: string
    telephone: string
    fax: string
    email: string | null
    parentid: string
    status: number
    logo: string | null
    created_at: string | null
    updated_at: string | null
    deleted_at: string | null
}


