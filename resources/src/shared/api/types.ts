/*
 | Контракт запросов к серверу.
 |
 | Форма ответа повторяет ту, что отдаёт Laravel: success / message / data
 | и meta для постраничных списков. Реализация лежит в client.ts —
 | компоненты работают только с этим интерфейсом и не знают,
 | чем именно ходят запросы.
 */

export type TServerResponse<T> = {
    success: boolean;
    message: string;
    data: T[] | T;
    meta?: IResponseMeta;
};

export interface IResponseMeta {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

export interface IRequestConfig {
    /** Параметры строки запроса. */
    params?: Record<string, string | number | boolean | null | undefined>;
    /** Отмена запроса — например, при новом вводе в поиске. */
    signal?: AbortSignal;
    headers?: Record<string, string>;
}

export interface IFetcher {
    get<T = unknown>(path: string, config?: IRequestConfig): Promise<TServerResponse<T>>;

    post<T = unknown>(path: string, data?: unknown, config?: IRequestConfig): Promise<TServerResponse<T>>;

    put<T = unknown>(path: string, data?: unknown, config?: IRequestConfig): Promise<TServerResponse<T>>;

    delete<T = unknown>(path: string, data?: unknown, config?: IRequestConfig): Promise<TServerResponse<T>>;

    /** Отправка формы: файлы и обычный POST формы, как её отправил бы браузер. */
    postAsForm<T = unknown>(path: string, data: Record<string, unknown>, config?: IRequestConfig): Promise<TServerResponse<T>>;

    /** Загружает страницу сайта как документ — для подмены части разметки. */
    document(url: TUrl, config?: IRequestConfig): Promise<Document>;
}

/** Ошибка запроса с кодом ответа — чтобы вызывающий код мог их различать. */
export class RequestError extends Error {
    constructor(
        message: string,
        public readonly status: number,
        public readonly payload?: unknown,
    ) {
        super(message);
        this.name = 'RequestError';
    }
}
