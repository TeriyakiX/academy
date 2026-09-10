import { type IFetcher, type IRequestConfig, RequestError, type TServerResponse } from './types';

/*
 | Единая точка выхода наружу.
 |
 | Сайт отдаётся Laravel целиком, свой домен один — поэтому здесь fetch,
 | а не отдельная библиотека: лишние килобайты на статичном сайте
 | заметны, а нужен ровно этот набор возможностей.
 |
 | Токен CSRF Laravel требует у любого POST. Берём его из мета-тега,
 | который кладёт layout, и подставляем сами — вызывающему коду
 | про это знать не нужно.
 */

const CSRF_SELECTOR = 'meta[name="csrf-token"]';

function csrfToken(): string {
    return document.querySelector<HTMLMetaElement>(CSRF_SELECTOR)?.content ?? '';
}

function withQuery(path: string, params?: IRequestConfig['params']): string {
    if (!params) return path;

    const query = new URLSearchParams();

    Object.entries(params).forEach(([key, value]) => {
        if (value === null || value === undefined || value === '') return;
        query.set(key, String(value));
    });

    const search = query.toString();

    return search ? `${path}${path.includes('?') ? '&' : '?'}${search}` : path;
}

async function unwrap<T>(response: Response): Promise<TServerResponse<T>> {
    const text = await response.text();

    let payload: unknown;
    try {
        payload = text ? JSON.parse(text) : null;
    } catch {
        // сервер ответил не JSON: страница ошибки, редирект на вход и т.п.
        payload = null;
    }

    if (!response.ok) {
        const message =
            (payload as { message?: string })?.message ?? `Запрос не выполнен (${response.status})`;

        throw new RequestError(message, response.status, payload);
    }

    return (payload ?? { success: true, message: '', data: null }) as TServerResponse<T>;
}

function request<T>(method: string, path: string, body?: BodyInit, config: IRequestConfig = {}) {
    return fetch(withQuery(path, config.params), {
        method,
        body,
        signal: config.signal,
        credentials: 'same-origin',
        headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken(),
            ...config.headers,
        },
    }).then((response) => unwrap<T>(response));
}

function json<T>(method: string, path: string, data?: unknown, config: IRequestConfig = {}) {
    return request<T>(method, path, data === undefined ? undefined : JSON.stringify(data), {
        ...config,
        headers: { 'Content-Type': 'application/json', ...config.headers },
    });
}

export const api: IFetcher = {
    get(path, config) {
        return request(  'GET', path, undefined, config);
    },

    post(path, data, config) {
        return json('POST', path, data, config);
    },

    put(path, data, config) {
        return json('PUT', path, data, config);
    },

    delete(path, data, config) {
        return json('DELETE', path, data, config);
    },

    postAsForm(path, data, config = {}) {
        const form = new FormData();

        Object.entries(data).forEach(([key, value]) => {
            if (value === null || value === undefined) return;
            form.append(key, value instanceof Blob ? value : String(value));
        });

        // Content-Type для FormData ставит браузер сам — вместе с boundary
        return request('POST', path, form, config);
    },

    async document(url, config = {}) {
        const response = await fetch(withQuery(url, config.params), {
            signal: config.signal,
            credentials: 'same-origin',
            headers: { 'X-Requested-With': 'fetch', ...config.headers },
        });

        if (!response.ok) {
            throw new RequestError(`Страница не открылась (${response.status})`, response.status);
        }

        return new DOMParser().parseFromString(await response.text(), 'text/html');
    },
};
