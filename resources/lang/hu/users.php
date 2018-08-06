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
    'deleted' => '[törölt felhasználó]',

    'beatmapset_activities' => [
        'title' => ":user Modding Története",

        'discussions' => [
            'title_recent' => 'Legutóbb kezdett beszélgetések',
        ],

        'events' => [
            'title_recent' => 'Legutóbbi események',
        ],

        'posts' => [
            'title_recent' => 'Legutóbbi hozzászólások',
        ],

        'votes_received' => [
            'title_most' => 'A legmagasabbra értékelt (az előző 3 hónap alapján)',
        ],

        'votes_made' => [
            'title_most' => 'A legmagasabbra értékelt (az előző 3 hónap alapján)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Blokkoltad ezt a felhasználót.',
        'blocked_count' => '(:count) letiltott fehasználó',
        'hide_profile' => 'profil elrejtése',
        'not_blocked' => 'Ez a felhasználó nincs blokkolva.',
        'show_profile' => 'profil megjelenítése',
        'too_many' => 'Blokkolási korlát elérve.',
        'button' => [
            'block' => 'tiltás',
            'unblock' => 'tiltás feloldása',
        ],
    ],

    'card' => [
        'loading' => 'Betöltés...',
        'send_message' => 'üzenet küldése',
    ],

    'login' => [
        '_' => 'Bejelentkezés',
        'locked_ip' => 'Az IP címed zárolva van. Kérjük várj egy pár percet.',
        'username' => 'Felhasználónév',
        'password' => 'Jelszó',
        'button' => 'Bejelentkezés',
        'button_posting' => 'Bejelentkezés...',
        'remember' => 'Számítógép megjegyzése',
        'title' => 'Kérlek, jelentkezz be a folytatáshoz',
        'failed' => 'Hibás adatok',
        'register' => "Nincs osu! felhasználód? Regisztrálj egyet!",
        'forgot' => 'Elfelejtetted a jelszavad?',
        'beta' => [
            'main' => 'Beta hozzáférés jelenleg csak kiváltságos felhasználóknak elérhető.',
            'small' => '(a támogatók hamarosan bejutnak)',
        ],

        'here' => 'itt', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':username hozzászólásai',
    ],

    'signup' => [
        '_' => 'Regisztráció',
    ],
    'anonymous' => [
        'login_link' => 'kattints a bejelentkezéshez',
        'login_text' => 'bejelentkezés',
        'username' => 'Vendég',
        'error' => 'Be kell jelentkezned, hogy ezt csináld.',
    ],
    'logout_confirm' => 'Biztosan ki akarsz jelentkezni? :(',
    'restricted_banner' => [
        'title' => 'A felhasználói fiókod korlátozva lett!',
        'message' => 'Korlátozva nem leszel képes más játékosokkal kapcsolatba lépni és a pontjaid csak neked lesznek láthatóak. Ez az eredménye egy automatikus folyamatnak és általában fel lesz oldva 24 órán belül. Amennyiben fellebbezni szeretnél, légyszíves lépj kapcsolatba a <a href="mailto:accounts@ppy.sh">support</a>-al.',
    ],
    'show' => [
        'age' => ':age éves',
        'change_avatar' => 'változtasd meg a profilképed!',
        'first_members' => 'Itt van a kezdetek óta',
        'is_developer' => 'osu!fejlesztő',
        'is_supporter' => 'osu!támogató',
        'joined_at' => 'Regisztrált: :date',
        'lastvisit' => 'Legutóbb online: :date',
        'missingtext' => 'Véletlenül elüthettél valamit! (vagy a felhasználó tiltva van)',
        'origin_age' => ':age',
        'origin_country_age' => ':age, innen: :country',
        'origin_country' => 'Innen: :country',
        'page_description' => 'osu! - Minden amit valaha tudni akartál :username-ról!',
        'previous_usernames' => 'korábbi nevén',
        'plays_with' => 'Ezzel játszik: :devices',
        'title' => ":username profilja",

        'edit' => [
            'cover' => [
                'button' => 'Profil Borító Változtatása',
                'defaults_info' => 'Több borító lehetőségek a jövőben lesznek elérhetőek',
                'upload' => [
                    'broken_file' => 'Kép feldolgozása sikertelen. Ellenőrizd a feltöltött képet és próbáld meg újra.',
                    'button' => 'Kép feltöltése',
                    'dropzone' => 'Húzd ide a feltöltendő fájlokat',
                    'dropzone_info' => 'Ide is dobhatod a képed hogy feltöltsd',
                    'restriction_info' => "Feltöltés elérhető <a href='".route('store.products.show', 'supporter-tag')."csak ' target='_blank'>osu!támogatók</a>",
                    'size_info' => 'A borítónak 2000x700-asnak kellene lennie',
                    'too_large' => 'A feltöltött fájl túl nagy.',
                    'unsupported_format' => 'Nem támogatott formátum.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'alapértelmezett játékmód',
                'set' => ':mode beállítása alapértelmezettnek',
            ],
        ],

        'extra' => [
            'followers' => '1 követő |:count követő',
            'unranked' => 'Nem játszott mostanában',

            'achievements' => [
                'title' => 'Trófeák',
                'achieved-on' => 'Elérte: :date',
            ],
            'beatmaps' => [
                'none' => 'Nincsen... még.',
                'title' => 'Beatmap-ek',

                'favourite' => [
                    'title' => 'Kedvenc Beatmapek (:count)',
                ],
                'graveyard' => [
                    'title' => 'Eltemetett Beatmap-ek (:count)',
                ],
                'loved' => [
                    'title' => 'Szeretett Beatmap-ek (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approved Beatmap-ek (:count)',
                ],
                'unranked' => [
                    'title' => 'Pending Beatmap-ek (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Nincsenek teljesítmény rekordok. :(',
                'title' => 'Történelem',

                'monthly_playcounts' => [
                    'title' => 'Játék előzmények',
                ],
                'most_played' => [
                    'count' => 'alkalommal lejátszva',
                    'title' => 'Legtöbbet Játszott Beatmap-ek',
                ],
                'recent_plays' => [
                    'accuracy' => 'pontosság: :percentage',
                    'title' => 'Legutóbb Játszott (24ó)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Visszajátszás megtekintésének előzménye',
                ],
            ],
            'kudosu' => [
                'available' => 'Elérhető kudosu',
                'available_info' => "A kudosu becserélhető kudosu csillagokra, amely segít a beatmapjeidnek figyelmet gyüjteni. Ez az kudosu mennyiség amit még nem cseréltél be.",
                'recent_entries' => 'Legutóbbi kudosu előzmény',
                'title' => 'Kudosu!',
                'total' => 'Összesítetten elért kudosu',
                'total_info' => 'Ahhoz, hogy láthasd mennyit müködött, hogy a felhasználó a beatmap moderálásához. Lást <a href=\''.osu_url('user.kudosu').'">ezt az oldalt</a> bővebb információért.',

                'entry' => [
                    'amount' => ':amount kudosu mennyiség',
                    'empty' => "Ez a felhasználó egyetlen kudosu!-t sem szerzett",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => ':amount kudosu szerezve a modolási tagadó kérelemre a :poszt posztról',
                        ],

                        'deny_kudosu' => [
                            'reset' => ':amount visszavonva a :poszt modolási posztról',
                        ],

                        'delete' => [
                            'reset' => ':amount elveszítve a modolási :post poszt törlésre kerülése miatt',
                        ],

                        'restore' => [
                            'give' => ':amount szerezve a modolási :post poszt újraállitása miatt',
                        ],

                        'vote' => [
                            'give' => ':amount szerezve a szavazatokból a :post modolási posztról',
                            'reset' => ':amount elvesztve szavazatok vesztése miatt a :post modolási posztról',
                        ],

                        'recalculate' => [
                            'give' => ':amount szerezve szavazatok újrakalkulálása végett a :post modolási posztról',
                            'reset' => ':amount veszítve a szavazatok újrakalkulálása miatt a :post modolási posztról',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':amount szerezve :giver adótol a :post posztra',
                        'reset' => 'Kudosu újrakezdés a/az :giver adótol a :post posztra',
                        'revoke' => 'Elutasitott kudosu :giver adótol a :post posztra',
                    ],
                ],
            ],
            'me' => [
                'title' => 'rólam!',
            ],
            'medals' => [
                'empty' => "Ez a felhasználó még egyetlennel sem rendelkezik. ;_;",
                'title' => 'Medálok',
            ],
            'recent_activity' => [
                'title' => 'Legutóbbi',
            ],
            'top_ranks' => [
                'empty' => 'Egyetlen bámulatos eredmény sincs eddig. :(',
                'not_ranked' => 'Csak rankolt beatmap ad pp-t.',
                'pp' => '',
                'title' => 'Rankok',
                'weighted_pp' => 'súlyozott: :pp (:percentage)',

                'best' => [
                    'title' => 'Legjobb eredmények',
                ],
                'first' => [
                    'title' => 'Első helyezetet elért eredmények',
                ],
            ],
            'account_standing' => [
                'title' => 'Álló fiók',
                'bad_standing' => "<strong>:username</strong> gardróbjának nem áll jól a szénája :(",
                'remaining_silence' => '<strong>felhasználó</strong> képes lesz ismétt beszélni :duration időn belül.',

                'recent_infringements' => [
                    'title' => 'Legutóbbi jogsértések',
                    'date' => 'dátum',
                    'action' => 'művelet',
                    'length' => 'hossz',
                    'length_permanent' => 'Végleges',
                    'description' => 'leírás',
                    'actor' => ':username által',

                    'actions' => [
                        'restriction' => 'Kitiltás',
                        'silence' => 'Némítás',
                        'note' => 'Megjegyzés',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => '',
            'interests' => 'Érdekeltségek',
            'lastfm' => 'Last.fm',
            'location' => 'Tartózkodási hely',
            'occupation' => 'Foglalkozás',
            'skype' => '',
            'twitter' => '',
            'website' => 'Honlap',
        ],
        'not_found' => [
            'reason_1' => 'Ők talán megváltoztatták a felhasználónevüket.',
            'reason_2' => 'Ez a fiók jelenleg nem elérhető biztonsági/visszaélési okokbol.',
            'reason_3' => 'Megtörténhet, hogy elírtál valamit!',
            'reason_header' => 'Fennáll egy pár lehetséges ok erre:',
            'title' => 'Felhasználó nem található! ;_;',
        ],
        'page' => [
            'description' => '<strong>Rólam!</strong> egy egyedivé tehető része a profilodnak.',
            'edit_big' => 'A rólam! szerkesztése!',
            'placeholder' => 'Írd ide az oldal tartalmát',
            'restriction_info' => "<a href='-nek kell lenned".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!támogató</a>kell a funkció feloldásához.",
        ],
        'post_count' => [
            '_' => 'Közremüködött :link-ban',
            'count' => ':count fórum poszt|:count fórum posztok',
        ],
        'rank' => [
            'country' => 'Országos rank a/az :mode-ra/re',
            'global' => 'Globális rank a :mode-ra/re',
        ],
        'stats' => [
            'hit_accuracy' => 'Találati Pontosság',
            'level' => 'Szint: :level',
            'maximum_combo' => 'Legmagasabb Kombó',
            'play_count' => 'Játszottság szám',
            'play_time' => 'Teljes játékidő',
            'ranked_score' => 'Rankolt pontszám',
            'replays_watched_by_others' => 'Megtekintett Visszajátszások Mások Által',
            'score_ranks' => 'Eredmény pontok',
            'total_hits' => 'Találatok Száma',
            'total_score' => 'Összpontszám',
        ],
    ],
    'status' => [
        'online' => 'Elérhető',
        'offline' => 'Nem elérhető',
    ],
    'store' => [
        'saved' => 'Felhasználó létrehozva',
    ],
    'verify' => [
        'title' => 'Fiók megerősitése',
    ],
];
