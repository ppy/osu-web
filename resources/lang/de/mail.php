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
        'new' => 'Wir wollten Dich nur eben wissen lassen, dass es seit Deinem letzten Besuch ein neues Update in der Beatmap ":title" eingegangen ist.',
        'subject' => 'Neues Update für Beatmap ":title"',
        'unwatch' => 'Wenn Du diese Beatmap nicht mehr verfolgen möchten, kannst Du entweder auf den Link "Unwatch" auf der obigen Seite oder auf der Seite mit der Modding-Beobachtungsliste klicken:',
        'visit' => 'Besuche die Diskussionsseite hier:',
    ],

    'common' => [
        'closing' => 'Grüße,',
        'hello' => 'Hi :user,',
        'report' => 'Bitte antworte SOFORT auf diese E-Mail, wenn Du diese Änderung nicht angefordert hast.',
    ],

    'forum_new_reply' => [
        'new' => 'Wir wollten Dich nur eben wissen lassen, dass es seit Deinem letzten Besuch eine neue Antwort in ":title" eingegangen ist.',
        'subject' => '[osu!] Neue Antwort auf Thread ":title"',
        'unwatch' => 'Wenn Du dieses Thema nicht mehr verfolgen möchtest, kannst Du entweder auf den Link "Thema abbestellen" am unteren Rand des obigen Themas oder auf der Verwaltungsseite für Themenabonnements klicken:',
        'visit' => 'Über den folgenden Link gelangst Du direkt zur neuesten Antwort:',
    ],

    'password_reset' => [
        'code' => 'Dein Bestätigungscode ist:',
        'requested' => 'Entweder Du oder jemand, der vorgibt, Du zu sein, hat ein Zurücksetzen des Passworts für Dein osu!-Konto angefordert.',
        'subject' => 'osu!-Accountwiederherstellung',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'Wir haben Deine Zahlung erhalten und bereiten Deine Bestellung für den Versand vor. Der Versand kann, abhängig von der Anzahl der Bestellungen, einige Tage dauern. Du kannst den Fortschritt Deiner Bestellung hier verfolgen, einschließlich der Verfolgungsdetails, sofern verfügbar:',
        'processing' => 'Wir haben Deine Zahlung erhalten und bearbeiten gerade Deine Bestellung. Hier kannst Du den Fortschritt Deiner Bestellung verfolgen:',
        'questions' => "Wenn Du Fragen hast, zögere nicht, auf diese E-Mail zu antworten.",
        'shipping' => 'Versand',
        'subject' => 'Wir haben deine osu!store-Bestellung erhalten!',
        'thank_you' => 'Vielen Dank für Deine osu!store-Bestellung!',
        'total' => 'Summe',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'Die Person, die Dir dieses Abzeichen geschenkt hat, kann sich entscheiden, anonym zu bleiben, sodass sie in dieser Benachrichtigung nicht erwähnt wurde.',
        'anonymous_gift_maybe_not' => 'Aber Du weißt wahrscheinlich schon, wer es ist ;).',
        'duration' => 'Dank ihnen hast Du Zugriff auf osu!direct und andere osu!supporter-Vorteile für die nächsten :duration.',
        'features' => 'Weitere Details zu diesen Funktionen findest Du hier:',
        'gifted' => 'Jemand hat Dir gerade ein osu!-Supporterabzeichen geschenkt!',
        'subject' => 'Dir wurde ein osu!supporter-Tag geschenkt!',
    ],

    'user_email_updated' => [
        'changed_to' => 'Dies ist eine Bestätigungs-E-Mail, um Dich darüber zu informieren, dass Deine osu!-E-Mail-Adresse in: ":email" geändert wurde.',
        'check' => 'Bitte stelle sicher, dass Du diese E-Mail an Deiner neuen Adresse erhalten hast, um zu verhindern, dass Du in Zukunft den Zugriff auf Dein osu!-Konto verlierst.',
        'sent' => 'Aus Sicherheitsgründen wurde diese E-Mail sowohl an Deine neue als auch an Deine alte E-Mail-Adresse gesendet.',
        'subject' => 'Bestätigung der neuen E-Mail-Adresse für osu!',
    ],

    'user_force_reactivation' => [
        'main' => 'Dein Konto steht im Verdacht, manipuliert zu sein, kürzlich verdächtige Aktivitäten ausgeführt zu haben oder ein SEHR schwaches Passwort zu haben. Aus diesem Grund musst Du ein neues Passwort festlegen. Bitte achte darauf, ein SICHERES Passwort zu wählen.',
        'perform_reset' => 'Du kannst das Zurücksetzen von :url ausführen',
        'reason' => 'Grund:',
        'subject' => 'osu!-Konto-Reaktivierung erforderlich',
    ],

    'user_password_updated' => [
        'confirmation' => 'Dies ist nur eine Bestätigung, dass Dein osu!-Passwort geändert wurde.',
        'subject' => 'Bestätigung des neuen Passworts für osu!',
    ],

    'user_verification' => [
        'code' => 'Dein Bestätigungscode lautet:',
        'code_hint' => 'Du kannst den Code ohne oder mit Leerzeichen eingeben.',
        'link' => 'Alternativ kannst Du auch den Link unten besuchen, um die Überprüfung abzuschließen:',
        'report' => 'Wenn Du diese Änderung nicht angefordert hast, antworte bitte SOFORT auf diese E-Mail, da Dein Konto möglicherweise in Gefahr ist.',
        'subject' => 'osu!-Accountverifizierung',

        'action_from' => [
            '_' => 'Für eine Aktion, die von Deinem Konto aus :country ausgeführt wird, ist eine Bestätigung erforderlich.',
            'unknown_country' => 'unbekanntes Land',
        ],
    ],
];
