<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[gelöschter Benutzer]',

    'beatmapset_activities' => [
        'title' => ":users Moddingverlauf",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Letztens gestartete Diskussionen',
        ],

        'events' => [
            'title_recent' => 'Neueste Events',
        ],

        'posts' => [
            'title_recent' => 'Neueste Beiträge',
        ],

        'votes_received' => [
            'title_most' => 'Meiste Stimmen von (letzten 3 Monate)',
        ],

        'votes_made' => [
            'title_most' => 'Meiste Stimmen (letzten 3 Monate)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Du hast diesen Benutzer geblockt.',
        'blocked_count' => 'geblockte benutzer (:count)',
        'hide_profile' => 'Profil verbergen',
        'not_blocked' => 'Dieser Benutzer ist nicht geblockt.',
        'show_profile' => 'Profil anzeigen',
        'too_many' => 'Block-Limit erreicht.',
        'button' => [
            'block' => 'Blocken',
            'unblock' => 'Entblocken',
        ],
    ],

    'card' => [
        'loading' => 'Lädt...',
        'send_message' => 'Nachricht senden',
    ],

    'disabled' => [
        'title' => 'Uh, oh! Anscheinend wurde dein Konto deaktiviert.',
        'warning' => "Falls Du gegen eine Regel verstoßen hast, beachte bitte, dass es in der Regel eine Frist von einem Monat gibt, in der wir keine Anträge berücksichtigen. Nach diesem Zeitraum kannst Du uns jederzeit kontaktieren, falls Du dies für erforderlich hältst. Beachte, dass das Erstellen neuer Konten nach dem Deaktivieren eines Kontos zu einer <strong>Verlängerung dieser einmonatigen Frist</strong> führt. Bitte beachte auch, dass du für <strong>jedes Konto, das du erstellst, weitere Regeln verletzt</strong>. Wir empfehlen Dir dringend, diesen Weg nicht zu gehen!",

        'if_mistake' => [
            '_' => 'Wenn Du der Meinung bist, dass dies ein Fehler ist, kannst Du uns gerne kontaktieren (per :email oder durch Klicken auf das "?" in der rechten unteren Ecke dieser Seite). Bitte beachte, dass wir bei unseren Handlungen immer volles Vertrauen haben, da sie auf sehr soliden Daten beruhen. Wir behalten uns das Recht vor, Deine Anfrage zu ignorieren, wenn wir das Gefühl haben, dass Du absichtlich unehrlich bist.',
            'email' => 'E-Mail',
        ],

        'reasons' => [
            'compromised' => 'Dein Konto wurde als gefährdet eingestuft. Es kann vorübergehend deaktiviert werden, während seine Identität bestätigt wird.',
            'opening' => 'Es gibt eine Reihe von Gründen, die dazu führen können, dass Dein Konto deaktiviert wird:',

            'tos' => [
                '_' => 'Du hast eine oder mehr von unseren :community_rules oder :tos gebrochen.',
                'community_rules' => 'Communityregeln',
                'tos' => 'Nutzungsbedinungen',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Mitglieder nach Spielmodus',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Dein Konto wurde längere Zeit nicht benutzt.",
        ],
    ],

    'login' => [
        '_' => 'Login',
        'button' => 'Einloggen',
        'button_posting' => 'Einloggen...',
        'email_login_disabled' => 'Das Anmelden per E-Mail ist derzeit deaktiviert. Bitte benutze stattdessen Deinen Benutzernamen.',
        'failed' => 'Falscher Login',
        'forgot' => 'Passwort vergessen?',
        'info' => 'Bitte melde dich an, um fortzufahren',
        'invalid_captcha' => 'Captcha ungültig, bitte aktualisiere die Seite und versuche es erneut.',
        'locked_ip' => 'Deine IP-Adresse ist gesperrt. Bitte warte ein paar Minuten.',
        'password' => 'Passwort',
        'register' => "Noch keinen osu!-Account? Erstell' einen",
        'remember' => 'Diesen Computer merken',
        'title' => 'Zum Fortfahren bitte einloggen',
        'username' => 'Benutzername',

        'beta' => [
            'main' => 'Beta-Zugang ist momentan privilegierten Benutzern vorbehalten.',
            'small' => '(osu!supporter kommen bald dazu)',
        ],
    ],

    'posts' => [
        'title' => 'Posts von :username',
    ],

    'anonymous' => [
        'login_link' => 'zum Einloggen klicken',
        'login_text' => 'einloggen',
        'username' => 'Gast',
        'error' => 'Dafür musst du eingeloggt sein.',
    ],
    'logout_confirm' => 'Sicher, dass du dich ausloggen willst? :(',
    'report' => [
        'button_text' => 'melden',
        'comments' => 'Weitere Kommentare',
        'placeholder' => 'Bitte stelle jegliche Infomationen zur Verfügung, die nützlich sein könnten.',
        'reason' => 'Grund',
        'thanks' => 'Danke für deine Meldung!',
        'title' => 'Meldung :username?',

        'actions' => [
            'send' => 'Meldung abschicken',
            'cancel' => 'Abbrechen',
        ],

        'options' => [
            'cheating' => 'Cheating',
            'insults' => 'Beleidigt mich / andere',
            'spam' => 'Spamming',
            'unwanted_content' => 'Verlinkt unangemessene Inhalte',
            'nonsense' => 'Unsinn',
            'other' => 'Anderes (unten angeben)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Dein Account wurde restricted!',
        'message' => 'Während du restricted bist, kannst du nicht mit anderen Spielern interagieren und deine Ranglistenscores sind nur für dich sichtbar. Dies passiert normalerweise durch einen automatischen Prozess und wird üblicherweise innerhalb von 24 Stunden aufgehoben. Wenn du Einspruch gegen deine Restriction erheben möchtest, wende dich bitte an <a href="mailto:accounts@ppy.sh">den Support</a>.',
    ],
    'show' => [
        'age' => ':age Jahre alt',
        'change_avatar' => 'ändere deinen avatar!',
        'first_members' => 'Seit dem Anfang hier',
        'is_developer' => 'osu!-Entwickler',
        'is_supporter' => 'osu!-Supporter',
        'joined_at' => ':date beigetreten',
        'lastvisit' => 'Zuletzt gesehen :date',
        'lastvisit_online' => 'Derzeit online',
        'missingtext' => 'Vielleicht hast du dich verschrieben (oder der Benutzer wurde gebannt)!',
        'origin_country' => 'Aus :country',
        'previous_usernames' => 'auch bekannt als',
        'plays_with' => 'Spielt mit :devices',
        'title' => "Profil von :username",

        'comments_count' => [
            '_' => ':link abgegeben',
            'count' => ':count_delimited Kommentar|:count_delimited Kommentare',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Profilbanner ändern',
                'defaults_info' => 'In der Zukunft wird es mehr Optionen für das Banner geben',
                'upload' => [
                    'broken_file' => 'Verarbeitung des Bildes fehlgeschlagen. Überprüfe das hochgeladene Bild und versuch es erneut.',
                    'button' => 'Bild hochladen',
                    'dropzone' => 'Zum Hochladen hier ablegen',
                    'dropzone_info' => 'Du kannst das Bild auch hier ablegen, um es hochzuladen',
                    'size_info' => 'Banner sollte 2400x620 groß sein',
                    'too_large' => 'Datei ist zu groß.',
                    'unsupported_format' => 'Format wird nicht unterstützt.',

                    'restriction_info' => [
                        '_' => 'Hochladen nur für :link verfügbar',
                        'link' => 'osu!supporter',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'standard-spielmodus',
                'set' => 'wähle :mode als standard-spielmodus',
            ],
        ],

        'extra' => [
            'none' => 'nichts',
            'unranked' => 'Keine Plays in letzter Zeit',

            'achievements' => [
                'achieved-on' => 'Erreicht am :date',
                'locked' => 'Noch nicht freigeschaltet',
                'title' => 'Erfolge',
            ],
            'beatmaps' => [
                'by_artist' => 'von :artist',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Lieblingsbeatmaps',
                ],
                'graveyard' => [
                    'title' => 'Begrabene Beatmaps',
                ],
                'loved' => [
                    'title' => 'Loved Beatmaps',
                ],
                'pending' => [
                    'title' => 'Ausstehende Beatmaps',
                ],
                'ranked' => [
                    'title' => 'Ranked & Approved Beatmaps',
                ],
            ],
            'discussions' => [
                'title' => 'Diskussionen',
                'title_longer' => 'Neueste Diskussionen',
                'show_more' => 'mehr Diskussionen anzeigen',
            ],
            'events' => [
                'title' => 'Events',
                'title_longer' => 'Neueste Events',
                'show_more' => 'mehr Events anzeigen',
            ],
            'historical' => [
                'title' => 'Historisch',

                'monthly_playcounts' => [
                    'title' => 'Play-Verlauf',
                    'count_label' => 'Spiele',
                ],
                'most_played' => [
                    'count' => 'mal gespielt',
                    'title' => 'Meistgespielte Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'genauigkeit: :percentage',
                    'title' => 'Neuliche Plays (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Angeschaute Wiederholungen',
                    'count_label' => 'Wiederholungen angeschaut',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Kudosu-Verlauf',
                'title' => 'Kudosu!',
                'total' => 'Kudosu insgesamt',

                'entry' => [
                    'amount' => ':amount Kudosu',
                    'empty' => "Dieser Benutzer hat kein Kudosu erhalten!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => ':amount durch das Zurückziehen des Kudosu-Verwehrens von :post erhalten',
                        ],

                        'deny_kudosu' => [
                            'reset' => ':amount vom Beitrag :post verwehrt',
                        ],

                        'delete' => [
                            'reset' => ':amount durch das Löschen des Modding-Beitrags :post verloren',
                        ],

                        'restore' => [
                            'give' => ':amount durch die Wiederherstellung des Modding-Posts :post erhalten',
                        ],

                        'vote' => [
                            'give' => ':amount durch erhaltene Stimmen im Post :post erhalten',
                            'reset' => ':amount durch verlorene Stimmen im Beitrag :post verloren',
                        ],

                        'recalculate' => [
                            'give' => ':amount durch Neuberechnung der Stimmen in :post erhalten',
                            'reset' => ':amount durch Neuberechnung der Stimmen in :post verloren',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':amount von :giver für einen Beitrag in :post erhalten',
                        'reset' => 'Kudosu von :giver im Beitrag :post zurückgesetzt',
                        'revoke' => 'Kudosu von :giver im Beitrag :post verwehrt',
                    ],
                ],

                'total_info' => [
                    '_' => 'Basierend auf dem Beitrag, den der Benutzer zum Beatmap-Modding geleistet hat. Weitere Informationen auf :link.',
                    'link' => 'dieser Seite',
                ],
            ],
            'me' => [
                'title' => 'ich!',
            ],
            'medals' => [
                'empty' => "Dieser Nutzer hat noch keine erhalten. ;_;",
                'recent' => 'Neueste',
                'title' => 'Medaillen',
            ],
            'posts' => [
                'title' => 'Beiträge',
                'title_longer' => 'Neueste Beiträge',
                'show_more' => 'weitere Beiträge anschauen',
            ],
            'recent_activity' => [
                'title' => 'Neulich',
            ],
            'top_ranks' => [
                'download_replay' => 'Replay herunterladen',
                'not_ranked' => 'Nur Ranked Beatmaps geben PP.',
                'pp_weight' => ':percentage gewichtet',
                'view_details' => 'Details anzeigen',
                'title' => 'Ränge',

                'best' => [
                    'title' => 'Beste Performance',
                ],
                'first' => [
                    'title' => 'Erster Platz',
                ],
            ],
            'votes' => [
                'given' => 'Abgegebene Stimmen (letzte 3 Monate)',
                'received' => 'Erhaltene Stimmen (letzte 3 Monate)',
                'title' => 'Stimmen',
                'title_longer' => 'Neueste Stimmen',
                'vote_count' => ':count_delimited Stimme|:count_delimited Stimmen',
            ],
            'account_standing' => [
                'title' => 'Accountstatus',
                'bad_standing' => "Der Account von <strong>:username</strong> ist zurzeit eingeschränkt :(",
                'remaining_silence' => '<strong>:username</strong> kann in :duration wieder sprechen.',

                'recent_infringements' => [
                    'title' => 'Neuliche Verstöße',
                    'date' => 'datum',
                    'action' => 'maßnahme',
                    'length' => 'länge',
                    'length_permanent' => 'Permanent',
                    'description' => 'beschreibung',
                    'actor' => 'von :username',

                    'actions' => [
                        'restriction' => 'Bann',
                        'silence' => 'Silence',
                        'note' => 'Warnung',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Interessen',
            'location' => 'Aktueller Standort',
            'occupation' => 'Beschäftigung',
            'twitter' => '',
            'website' => 'Webseite',
        ],
        'not_found' => [
            'reason_1' => 'Der gesuchte Benutzer könnte seinen Namen geändert haben.',
            'reason_2' => 'Der Account ist aus Sicherheitsgründen temporär nicht verfügbar.',
            'reason_3' => 'Du hast dich vielleicht verschrieben!',
            'reason_header' => 'Es gibt ein paar mögliche Gründe dafür:',
            'title' => 'Benutzer nicht gefunden! ;_;',
        ],
        'page' => [
            'button' => 'Profil bearbeiten',
            'description' => '<strong>me!</strong> ist ein persönlicher Bereich auf deinem osu!-Profil, den du nach deinem Belieben anpassen kannst.',
            'edit_big' => 'me! bearbeiten',
            'placeholder' => 'Seiteninhalt hier eingeben',

            'restriction_info' => [
                '_' => 'Sie müssen ein :link sein, um diese Funktion freizuschalten.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => ':link beigetragen',
            'count' => ':count_delimited Forumsbeitrag|:count_delimited Forenbeiträge',
        ],
        'rank' => [
            'country' => 'Länderrang im Modus :mode',
            'country_simple' => 'Landesrangliste',
            'global' => 'Globaler Rang im Modus :mode',
            'global_simple' => 'Globale Rangliste',
        ],
        'stats' => [
            'hit_accuracy' => 'Genauigkeit',
            'level' => 'Level :level',
            'level_progress' => 'Fortschritt bis zum nächsten Level',
            'maximum_combo' => 'Höchste Combo',
            'medals' => 'Medaillen',
            'play_count' => 'Anzahl Spiele',
            'play_time' => 'Gesamtspielzeit',
            'ranked_score' => 'Punktzahl auf Ranglisten',
            'replays_watched_by_others' => 'Von anderen angeschaute Wiederholungen',
            'score_ranks' => 'Ränge durch Punkte',
            'total_hits' => 'Anzahl Treffer',
            'total_score' => 'Gesamtpunktzahl',
            // modding stats
            'graveyard_beatmapset_count' => 'Begrabende Beatmaps',
            'loved_beatmapset_count' => 'Loved Beatmaps',
            'pending_beatmapset_count' => 'Ausstehende Beatmaps',
            'ranked_beatmapset_count' => 'Ranked & Approved Beatmaps',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Du bist derzeit stumm.',
        'message' => 'Einige Aktionen sind möglicherweise nicht verfügbar.',
    ],

    'status' => [
        'all' => 'Alle',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Benutzer erstellt',
    ],
    'verify' => [
        'title' => 'Accountverifizierung',
    ],

    'view_mode' => [
        'brick' => 'Ziegelansicht',
        'card' => 'Kartenansicht',
        'list' => 'Listenansicht',
    ],
];
