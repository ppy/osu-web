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
    'deleted' => 'Odstránený užívateľ',

    'beatmapset_activities' => [
        'title' => ":user's Modding História",
        'title_compact' => '',

        'discussions' => [
            'title_recent' => 'Nedávno zahájená diskusia',
        ],

        'events' => [
            'title_recent' => 'Posledné udalosti',
        ],

        'posts' => [
            'title_recent' => 'Najnovšie príspevky',
        ],

        'votes_received' => [
            'title_most' => 'Najlepšie hodnotené za (posledné 3 mesiace)',
        ],

        'votes_made' => [
            'title_most' => 'Najlepšie hodnotené (posledné 3 mesiace)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Užívateľ bol zablokovaný.',
        'blocked_count' => 'zablokovaný užívatelia (:count)',
        'hide_profile' => 'skryť profil',
        'not_blocked' => 'Tento užívateľ nie je zablokovaný.',
        'show_profile' => 'zobraziť profil',
        'too_many' => 'Bol dosiahnutý blokovací limit.',
        'button' => [
            'block' => 'blokovať',
            'unblock' => 'odblokovať',
        ],
    ],

    'card' => [
        'loading' => 'Načitávanie...',
        'send_message' => 'poslať správu',
    ],

    'login' => [
        '_' => 'Prihlásiť sa',
        'locked_ip' => 'vaša IP adresa je zamknutá. Prosím počkajte niekoľko minút.',
        'username' => 'Používateľské meno',
        'password' => 'Heslo',
        'button' => 'Prihlásiť sa',
        'button_posting' => 'Prihlasuje sa...',
        'remember' => 'Pamätať si tento počítač',
        'title' => 'Pre pokračovanie sa prosím prihláste',
        'failed' => 'Nesprávne prihlásenie',
        'register' => "Nemáš osu! účet? Vytvor si nový",
        'forgot' => 'Zabudli ste heslo?',
        'beta' => [
            'main' => 'Beta prístup je momentálne obmedzený pre oprávnených užívateľov.',
            'small' => '(osu!supporters sa dostanú dnu skorej)',
        ],

        'here' => 'tu', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':username\'s príspevky',
    ],

    'signup' => [
        '_' => 'Registrácia',
    ],
    'anonymous' => [
        'login_link' => 'klikni pre prihlásenie',
        'login_text' => 'prihlásiť sa',
        'username' => 'Návštevník',
        'error' => 'Pre túto akciu sa musíte najskôr prihlásiť.',
    ],
    'logout_confirm' => 'Naozaj sa chceš odhlásiť? :(',
    'report' => [
        'button_text' => 'nahlásiť',
        'comments' => 'Ďalšie komentáre',
        'placeholder' => 'Prosím, uveďte akékoľvek informácie, ktoré si myslíte, že by mohli byť užitočné.',
        'reason' => 'Dôvod',
        'thanks' => 'Ďakujeme za nahlásenie!',
        'title' => 'Nahlásiť :username?',

        'actions' => [
            'send' => 'Odoslať nahlásenie',
            'cancel' => 'Zrušiť',
        ],

        'options' => [
            'cheating' => 'Nečestné hranie / Podvádzanie',
            'insults' => 'Urážanie mňa / iných',
            'spam' => 'Spam',
            'unwanted_content' => 'Posiela nevhodný obsah',
            'nonsense' => 'Nezmysel',
            'other' => 'Iné (uveď nižšie)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Tvoj účet bol obmedzený!',
        'message' => 'Zatial čo si v obmedzenom režime, nebudeš môcť komunikovať s ostatnými hráčmi a tvoje skóre budu viditelné iba pre teba. Toto je obvykle výsledkom automatického procesu, ktorý by sa mal sám vyriešit najneskôr do 24 hodin. Pokial si praješ odvolat tvoje obmedzenie, prosím <a href="mailto:accounts@ppy.sh">kontaktujte podporu</a>.',
    ],
    'show' => [
        'age' => ':age rokov',
        'change_avatar' => 'zmeň si svoj avatar!',
        'first_members' => 'Od samého začiatku',
        'is_developer' => 'osu!vývojár',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Pripojil sa :date',
        'lastvisit' => 'Naposledy videný :date',
        'missingtext' => 'Možno si sa prepísal! (alebo bol používateľ zabanovaný)',
        'origin_country' => 'Z :country',
        'page_description' => 'osu! - Všetko čo ste kedy chceli vedieť o :username!',
        'previous_usernames' => 'v minulosti známy ako',
        'plays_with' => 'Hrá s :devices',
        'title' => "profil užívateľa :username",

        'edit' => [
            'cover' => [
                'button' => 'Zmeniť pokrytie profilu',
                'defaults_info' => 'Viac možnosti pokrytia bude dostupných v budúcnosti',
                'upload' => [
                    'broken_file' => 'Spracovanie obrázku zlyhalo. Over si obrázok a skús to znova.',
                    'button' => 'Nahrať obrázok',
                    'dropzone' => 'Tu vložte pre nahratie',
                    'dropzone_info' => 'Taktiež môžeš tu pretiahnuť pre nahranie',
                    'size_info' => 'Veľkosť pokrytia by mala byť 2800x620',
                    'too_large' => 'Nahraný súbor je príliš veľký.',
                    'unsupported_format' => 'Nepodporovaný formát.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'štandardný herný mód',
                'set' => 'nastaviť :mode ako predvolený herný mód profilu',
            ],
        ],

        'extra' => [
            'followers' => '1 sledujúci |:count sledujúcich',
            'unranked' => 'Žiadne posledné údaje o hraní',

            'achievements' => [
                'achieved-on' => 'Dosiahnuté :date',
                'locked' => '',
                'title' => 'Úspechy',
            ],
            'beatmaps' => [
                'by_artist' => '',
                'none' => 'Zatiaľ žiadne...',
                'title' => 'Beatmapy',

                'favourite' => [
                    'title' => 'Obľúbené Beatmapy',
                ],
                'graveyard' => [
                    'title' => 'Pochované Beatmapy',
                ],
                'loved' => [
                    'title' => 'Obľúbené Beatmapy',
                ],
                'ranked_and_approved' => [
                    'title' => 'Hodnotené & Schválené Beatmapy',
                ],
                'unranked' => [
                    'title' => 'Čakajúce Beatmapy',
                ],
            ],
            'historical' => [
                'empty' => 'Žiadne výkonnostné rekordy. :(',
                'title' => 'História',

                'monthly_playcounts' => [
                    'title' => 'Herná História',
                    'count_label' => '',
                ],
                'most_played' => [
                    'count' => 'odohraný čas',
                    'title' => 'Najviac Hrané Beatmapy',
                ],
                'recent_plays' => [
                    'accuracy' => 'presnosť: :percentage',
                    'title' => 'Nedávno Odohrané (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'História Pozretých Replayov',
                    'count_label' => '',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu k Dispozícií',
                'available_info' => "Kudosu môžu byť zamenené za kudosu hviezdy, ktoré pomôžu tvojej mape získať viacej pozornosti. Toto je počet kudosu, ktoré ste ešte nezamenili.",
                'recent_entries' => 'Nedávna Kudosu História',
                'title' => 'Kudosu!',
                'total' => 'Celkovo Získané Kudosu',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Tento užívateľ zatiaľ neobdržal žiadne kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Obdržal si :amount kudosu z odmietnutí kudosu z modding príspevku :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Bolo odopreté :amount z modding príspevku :post',
                        ],

                        'delete' => [
                            'reset' => 'Strateno :amount kvôli zmazaniu príspevku :post',
                        ],

                        'restore' => [
                            'give' => 'Obdržané :amount za obnovenie modding príspevku :post',
                        ],

                        'vote' => [
                            'give' => 'Obdržané :amount za získanie hlasu v modding príspevku :post',
                            'reset' => 'Strateno :amount za stratu hlasu v modding príspevku :post',
                        ],

                        'recalculate' => [
                            'give' => 'Obdržané :amount za prepočítanie hlasov v modding príspevku :post',
                            'reset' => 'Strateno :amount za prepočítanie hlasov v modding príspevku :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Obdržané :amount od :giver za príspevok :post',
                        'reset' => 'Kudosu bolo obnovené od :giver za príspevok :post',
                        'revoke' => 'Odopreté Kudosu od :giver za príspevok :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'ja!',
            ],
            'medals' => [
                'empty' => "Tento užívateľ zatiaľ žiadne neobdržal. ;_;",
                'recent' => '',
                'title' => 'Medaile',
            ],
            'recent_activity' => [
                'title' => 'Nedávne',
            ],
            'top_ranks' => [
                'download_replay' => 'Stiahnuť Záznam',
                'empty' => 'Zatial žiadné záznamy o úžasnom výkone. :(',
                'not_ranked' => 'Iba hodnotené beatmapy ti dajú pp.',
                'pp_weight' => '',
                'title' => 'Umiestnenia',

                'best' => [
                    'title' => 'Najlepšie Výkony',
                ],
                'first' => [
                    'title' => 'Umiestnenie na prvom mieste',
                ],
            ],
            'account_standing' => [
                'title' => 'Stav Účtu',
                'bad_standing' => "Účet použivateľa <strong>:username's</strong> nie je v dobrej povesti. :(",
                'remaining_silence' => 'Používateľ <strong>:username</strong> bude môcť znova rozprávať za :duration.',

                'recent_infringements' => [
                    'title' => 'Nedávne Porušenia',
                    'date' => 'dátum',
                    'action' => 'trest',
                    'length' => 'dĺžka',
                    'length_permanent' => 'Permanentné',
                    'description' => 'popis',
                    'actor' => 'od :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Stlmenie',
                        'note' => 'Poznámka',
                    ],
                ],
            ],
        ],

        'header_title' => [
            '_' => '',
            'info' => '',
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Záujmy',
            'lastfm' => 'Last.fm',
            'location' => 'Súčasná Poloha',
            'occupation' => 'Povolanie',
            'skype' => '',
            'twitter' => '',
            'website' => 'Web Stránka',
        ],
        'not_found' => [
            'reason_1' => 'Možno si zmenil užívateľské meno.',
            'reason_2' => 'Účet môže byť dočasne nedostupný z dôvodu problému s bezpečnosťou alebo zneužitím.',
            'reason_3' => 'Možno si sa prepísal!',
            'reason_header' => 'Je tu niekoľko možných dôvodov:',
            'title' => 'Užívateľ nebol nájdený! ;_;',
        ],
        'page' => [
            'button' => '',
            'description' => '<strong>ja!</strong> je osobná prispôsobiteľná plocha na tvojom profile.',
            'edit_big' => 'Uprav ma!',
            'placeholder' => 'Tu napíš obsah stránky',
        ],
        'post_count' => [
            '_' => 'Prispel :link',
            'count' => ':count príspevok na fórum|:count príspevky na fóru',
        ],
        'rank' => [
            'country' => 'Štátna pozícia pre :mode',
            'country_simple' => '',
            'global' => 'Globálna pozícia pre :mode',
            'global_simple' => '',
        ],
        'stats' => [
            'hit_accuracy' => 'Presnosť Zásahov',
            'level' => 'Úroveň :level',
            'level_progress' => '',
            'maximum_combo' => 'Maximálne Kombo',
            'medals' => '',
            'play_count' => 'Počet Zahraní',
            'play_time' => 'Celkový počet hrania',
            'ranked_score' => 'Hodnotené Skóre',
            'replays_watched_by_others' => 'Replaye Pozreté od Ostatných',
            'score_ranks' => 'Umiestnenie Podľa Skóre',
            'total_hits' => 'Celkových Zásahov',
            'total_score' => 'Celkové Skóre',
        ],
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Vytvorený používateľom',
    ],
    'verify' => [
        'title' => 'Overenie Účtu',
    ],
];
