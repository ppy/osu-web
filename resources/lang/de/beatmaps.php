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
    'discussion-posts' => [
        'store' => [
            'error' => 'Speichern des Beitrages fehlgeschlagen',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Aktualisieren der Stimme fehlgeschlagen',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'kudosu erlauben',
        'beatmap_information' => 'Beatmap-Seite',
        'delete' => 'löschen',
        'deleted' => 'Von :editor gelöscht (:delete_time).',
        'deny_kudosu' => 'kudosu verweigern',
        'edit' => 'bearbeiten',
        'edited' => 'Zuletzt bearbeitet von :editor (:update_time).',
        'kudosu_denied' => 'Dir wurde kudosu verweigert.',
        'message_placeholder_deleted_beatmap' => 'Diese Schwierigkeitsstufe wurde gelöscht und kann nicht mehr diskutiert werden.',
        'message_placeholder_locked' => 'Die Diskussion für diese Beatmap wurde deaktiviert.',
        'message_type_select' => 'Kommentartyp auswählen',
        'reply_notice' => 'Zum Antworten Enter drücken.',
        'reply_placeholder' => 'Antwort hier eingeben',
        'require-login' => 'Zum Beitragen oder Antworten bitte einloggen',
        'resolved' => 'Gelöst',
        'restore' => 'wiederherstellen',
        'show_deleted' => 'Gelöschte anzeigen',
        'title' => 'Diskussionen',

        'collapse' => [
            'all-collapse' => 'Alle verkleinern',
            'all-expand' => 'Alle erweitern',
        ],

        'empty' => [
            'empty' => 'Es gibt noch keine Diskussionen!',
            'hidden' => 'Keine Diskussion entspricht dem ausgewählten Filter.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Diskussion sperren',
                'unlock' => 'Diskussion freigeben',
            ],

            'prompt' => [
                'lock' => 'Grund für die Sperrung',
                'unlock' => 'Willst du wirklich freigeben?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Dieser Beitrag wird den generellen Beatmapdiskussionen hinzugefügt. Um diese Beatmap zu modden, beginne die Nachricht mit einer Timestamp (z.B. 00:12:345).',
            'in_timeline' => 'Um an mehreren Zeitpunkten zu modden, musst du mehrere Beiträge erstellen (ein Beitrag pro Timestamp).',
        ],

        'message_placeholder' => [
            'general' => 'Hier tippen um auf General zu posten (:version)',
            'generalAll' => 'Hier tippen um auf General zu posten (Alle Schwierigkeitsstufen)',
            'timeline' => 'Hier tippen um auf die Timeline zu posten (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Disqualifizieren',
            'hype' => 'Hype!',
            'mapper_note' => 'Anmerkung',
            'nomination_reset' => 'Nominierung zurücksetzen',
            'praise' => 'Loben',
            'problem' => 'Problem',
            'review' => 'Bewertung',
            'suggestion' => 'Vorschlag',
        ],

        'mode' => [
            'events' => 'Geschichte',
            'general' => 'Allgemein',
            'reviews' => 'Rezensionen',
            'timeline' => 'Timeline',
            'scopes' => [
                'general' => 'Diese Schwierigkeitsstufe',
                'generalAll' => 'Alle Schwierigkeitsstufen',
            ],
        ],

        'new' => [
            'pin' => 'Anheften',
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'Strg-C im Editor und in deine Nachricht einfügen, um eine Timestamp hinzuzufügen!',
            'title' => 'Neue Diskussion',
            'unpin' => 'Lösen',
        ],

        'show' => [
            'title' => ':title, erstellt von :mapper',
        ],

        'sort' => [
            'created_at' => 'Erstellungszeitpunkt',
            'timeline' => 'Timeline',
            'updated_at' => 'Letzte Aktualisierung',
        ],

        'stats' => [
            'deleted' => 'Gelöscht',
            'mapper_notes' => 'Anmerkungen',
            'mine' => 'Meine',
            'pending' => 'Ausstehend',
            'praises' => 'Lob',
            'resolved' => 'Gelöst',
            'total' => 'Alle',
        ],

        'status-messages' => [
            'approved' => 'Diese Beatmap wurde am :date approved!',
            'graveyard' => "Diese Beatmap wurde seit dem :date nicht mehr aktualisiert und wurde wahrscheinlich vom Ersteller aufgegeben...",
            'loved' => 'Diese Beatmap wurde am :date loved!',
            'ranked' => 'Diese Beatmap wurde am :date ranked!',
            'wip' => 'Anmerkung: Diese Beatmap ist vom Ersteller als \'Work-In-Progress\' gekennzeichnet',
        ],

        'votes' => [
            'none' => [
                'down' => 'Noch keine Downvotes',
                'up' => 'Noch keine Upvotes',
            ],
            'latest' => [
                'down' => 'Letzte Upvotes',
                'up' => 'Letzte Upvotes',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Beatmap hypen!',
        'button_done' => 'Schon gehypt!',
        'confirm' => "Sicher? Dies wird eins deiner letzten :n Hypes verwenden und kann nicht rückgängig gemacht werden.",
        'explanation' => 'Hype diese Beatmap, um sie für Nominierungen und Ranking sichtbarer zu machen!',
        'explanation_guest' => 'Einloggen und diese Beatmap hypen, um sie für Nominierungen und ranked sichtbarer zu machen!',
        'new_time' => "Um :new_time wirst du deinen nächsten Hype erhalten.",
        'remaining' => 'Du hast noch :remaining Hypes übrig.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Feedback abgeben',
    ],

    'nominations' => [
        'delete' => 'Löschen',
        'delete_own_confirm' => 'Bist du sicher? Die Beatmap wird gelöscht und du wirst auf dein Profil zurückgeleitet.',
        'delete_other_confirm' => 'Bist du sicher? Die Beatmap wird gelöscht und du wirst auf das Profil zurückgeleitet.',
        'disqualification_prompt' => 'Grund für die Disqualifizierung?',
        'disqualified_at' => 'Disqualifiziert :time_ago (:reason).',
        'disqualified_no_reason' => 'kein grund angegeben',
        'disqualify' => 'Disqualifizieren',
        'incorrect_state' => 'Ein Fehler ist aufgetreten, versuche die Seite zu aktualisieren.',
        'love' => 'Liebe',
        'love_confirm' => 'Liebst du diese Beatmap?',
        'nominate' => 'Nominieren',
        'nominate_confirm' => 'Diese Beatmap nominieren?',
        'nominated_by' => 'Nominiert von :users',
        'not_enough_hype' => "Nicht ausreichend Hype vorhanden.",
        'qualified' => 'Die Beatmap wird voraussichtlich am :date ranked, wenn keine Probleme gefunden werden.',
        'qualified_soon' => 'Die Beatmap wird bald ranked, wenn keine Probleme gefunden werden.',
        'required_text' => 'Nominierungen: :current/:required',
        'reset_message_deleted' => 'gelöscht',
        'title' => 'Nominierungsstatus',
        'unresolved_issues' => 'Es existieren noch Vorschläge/Probleme, die gelöst werden müssen.',

        'reset_at' => [
            'nomination_reset' => 'Nominierungsprozess zurückgesetzt vor :time_ago von :user mit dem Problem :discussion (:message).',
            'disqualify' => 'Disqualifiziert :time_ago von :user mit der Erstellung des Problems :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Bist du dir sicher? Der Nominierungsprozess wird durch das neue Problem zurückgesetzt.',
            'disqualify' => 'Bist du sicher? Das wird die Beatmap von der Qualifiezierung entfernen und den Nominierungsprozess zurücksetzen.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'stichwörter eingeben...',
            'login_required' => 'Melde dich an, um zu suchen.',
            'options' => 'Mehr Suchoptionen',
            'supporter_filter' => 'Filtern nach :filters benötigt ein aktives osu!supporter Tag',
            'not-found' => 'keine ergebnisse',
            'not-found-quote' => '... nope, nichts gefunden.',
            'filters' => [
                'general' => 'Generell',
                'mode' => 'Modus',
                'status' => 'Kategorien',
                'genre' => 'Genre',
                'language' => 'Sprache',
                'extra' => 'extra',
                'rank' => 'Erreichter Rang',
                'played' => 'Gespielt',
            ],
            'sorting' => [
                'title' => 'Titel',
                'artist' => 'Künstler',
                'difficulty' => 'Schwierigkeit',
                'favourites' => 'Favoriten',
                'updated' => 'Zuletzt aktualisiert',
                'ranked' => 'Ranked',
                'rating' => 'Bewertung',
                'plays' => 'Plays',
                'relevance' => 'Relevanz',
                'nominations' => 'Nominierungen',
            ],
            'supporter_filter_quote' => [
                '_' => 'Du benötigst einen aktiven :link, um nach :filters zu filtern',
                'link_text' => 'osu!supporter Tag',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Empfohlene Schwierigkeit',
        'converts' => 'Konvertierte Beatmaps miteinbeziehen',
    ],
    'mode' => [
        'any' => 'Alle',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Alle',
        'approved' => 'Approved',
        'favourites' => 'Favoriten',
        'graveyard' => 'Graveyard',
        'leaderboard' => 'Hat Ranglisten',
        'loved' => 'Loved',
        'mine' => 'Meine Maps',
        'pending' => 'Ausstehend & WIP',
        'qualified' => 'Qualifiziert',
        'ranked' => 'Ranked',
    ],
    'genre' => [
        'any' => 'Alle',
        'unspecified' => 'Nicht angegeben',
        'video-game' => 'Videospiel',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Andere',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip-Hop',
        'electronic' => 'Electronic',
    ],
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'MR' => 'Spiegel',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Touch-Gerät',
    ],
    'language' => [
        'any' => 'Alle',
        'english' => 'Englisch',
        'chinese' => 'Chinesisch',
        'french' => 'Französisch',
        'german' => 'Deutsch',
        'italian' => 'Italienisch',
        'japanese' => 'Japanisch',
        'korean' => 'Koreanisch',
        'spanish' => 'Spanisch',
        'swedish' => 'Schwedisch',
        'instrumental' => 'Instrumental',
        'other' => 'Andere',
    ],
    'played' => [
        'any' => 'Alle',
        'played' => 'Gespielt',
        'unplayed' => 'Ungespielt',
    ],
    'extra' => [
        'video' => 'Hat Video',
        'storyboard' => 'Hat Storyboard',
    ],
    'rank' => [
        'any' => 'Alle',
        'XH' => 'Silber-SS',
        'X' => 'SS',
        'SH' => 'Silber-S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
    'panel' => [
        'playcount' => 'Anzahl der Spiele: :count',
        'favourites' => 'Favoriten: :count',
    ],
];
