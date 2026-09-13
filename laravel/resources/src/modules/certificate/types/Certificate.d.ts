/*
 | Оформление подарочного сертификата.
 |
 | Программы берутся из config/courses.php — те же, что в каталоге курсов
 | и в конструкторе. Своих цен у сертификата нет: он выписывается
 | на выбранные программы.
 */

/** Шаг оформления. */
type TCertificateStep = 1 | 2 | 3;

/** Кому предназначен сертификат. */
interface ICertificateRecipient {
    /** Имя получателя — попадёт в сертификат. */
    name: string;
    /** От кого. */
    from: string;
    /** Короткое пожелание. */
    wish: string;
}

/** Заявка на сертификат: что выбрали и как с кем связаться. */
interface ICertificateOrder {
    courses: ICourse[];
    recipient: ICertificateRecipient;
    total: number;
    discount: number;
    final: number;
}
