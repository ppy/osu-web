<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'not_negative' => ':attribute kann nicht negativ sein.',
    'required' => ':attribute ist erforderlich.',
    'too_long' => ':attribute hat die maximale Länge überschritten - höchstens :limit Zeichen.',
    'wrong_confirmation' => 'Bestätigung stimmt nicht überein.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Diskussion ist gesperrt.',
        'first_post' => 'Der erste Beitrag kann nicht gelöscht werden.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Ein Zeitpunkt ist angegeben, aber die Beatmap fehlt.',
        'beatmapset_no_hype' => "Diese Beatmap kann nicht gehypt werden.",
        'hype_requires_null_beatmap' => 'Hypen muss in der "Generell"-Sektion (für alle Schwierigkeitsstufen) stattfinden.',
        'invalid_beatmap_id' => 'Ungültige Schwierigkeitsstufe gewählt.',
        'invalid_beatmapset_id' => 'Ungültige Beatmap gewählt.',
        'locked' => 'Die Diskussion ist gesperrt.',

        'hype' => [
            'guest' => 'Zum Hypen muss man eingeloggt sein.',
            'hyped' => 'Du hast diese Beatmap bereits gehypt.',
            'limit_exceeded' => 'Du hast all dein Hype verbraucht.',
            'not_hypeable' => 'Diese Beatmap kann nicht gehypt werden',
            'owner' => 'Du kannst deine eigene Beatmap nicht hypen.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Der gewählte Zeitpunkt ist nach dem Ende der Beatmap.',
            'negative' => "Der Zeitpunkt muss positiv sein.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Du kannst nur auf Featurewünsche abstimmen.',
            'not_enough_feature_votes' => 'Nicht genug Stimmen.',
        ],

        'poll_vote' => [
            'invalid' => 'Ungültige Antwort angegeben.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Den Metadaten-Post einer Beatmap kann man nicht löschen.',
            'beatmapset_post_no_edit' => 'Den Metadaten-Post einer Beatmap kann man nicht bearbeiten.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Die gleiche Antwort kann nicht doppelt enthalten sein.',
            'invalid_max_options' => 'Die Zahl an Antworten pro Benutzer kann die Anzahl an Antworten nicht überschreiten.',
            'minimum_one_selection' => 'Mindestens eine Antwort wird pro Benutzer benötigt.',
            'minimum_two_options' => 'Mindestens zwei Antworten werden benötigt.',
            'too_many_options' => 'Maximale Anzahl an Antworten überschritten',
        ],

        'topic_vote' => [
            'required' => 'Es muss eine Antwort gewählt sein.',
            'too_many' => 'Mehr Antworten als erlaubt ausgewählt.',
        ],
    ],

    'user' => [
        'contains_username' => 'Das Passwort darf den Nutzernamen nicht enthalten.',
        'email_already_used' => 'E-Mail-Adresse wird bereits verwendet.',
        'invalid_country' => 'Das Land ist nicht in der Datenbank.',
        'invalid_discord' => 'Discordname ungültig.',
        'invalid_email' => "Scheint keine gültige E-Mail-Adresse zu sein.",
        'too_short' => 'Das neue Passwort ist zu kurz.',
        'unknown_duplicate' => 'Nutzername oder E-Mail-Adresse wird bereits verwendet.',
        'username_available_in' => 'Dieser Nutzername wird in :duration verfügbar sein.',
        'username_available_soon' => 'Dieser Nutzername wird sofort verfügbar sein!',
        'username_invalid_characters' => 'Der angeforderte Nutzername enthält ungültige Zeichen.',
        'username_in_use' => 'Dieser Nutzername wird bereits verwendet!',
        'username_no_space_userscore_mix' => 'Bitte verwende nur Unterstricht ODER Leerzeichen, und nicht beides zusammen!',
        'username_no_spaces' => "Nutzernamen können nicht mit Leerzeichen beginnen oder enden.",
        'username_not_allowed' => 'Dieser Nutzername ist nicht erlaubt.',
        'username_too_short' => 'Der angeforderte Nutzername ist zu kurz.',
        'username_too_long' => 'Der angeforderte Nutzername ist zu lang.',
        'weak' => 'Das Passwort ist auf einer Blacklist.',
        'wrong_current_password' => 'Das aktuelle Passwort ist falsch.',
        'wrong_email_confirmation' => 'E-Mail-Bestätigung stimmt nicht überein.',
        'wrong_password_confirmation' => 'Passwortbestätigung stimmt nicht überein.',
        'too_long' => 'Maximale Länge überschritten - höchstens :limit Zeichen.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Du musst :link haben, um deinen Nutzernamen zu ändern!',
                'link_text' => 'osu! unterstützt',
            ],
            'username_is_same' => 'Das ist doch schon dein Name, Dummerchen!',
        ],
    ],
];
