<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'beatmapset_update_notice' => [
        'new' => 'W obserwowanej przez Ciebie beatmapie („:title”) pojawił się nowy post.',
        'subject' => 'Nowa aktualizacja dla beatmapy „:title”',
        'unwatch' => 'Jeżeli nie chcesz już obserwować tej beatmapy, możesz kliknąć przycisk „Przestań obserwować” na stronie dyskusji lub zrobić to z poziomu strony obserwowanych dyskusji:',
        'visit' => 'Przejdź do dyskusji tutaj:',
    ],

    'common' => [
        'closing' => 'Z wyrazami szacunku,',
        'hello' => 'Witaj, :user!',
        'report' => 'Odpowiedz na ten e-mail NATYCHMIAST, jeżeli to działanie nie zostało wykonane przez Ciebie.',
    ],

    'forum_new_reply' => [
        'new' => 'W obserwowanym przez ciebie wątku („:title”) pojawiła się nowa odpowiedź.',
        'subject' => '[osu!] Nowa odpowiedź dla wątku „:title”',
        'unwatch' => 'Jeżeli nie chcesz już obserwować tego wątku, możesz kliknąć przycisk „Nie subskrybuj” w dolnej części strony wątku lub zrobić to z poziomu strony subskrybcji wątków:',
        'visit' => 'Przejdź do najnowszej odpowiedzi w wątku tutaj:',
    ],

    'password_reset' => [
        'code' => 'Twój kod weryfikacyjny to:',
        'requested' => 'Otrzymaliśmy żądanie zmiany hasła na Twoim koncie osu!.',
        'subject' => 'Odzyskiwanie konta osu!',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'Otrzymaliśmy Twoją płatność i przygotowujemy Twoje zamówienie do wysyłki. Może nam to zająć kilka dni, w zależności od liczby zamówień. Stan swojego zamówienia możesz sprawdzić tutaj (wraz ze śledzeniem przesyłki):',
        'processing' => 'Otrzymaliśmy Twoją płatność i właśnie przygotowujemy Twoje zamówienie. Obecny stan swojego zamówienia możesz sprawdzić tutaj:',
        'questions' => "Jeśli masz pytania, odpowiedz na ten e-mail.",
        'shipping' => 'Wysyłka',
        'subject' => 'Otrzymaliśmy Twoje zamówienie ze sklepu osu!',
        'thank_you' => 'Dziękujemy za Twoje zamówienie w sklepie osu!',
        'total' => 'Suma',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'Osoba, która podarowała Ci status donatora, zdecydowała się pozostać anonimowa, dlatego nie została wspomniana w tej wiadomości.',
        'anonymous_gift_maybe_not' => 'Chociaż najpewniej wiesz, kto to był. ;)',
        'duration' => 'Dzięki tej osobie otrzymasz dostęp do osu!direct i innych korzyści przeznaczonych dla donatorów osu! przez następne :duration.',
        'features' => 'Więcej informacji na temat korzyści wynikających z posiadania statusu donatora osu! znajdziesz tutaj:',
        'gifted' => 'Ktoś podarował Ci status donatora osu!',
        'subject' => 'Otrzymujesz status donatora osu!',
    ],

    'user_email_updated' => [
        'changed_to' => 'Ten e-mail jest tylko potwierdzeniem, że Twój adres e-mail w osu! został zmieniony na „:e-mail”.',
        'check' => 'Upewnij się, że tę wiadomość wysłano również na Twój nowy adres e-mail, aby uniknąć utraty konta osu!.',
        'sent' => 'Ze względów bezpieczeństwa ta wiadomość została wysłana zarówno na stary, jak i nowy adres e-mail.',
        'subject' => 'Potwierdzenie zmiany adresu e-mail w osu!',
    ],

    'user_force_reactivation' => [
        'main' => 'Bezpieczeństwo Twojego konta zostało uznane za naruszone. Wykryto podejrzaną aktywność lub BARDZO słabe hasło. W związku z tym wymagamy ustawienia nowego hasła. Upewnij się, by było ono BEZPIECZNE.',
        'perform_reset' => 'Możesz wykonać reset tutaj: :url',
        'reason' => 'Powód:',
        'subject' => 'Wymagana ponowna aktywacja konta osu!',
    ],

    'user_password_updated' => [
        'confirmation' => 'Ten e-mail jest tylko potwierdzeniem, że Twoje hasło w osu! zostało zmienione.',
        'subject' => 'Potwierdzenie zmiany hasła w osu!',
    ],

    'user_verification' => [
        'code' => 'Twój kod weryfikacyjny to:',
        'code_hint' => 'Możesz wprowadzić kod ze spacjami lub bez.',
        'link' => 'Ewentualnie możesz kliknąć odnośnik poniżej, aby dokończyć proces weryfikacji:',
        'report' => 'Jeżeli to nie Ty, odpowiedz na tę wiadomość NATYCHMIAST, gdyż Twoje konto może być zagrożone.',
        'subject' => 'Weryfikacja konta osu!',

        'action_from' => [
            '_' => 'Działanie podjęte na twoim koncie z :country wymaga weryfikacji.',
            'unknown_country' => 'nieznanego kraju',
        ],
    ],
];
