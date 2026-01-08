<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'innstillinger',
        'username' => 'brukernavn',

        'avatar' => [
            'title' => 'Profilbilde',
            'reset' => 'nullstill',
            'rules' => 'Vennligst sørg for at profilbildet ditt følger :link<br/>Dette betyr at det må være <strong>passende for alle aldersgrupper</strong>. d.v.s. ingen nakenhet, upassende språk eller innhold.',
            'rules_link' => 'Samfunns regler',
        ],

        'email' => [
            'new' => 'ny e-post',
            'new_confirmation' => 'bekreft e-post',
            'title' => 'E-post',
            'locked' => [
                '_' => 'Vennligst kontakt :accounts dersom du trenger e-posten din oppdatert.',
                'accounts' => 'brukerstøtteteam',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Gammel API',
        ],

        'password' => [
            'current' => 'nåværende passord',
            'new' => 'nytt passord',
            'new_confirmation' => 'bekreft passord',
            'title' => 'Passord',
        ],

        'profile' => [
            'country' => 'land',
            'title' => 'Profil',

            'country_change' => [
                '_' => "Det ser ut til at landet på kontoen din ikke samsvarer med landet du bor i. :update_link.",
                'update_link' => 'Oppdater til :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'nåværende plassering',
                'user_interests' => 'interesser',
                'user_occ' => 'yrke',
                'user_twitter' => '',
                'user_website' => 'nettside',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'oppdater',
        ],
    ],

    'github_user' => [
        'info' => "Hvis du er en bidragsyter til osu!s åpne kildekode, kan du knytte endringene dine med osu! profilen ved å koble til GitHub-kontoen din her. GitHub-kontoer uten bidragshistorikk til osu! kan ikke bli koblet til.",
        'link' => 'Koble til GitHub-konto',
        'title' => 'GitHub',
        'unlink' => 'Koble fra GitHub-konto',

        'error' => [
            'already_linked' => 'Denne GitHub-kontoen er allerede koblet til en annen bruker.',
            'no_contribution' => 'Kan ikke koble GitHub-konto uten bidragshistorikk i osu! kildekode.',
            'unverified_email' => 'Vennligst bekreft din primære e-postadresse på GitHub, og så prøv å koble til kontoen på nytt.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'motta varsler for nye problemer på kvalifiserte beatmaps av følgende moduser',
        'beatmapset_disqualify' => 'få varsler når beatmaperav de følgende moduser er diskvalifisert',
        'comment_reply' => 'motta varsler for svar på dine kommentarer',
        'news_post' => '',
        'title' => 'Varsler',
        'topic_auto_subscribe' => 'aktiver automatiske varslinger på nye forum emner som du lager',

        'options' => [
            '_' => 'leveringsalternativer',
            'beatmap_owner_change' => 'gjeste-kart',
            'beatmapset:modding' => 'beatmap modding',
            'channel_message' => 'private meldinger',
            'channel_team' => '',
            'comment_new' => 'nye kommentar',
            'forum_topic_reply' => 'emne svar',
            'mail' => 'e-post',
            'mapping' => 'beatmap mapper',
            'news_post' => '',
            'push' => 'trykk',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autoriserte applikasjoner',
        'own_clients' => 'egne klienter',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'skjul advarsler for eksplisitt innhold i beatmaps',
        'beatmapset_title_show_original' => 'vis beatmap metadata på originalspråket',
        'title' => 'Innstillinger',

        'beatmapset_download' => [
            '_' => 'standard nedlastingstype for beatmap',
            'all' => 'med video hvis tilgjengelig',
            'direct' => 'åpne i osu!direct',
            'no_video' => 'uten video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'tastatur',
        'mouse' => 'mus',
        'tablet' => 'tegnebrett',
        'title' => 'Spillemåter',
        'touch' => 'touch-skjerm',
    ],

    'privacy' => [
        'friends_only' => 'blokker private meldinger fra personer som ikke er på vennelisten din',
        'hide_online' => 'skjul påloggingsstatus',
        'hide_online_info' => '',
        'title' => 'Personvern',
    ],

    'security' => [
        'current_session' => 'nåværende',
        'end_session' => 'Avslutt økt',
        'end_session_confirmation' => 'Dette vil umiddelbart avslutte økten på denne enheten. Er du sikker?',
        'last_active' => 'Sist aktiv:',
        'title' => 'Sikkerhet',
        'web_sessions' => 'websideøkter',
    ],

    'update_email' => [
        'update' => 'oppdater',
    ],

    'update_password' => [
        'update' => 'oppdater',
    ],

    'user_totp' => [
        'title' => '',
        'usage_note' => 'Bruk app i steden for e-post for totrinnsautentisering. Totrinnsautentisering gjennom e-post vil være tilgjengelig som reserveløsning.',

        'button' => [
            'remove' => 'Fjern',
            'setup' => 'Legg til totrinnsautentisering.',
        ],
        'status' => [
            'label' => 'status',
            'not_set' => 'Ikke konfigurert',
            'set' => 'Konfigurert',
        ],
    ],

    'verification_completed' => [
        'text' => 'Du kan nå lukke dette vinduet/fanen',
        'title' => 'Verifisering fullført',
    ],

    'verification_invalid' => [
        'title' => 'Ugyldig eller utgått verifiseringslenke',
    ],
];
