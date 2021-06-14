<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'title' => 'Uh-oh! Úgy tűnik a fiókod le lett tiltva.',
        'warning' => "Abban az esetben, ha megszegsz egy szabályt, kérlek vedd figyelembe, hogy van egy általános egy hónapos időszak, amiben nem fogadunk el amnesztiával kapcsolatos kéréseket. Ezután az időszak után, szabadon kapcsolatba léphetsz velünk, ha szükségesnek láttod. Kérlek vedd figyelembe, hogy ha egy új fiókot hozol létre, ha már volt legalább egy letiltott fiókod, ez egy újabb hónap meghosszabitást eredményez. Vedd azt is figyelembe, hogy minnél több fiókot hozol létre, annál több büntetésed lesz. Nagyon ajánljuk, hogy ne menj el ebbe az írányba!",

        'if_mistake' => [
            '_' => 'Ha hibát észleltél, nyugodtan lépj kapcsolatba velünk (itt :email vagy kattints a ? ikonra a jobb alsó sarokba az oldalon). Fontos, hogy mi mindig magabiztosak vagyunk abban mit teszünk, mivel nagyon magabiztos adatokból dolgozunk. Továbbá fent tartjuk azt a jogot, hogy a becstelen  vagy sértő a kéréseket figyelmen kivül hagyjuk.',
            'email' => 'email',
        ],

        'reasons' => [
            'compromised' => 'A fiókod veszélyeztetettnek tekinthető. Idéglenesen lehet nem lesz elérhető, addig amíg a valódi személyazonosság megerősítésre nem kerül.',
            'opening' => 'Számtalan indok van, amiért a fiókod tiltva lett:',

            'tos' => [
                '_' => 'Megszegtél egy vagy több szabályt az előírásainkból :community_rules vagy :tos.',
                'community_rules' => 'közösségi szabályok',
                'tos' => 'felhasználási feltételek',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Felhasználók játékmód szerint',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "A fiókod hosszú ideje nem volt használva.",
        ],
    ],

    'login' => [
        '_' => 'Bejelentkezés',
        'button' => 'Bejelentkezés',
        'button_posting' => 'Bejelentkezés...',
        'email_login_disabled' => 'Az email-el való belépés jelenleg le van tiltva. Kérlek használd a felhasználó neved helyette.',
        'failed' => 'Hibás adatok',
        'forgot' => 'Elfelejtetted a jelszavad?',
        'info' => 'Jelentkezz be a folytatáshoz',
        'invalid_captcha' => 'Túl sok sikertelen belépési kísérlet, kérlek töltsd ki a captcha-t és próbáld újra. (Ha a captcha nem látszik, frissítsd az oldalt)',
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
        'previous_usernames' => 'korábbi nevén',
        'plays_with' => 'Ezekkel játszik: :devices',
        'title' => ":username profilja",

        'comments_count' => [
            '_' => ':link posztolva',
            'count' => ':count_delimited komment|:count_delimited komment',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Profil Borító Változtatása',
                'defaults_info' => 'További borító lehetőségek a jövőben lesznek elérhetőek',
                'upload' => [
                    'broken_file' => 'Kép feldolgozása sikertelen. Ellenőrizd a feltöltött képet és próbáld meg újra.',
                    'button' => 'Kép feltöltése',
                    'dropzone' => 'Húzd ide a feltöltendő fájlokat',
                    'dropzone_info' => 'Feltöltéshez ide is dobhatod a képed',
                    'size_info' => 'A borítónak 2400x620-asnak kellene lennie',
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
                'pending' => [
                    'title' => '',
                ],
                'ranked' => [
                    'title' => '',
                ],
            ],
            'discussions' => [
                'title' => 'Hozzászólások',
                'title_longer' => 'Legújabb beszélgetések',
                'show_more' => 'további beszélgetések mutatása',
            ],
            'events' => [
                'title' => 'Események',
                'title_longer' => 'Legutóbbi Események',
                'show_more' => 'további események',
            ],
            'historical' => [
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
                    '_' => 'Annak alapján, hogy a felhasználó milyen mértékben járult hozzá egy beatmap moderálásához. További információkért kattints a linkre. :link.',
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
                'not_ranked' => 'Kizárólag rangsorolt beatmap adhat pp-t.',
                'pp_weight' => 'súlyozott :percentage',
                'view_details' => 'Részletek mutatása',
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
                'vote_count' => ':count_delimited  szavazás:count_delimited szavazatok',
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
            'location' => 'Tartózkodási hely',
            'occupation' => 'Foglalkozás',
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
                '_' => 'Ennek a szolgáltatásnak a feloldásához egy linknek kell lennie. :link.',
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
            'graveyard_beatmapset_count' => 'Eltemetett beatmapek',
            'loved_beatmapset_count' => 'Kedvelt beatmapek',
            'pending_beatmapset_count' => '',
            'ranked_beatmapset_count' => '',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Jelenleg el vagy némítva.',
        'message' => 'Egyes műveletek lehet, hogy nem érhetők el.',
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
        'brick' => 'Tégla nézet',
        'card' => 'Kártya nézet',
        'list' => 'Lista nézet',
    ],
];
