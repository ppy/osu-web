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
        'title' => ":user Modolási Történelme",

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
            'small' => '(osu!támogatók hamarosan bejutnak)',
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
        'missingtext' => 'Véletlenül elüthettél valamit! (vagy a felhasználó tiltva van)',
        'origin_country' => 'Innen: :country',
        'page_description' => 'osu! - Minden amit valaha tudni akartál :username-ról!',
        'previous_usernames' => 'korábbi nevén',
        'plays_with' => 'Ezekkel játszik: :devices',
        'title' => ":username profilja",

        'edit' => [
            'cover' => [
                'button' => 'Profil Borító Változtatása',
                'defaults_info' => 'Több borító lehetőségek a jövőben lesznek elérhetőek',
                'upload' => [
                    'broken_file' => 'Kép feldolgozása sikertelen. Ellenőrizd a feltöltött képet és próbáld meg újra.',
                    'button' => 'Kép feltöltése',
                    'dropzone' => 'Húzd ide a feltöltendő fájlokat',
                    'dropzone_info' => 'Feltöltéshez ide is dobhatod a képed',
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
                    'title' => 'Visszajátszás megtekintések előzménye',
                ],
            ],
            'kudosu' => [
                'available' => 'Elérhető Kudosu',
                'available_info' => "A kudosu becserélhető kudosu csillagokra, amely segít a beatmapjeidnek figyelmet gyüjteni. Ez az kudosu mennyiség amit még nem cseréltél be.",
                'recent_entries' => 'Legutóbbi Kudosu történelem',
                'title' => 'Kudosu!',
                'total' => 'Összesen megszerzett Kudosu',
                'total_info' => 'Az alapján, hogy mennyire járult hozzá a felhasználó a beatmap moderáláshoz. Lásd <a href="'.osu_url('user.kudosu').'">ezt az oldalt</a> bővebb információkért.',

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
            ],
            'me' => [
                'title' => 'rólam!',
            ],
            'medals' => [
                'empty' => "Ez a felhasználó még nem rendelkezik egyel sem. ;_;",
                'title' => 'Medálok',
            ],
            'recent_activity' => [
                'title' => 'Legutóbbi',
            ],
            'top_ranks' => [
                'empty' => 'Még nem rendelkezik kiemelkedő eredménnyel. :(',
                'not_ranked' => 'Kizárólag rangsorolt beatmap adhat pp-t.',
                'pp' => '',
                'title' => 'Rangok',
                'weighted_pp' => 'súlyozott: :pp (:percentage)',

                'best' => [
                    'title' => 'Legjobb eredmények',
                ],
                'first' => [
                    'title' => 'Első Helyezéses Eredmények',
                ],
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
            'description' => '<strong>Rólam!</strong> egy személyre szabható része a profilodnak.',
            'edit_big' => 'A rólam! szerkesztése!',
            'placeholder' => 'Írd ide az oldal tartalmát',
            'restriction_info' => "A funkció feloldásához <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!támogató</a> kell hogy legyél.",
        ],
        'post_count' => [
            '_' => 'Hozzájárult :link',
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
            'play_count' => 'Játékszám',
            'play_time' => 'Teljes játékidő',
            'ranked_score' => 'Rangsorolt Pontszám',
            'replays_watched_by_others' => 'Mások Által Megtekintett Visszajátszások',
            'score_ranks' => 'Eredmény Rangok',
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
        'title' => 'Fiók megerősítése',
    ],
];
