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
    'deleted' => '[törölt felhasználó]',

    'beatmapset_activities' => [
        'title' => ":user Modolási Történelme",
        'title_compact' => 'Modolás',

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
        'blocked_count' => '(:count) blokkolt felhasználók',
        'hide_profile' => 'profil elrejtése',
        'not_blocked' => 'Ez a felhasználó nincs blokkolva.',
        'show_profile' => 'profil megjelenítése',
        'too_many' => 'Blokkolási limit elérve.',
        'button' => [
            'block' => 'tiltás',
            'unblock' => 'tiltás feloldása',
        ],
    ],

    'card' => [
        'loading' => 'Betöltés...',
        'send_message' => 'üzenet küldése',
    ],

    'disabled' => [
        'title' => '',
        'warning' => "",

        'if_mistake' => [
            '_' => '',
            'email' => '',
        ],

        'reasons' => [
            'compromised' => '',
            'opening' => '',

            'tos' => [
                '_' => '',
                'community_rules' => '',
                'tos' => '',
            ],
        ],
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "",
        ],
    ],

    'login' => [
        '_' => 'Bejelentkezés',
        'button' => 'Bejelentkezés',
        'button_posting' => 'Bejelentkezés...',
        'email_login_disabled' => '',
        'failed' => 'Hibás adatok',
        'forgot' => 'Elfelejtetted a jelszavad?',
        'info' => '',
        'locked_ip' => 'Az IP címed zárolva van. Kérjük várj egy pár percet.',
        'password' => 'Jelszó',
        'register' => "Nincs osu! felhasználód? Regisztrálj egyet!",
        'remember' => 'Számítógép megjegyzése',
        'title' => 'Kérlek, jelentkezz be a folytatáshoz',
        'username' => 'Felhasználónév',

        'beta' => [
            'main' => 'Beta hozzáférés jelenleg csak kiváltságos felhasználóknak elérhető.',
            'small' => '(osu!támogatók hamarosan bejutnak)',
        ],
    ],

    'posts' => [
        'title' => ':username hozzászólásai',
    ],

    'anonymous' => [
        'login_link' => 'kattints a bejelentkezéshez',
        'login_text' => 'bejelentkezés',
        'username' => 'Vendég',
        'error' => 'Be kell jelentkezned, hogy ezt csináld.',
    ],
    'logout_confirm' => 'Biztosan ki akarsz jelentkezni? :(',
    'report' => [
        'button_text' => 'jelentés',
        'comments' => 'További megjegyzések',
        'placeholder' => 'Kérlek minden információt adj meg, amiről úgy gondolod hogy hasznos lehet.',
        'reason' => 'Ok',
        'thanks' => 'Köszönjük a jelentést!',
        'title' => ':username jelentése?',

        'actions' => [
            'send' => 'Jelentés küldése',
            'cancel' => 'Mégse',
        ],

        'options' => [
            'cheating' => 'Tisztességtelen játék / Csalás',
            'insults' => 'Engem / másokat sérteget',
            'spam' => 'Spam',
            'unwanted_content' => 'Nem megfelelő tartalom linkelése',
            'nonsense' => 'Nonszensz',
            'other' => 'Egyéb (alá írd)',
        ],
    ],
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
        'lastvisit_online' => 'Jelenleg elérhető',
        'missingtext' => 'Véletlenül elüthettél valamit! (vagy a felhasználó tiltva van)',
        'origin_country' => 'Innen: :country',
        'page_description' => 'osu! - Minden amit valaha tudni akartál :username-ról!',
        'previous_usernames' => 'korábbi nevén',
        'plays_with' => 'Ezekkel játszik: :devices',
        'title' => ":username profilja",

        'edit' => [
            'cover' => [
                'button' => 'Profil Borító Változtatása',
                'defaults_info' => 'További borító lehetőségek a jövőben lesznek elérhetőek',
                'upload' => [
                    'broken_file' => 'Kép feldolgozása sikertelen. Ellenőrizd a feltöltött képet és próbáld meg újra.',
                    'button' => 'Kép feltöltése',
                    'dropzone' => 'Húzd ide a feltöltendő fájlokat',
                    'dropzone_info' => 'Feltöltéshez ide is dobhatod a képed',
                    'size_info' => 'A borítónak 2800x620-asnak kellene lennie',
                    'too_large' => 'A feltöltött fájl túl nagy.',
                    'unsupported_format' => 'Nem támogatott formátum.',

                    'restriction_info' => [
                        '_' => 'Feltöltés csak :link -hez elérhető',
                        'link' => 'osu!támogatók',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'alapértelmezett játékmód',
                'set' => ':mode beállítása alapértelmezettnek',
            ],
        ],

        'extra' => [
            'none' => 'semmi',
            'unranked' => 'Nem játszott mostanában',

            'achievements' => [
                'achieved-on' => 'Elérte: :date',
                'locked' => 'Zárolt',
                'title' => 'Trófeák',
            ],
            'beatmaps' => [
                'by_artist' => ':artist által',
                'none' => 'Nincsen... még.',
                'title' => 'Beatmap-ek',

                'favourite' => [
                    'title' => 'Kedvenc Beatmapek',
                ],
                'graveyard' => [
                    'title' => 'Eltemetett Beatmap-ek',
                ],
                'loved' => [
                    'title' => 'Szeretett Beatmap-ek',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approved Beatmap-ek',
                ],
                'unranked' => [
                    'title' => 'Pending Beatmap-ek',
                ],
            ],
            'discussions' => [
                'title' => 'Hozzászólások',
                'title_longer' => '',
                'show_more' => '',
            ],
            'events' => [
                'title' => 'Események',
                'title_longer' => 'Legutóbbi Események',
                'show_more' => 'további események',
            ],
            'historical' => [
                'empty' => 'Nincsenek teljesítmény rekordok. :(',
                'title' => 'Történelem',

                'monthly_playcounts' => [
                    'title' => 'Játék előzmények',
                    'count_label' => 'Játszások',
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
                    'title' => 'Visszajátszás megtekintések előzménye',
                    'count_label' => 'Megnézett Visszajátszások',
                ],
            ],
            'kudosu' => [
                'available' => 'Elérhető Kudosu',
                'available_info' => "A kudosu becserélhető kudosu csillagokra, amely segít a beatmapjeidnek figyelmet gyüjteni. Ez az kudosu mennyiség amit még nem cseréltél be.",
                'recent_entries' => 'Legutóbbi Kudosu történelem',
                'title' => 'Kudosu!',
                'total' => 'Összesen megszerzett Kudosu',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Ez a felhasználó még nem kapott kudosu-t!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => ':amount kudosu szerezve a :post-on lévő kudosu megvonás megcáfolására',
                        ],

                        'deny_kudosu' => [
                            'reset' => ':amount visszavonva a :post modolási posztról',
                        ],

                        'delete' => [
                            'reset' => ':amount elvesztve a :post-on lévő modolási poszt törlődése miatt',
                        ],

                        'restore' => [
                            'give' => ':amount szerezve :post-on lévő modolási poszt visszaállítása miatt',
                        ],

                        'vote' => [
                            'give' => ':amount szerezve a :post-ban lévő modolási poszton elért szavazatokért',
                            'reset' => ':amount elvesztve a :post-ban lévő modolási posztról elvesztett szavazatokért',
                        ],

                        'recalculate' => [
                            'give' => ':amount szerezve a :post-ban lévő modolási poszt szavazatainak újraszámolásáért',
                            'reset' => ':amount elvesztve a :post-ban lévő modolási poszt szavazatainak újraszámolásáért',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':amount szerezve :giver által egy :post-ban lévő posztra',
                        'reset' => 'Kudosu visszaállítás :giver által a posztra :post',
                        'revoke' => 'Elutasitott kudosu :giver által a :post posztra',
                    ],
                ],

                'total_info' => [
                    '_' => '',
                    'link' => 'ez az oldal',
                ],
            ],
            'me' => [
                'title' => 'rólam!',
            ],
            'medals' => [
                'empty' => "Ez a felhasználó még nem rendelkezik egyel sem. ;_;",
                'recent' => 'Legújabb',
                'title' => 'Medálok',
            ],
            'posts' => [
                'title' => 'Bejegyzések',
                'title_longer' => 'Legutóbbi bejegyzések',
                'show_more' => 'láss további bejegyzéseket',
            ],
            'recent_activity' => [
                'title' => 'Legutóbbi',
            ],
            'top_ranks' => [
                'download_replay' => 'Replay letöltése',
                'empty' => 'Még nem rendelkezik kiemelkedő eredménnyel. :(',
                'not_ranked' => 'Kizárólag rangsorolt beatmap adhat pp-t.',
                'pp_weight' => 'súlyozott :percentage',
                'title' => 'Rangok',

                'best' => [
                    'title' => 'Legjobb eredmények',
                ],
                'first' => [
                    'title' => 'Első Helyezéses Eredmények',
                ],
            ],
            'votes' => [
                'given' => 'Szavazatok Leadva (legutóbbi 3 hónap)',
                'received' => 'Beérkezett Szavazatok (legutóbbi 3 hónap)',
                'title' => 'Szavazatok',
                'title_longer' => 'Legutóbbi Szavazatok',
                'vote_count' => '',
            ],
            'account_standing' => [
                'title' => 'Fiók Állása',
                'bad_standing' => "<strong>:username</strong> fiókja nincs jó helyzetben. :(",
                'remaining_silence' => '<strong>:username</strong> ismét képes lesz a beszédre :duration időn belül.',

                'recent_infringements' => [
                    'title' => 'Legutóbbi szabálysértések',
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
            'reason_1' => 'Talán megváltoztatta a felhasználónevét.',
            'reason_2' => 'Ez a fiók jelenleg nem elérhető biztonsági vagy visszaélési okokból.',
            'reason_3' => 'Lehet, hogy elírtál valamit!',
            'reason_header' => 'Fennáll egy pár lehetséges ok erre:',
            'title' => 'Felhasználó nem található! ;_;',
        ],
        'page' => [
            'button' => 'Profil szerkesztése',
            'description' => '<strong>Rólam!</strong> egy személyre szabható része a profilodnak.',
            'edit_big' => 'A rólam! szerkesztése!',
            'placeholder' => 'Írd ide az oldal tartalmát',

            'restriction_info' => [
                '_' => '',
                'link' => 'osu!támogató',
            ],
        ],
        'post_count' => [
            '_' => 'Hozzájárult :link',
            'count' => ':count fórum poszt|:count fórum posztok',
        ],
        'rank' => [
            'country' => 'Országos rank a/az :mode-ra/re',
            'country_simple' => 'Országos Rangsor',
            'global' => 'Globális rank a :mode-ra/re',
            'global_simple' => 'Globális Rangsor',
        ],
        'stats' => [
            'hit_accuracy' => 'Találati Pontosság',
            'level' => 'Szint: :level',
            'level_progress' => 'Haladás a következő szintre',
            'maximum_combo' => 'Legmagasabb Kombó',
            'medals' => 'Medálok',
            'play_count' => 'Játékszám',
            'play_time' => 'Teljes játékidő',
            'ranked_score' => 'Rangsorolt Pontszám',
            'replays_watched_by_others' => 'Mások Által Megtekintett Visszajátszások',
            'score_ranks' => 'Eredmény Rangok',
            'total_hits' => 'Találatok Száma',
            'total_score' => 'Összpontszám',
            // modding stats
            'ranked_and_approved_beatmapset_count' => '',
            'loved_beatmapset_count' => '',
            'unranked_beatmapset_count' => '',
            'graveyard_beatmapset_count' => '',
        ],
    ],

    'status' => [
        'all' => 'Összes',
        'online' => 'Elérhető',
        'offline' => 'Nem elérhető',
    ],
    'store' => [
        'saved' => 'Felhasználó létrehozva',
    ],
    'verify' => [
        'title' => 'Fiók megerősítése',
    ],

    'view_mode' => [
        'card' => 'Kártya nézet',
        'list' => 'Lista nézet',
    ],
];
