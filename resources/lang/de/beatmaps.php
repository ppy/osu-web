<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Aktualisieren der Stimme fehlgeschlagen',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'Kudosu erlauben',
        'beatmap_information' => 'Beatmap-Seite',
        'delete' => 'löschen',
        'deleted' => 'Von :editor gelöscht (:delete_time).',
        'deny_kudosu' => 'Kudosu ablehnen',
        'edit' => 'bearbeiten',
        'edited' => 'Zuletzt bearbeitet von :editor (:update_time).',
        'guest' => 'Guest-Difficulty von :user',
        'kudosu_denied' => 'Kudosu-Annahme abgelehnt.',
        'message_placeholder_deleted_beatmap' => 'Diese Difficulty wurde gelöscht und kann nicht mehr diskutiert werden.',
        'message_placeholder_locked' => 'Die Diskussion für diese Beatmap wurde deaktiviert.',
        'message_placeholder_silenced' => "Posten in der Diskussion nicht möglich, während du stummgeschaltet bist.",
        'message_type_select' => 'Bemerkungs-Art auswählen',
        'reply_notice' => 'Zum Antworten Enter drücken.',
        'reply_placeholder' => 'Antwort hier eingeben',
        'require-login' => 'Zum Posten oder Antworten bitte einloggen',
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
            'hidden' => 'Keine Diskussion passt zum ausgewählten Filter.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Diskussion sperren',
                'unlock' => 'Diskussion freigeben',
            ],

            'prompt' => [
                'lock' => 'Grund für die Sperrung',
                'unlock' => 'Willst du das wirklich entsperren?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Dieser Post wird zu den generellen Beatmap-Diskussionen hinzugefügt. Beginne die Nachricht mit einem Zeitstempel (z.B. 00:12:345), um diese Beatmap zu modden.',
            'in_timeline' => 'Du musst mehrere Posts erstellen, um an mehreren Zeitstempeln zu modden (ein Post pro Zeitstempel).',
        ],

        'message_placeholder' => [
            'general' => 'Hier schreiben, um in General zu posten (:version)',
            'generalAll' => 'Hier schreiben, um in General zu posten (Alle Difficulties)',
            'review' => 'Hier schreiben, um eine Kurzfassung zu posten',
            'timeline' => 'Hier schreiben, um in der Timeline zu posten (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Disqualifizieren',
            'hype' => 'Hype!',
            'mapper_note' => 'Anmerkung',
            'nomination_reset' => 'Nominierung zurücksetzen',
            'praise' => 'Lob',
            'problem' => 'Problem',
            'problem_warning' => 'Problem melden',
            'review' => 'Kurzfassung',
            'suggestion' => 'Vorschlag',
        ],

        'mode' => [
            'events' => 'Verlauf',
            'general' => 'Allgemein :scope',
            'reviews' => 'Überblick',
            'timeline' => 'Timeline',
            'scopes' => [
                'general' => 'Diese Difficulty',
                'generalAll' => 'Alle Difficulties',
            ],
        ],

        'new' => [
            'pin' => 'Anheften',
            'timestamp' => 'Zeitstempel',
            'timestamp_missing' => 'Drücke Strg+C im Editor und füge es in deine Nachricht ein, um einen Zeitstempel hinzuzufügen!',
            'title' => 'Neue Diskussion',
            'unpin' => 'Aufheben',
        ],

        'review' => [
            'new' => 'Neue Kurzfassung',
            'embed' => [
                'delete' => 'Löschen',
                'missing' => '[DISKUSSION GELÖSCHT]',
                'unlink' => 'Verknüpfung aufheben',
                'unsaved' => 'Nicht gespeichert',
                'timestamp' => [
                    'all-diff' => 'Beiträge zu "Alle Schwierigkeitsstufen" können nicht mit einem Zeitstempel versehen werden.',
                    'diff' => 'Falls dieser Beitrag mit einem Zeitstempel beginnt, wird er unter Timeline angezeigt.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'absatz einfügen',
                'praise' => 'lob einfügen',
                'problem' => 'Problem einfügen',
                'suggestion' => 'Vorschlag einfügen',
            ],
        ],

        'show' => [
            'title' => ':title erstellt von :mapper',
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
            'wip' => 'Anmerkung: Diese Beatmap wurde vom Ersteller als Work-In-Progress gekennzeichnet.',
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
        'button_done' => 'Schon gehyped!',
        'confirm' => "Sicher? Dies wird eins deiner letzten :n Hypes verwenden und kann nicht rückgängig gemacht werden.",
        'explanation' => 'Hype diese Beatmap, um sie für Nominierungen und Ranking sichtbarer zu machen!',
        'explanation_guest' => 'Logge dich ein und hype diese Beatmap, um sie für Nominierungen und Ranking sichtbarer zu machen!',
        'new_time' => "Um :new_time wirst du deinen nächsten Hype erhalten.",
        'remaining' => 'Du hast noch :remaining Hypes übrig.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype-Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Feedback abgeben',
    ],

    'nominations' => [
        'delete' => 'Löschen',
        'delete_own_confirm' => 'Bist du sicher? Die Beatmap wird gelöscht und du wirst auf dein Profil weitergeleitet.',
        'delete_other_confirm' => 'Bist du sicher? Die Beatmap wird gelöscht und du wirst auf das Profil weitergeleitet.',
        'disqualification_prompt' => 'Grund für die Disqualifizierung?',
        'disqualified_at' => 'Disqualifiziert :time_ago (:reason).',
        'disqualified_no_reason' => 'keinen Grund angegeben',
        'disqualify' => 'Disqualifizieren',
        'incorrect_state' => 'Ein Fehler ist aufgetreten, versuche die Seite zu aktualisieren.',
        'love' => 'Love',
        'love_choose' => 'Difficulty für Loved wählen',
        'love_confirm' => 'Liebst du diese Beatmap?',
        'nominate' => 'Nominieren',
        'nominate_confirm' => 'Diese Beatmap nominieren?',
        'nominated_by' => 'Nominiert von :users',
        'not_enough_hype' => "Nicht ausreichend Hype vorhanden.",
        'remove_from_loved' => 'Aus Loved entfernen',
        'remove_from_loved_prompt' => 'Grund fürs Entfernen aus Loved:',
        'required_text' => 'Nominierungen: :current/:required',
        'reset_message_deleted' => 'gelöscht',
        'title' => 'Nominierungsstatus',
        'unresolved_issues' => 'Es existieren noch Vorschläge/Probleme, die gelöst werden müssen.',

        'rank_estimate' => [
            '_' => 'Diese Map wird voraussichtlich am :date ranked. Sie befindet sich aktuell an Position :position der :queue.',
            'on' => 'am :date',
            'queue' => 'Warteschlange',
            'soon' => 'bald',
        ],

        'reset_at' => [
            'nomination_reset' => 'Nominierungsprozess zurückgesetzt vor :time_ago von :user mit dem Problem :discussion (:message).',
            'disqualify' => 'Vor :time_ago disqualifiziert von :user mit einem neuen Problem :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Bist du sicher? Das wird die Beatmap von der Qualifizierung entfernen und den Nominierungsprozess zurücksetzen.',
            'nomination_reset' => 'Bist du dir sicher? Der Nominierungsprozess wird durch das neue Problem zurückgesetzt.',
            'problem_warning' => 'Bist du sicher, dass du ein Problem in dieser Beatmap melden möchtest? Dies wird die Beatmap Nominators alarmieren.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'Stichwörter eingeben...',
            'login_required' => 'Melde dich an, um zu suchen.',
            'options' => 'Mehr Suchoptionen',
            'supporter_filter' => 'Um nach :filters zu filtern, benötigt es ein aktives osu!supporter-Tag',
            'not-found' => 'keine Ergebnisse',
            'not-found-quote' => '... nope, nichts gefunden.',
            'filters' => [
                'extra' => 'Extra',
                'general' => 'Allgemein',
                'genre' => 'Genre',
                'language' => 'Sprache',
                'mode' => 'Modus',
                'nsfw' => 'Explizite Beatmaps',
                'played' => 'Gespielt',
                'rank' => 'Erreichter Rang',
                'status' => 'Kategorien',
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
                '_' => 'Du benötigst ein aktives :link, um nach :filters zu filtern',
                'link_text' => 'osu!supporter-Tag',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Konvertierte Beatmaps miteinbeziehen',
        'featured_artists' => 'Featured Artists',
        'follows' => 'Abonnierte Mapper',
        'recommended' => 'Empfohlene Schwierigkeit',
        'spotlights' => 'Beatmaps im Spotlight',
    ],
    'mode' => [
        'all' => 'Alle',
        'any' => 'Alle',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Alle',
        'approved' => 'Approved',
        'favourites' => 'Favoriten',
        'graveyard' => 'Graveyard',
        'leaderboard' => 'Hat Ranglisten',
        'loved' => 'Loved',
        'mine' => 'Meine Maps',
        'pending' => 'Ausstehend',
        'wip' => 'WIP',
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
        'metal' => 'Metal',
        'classical' => 'Klassik',
        'folk' => 'Folk',
        'jazz' => 'Jazz',
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
        'russian' => 'Russisch',
        'polish' => 'Polnisch',
        'instrumental' => 'Instrumental',
        'other' => 'Andere',
        'unspecified' => 'Nicht angegeben',
    ],

    'nsfw' => [
        'exclude' => 'Ausblenden',
        'include' => 'Anzeigen',
    ],

    'played' => [
        'any' => 'Alle',
        'played' => 'Gespielt',
        'unplayed' => 'Ungespielt',
    ],
    'extra' => [
        'video' => 'Hat ein Video',
        'storyboard' => 'Hat ein Storyboard',
    ],
    'rank' => [
        'any' => 'Alle',
        'XH' => 'Silber-SS',
        'X' => '',
        'SH' => 'Silber-S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Anzahl der Plays: :count',
        'favourites' => 'Favoriten: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Alle',
        ],
    ],
];
