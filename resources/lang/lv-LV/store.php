<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Pirkuma norēķināšanās ',
        'empty_cart' => 'Noņemt visas preces no groza',
        'info' => ':count_delimited prece grozā ($:subtotal)|:count_delimited prece grozā ($:subtotal)',
        'more_goodies' => 'Es gribu apskatīt vairāk labumiņus pirms es pabeikšu savu pasūtījumu',
        'shipping_fees' => 'piegādes maksas',
        'title' => 'Iepirkumu grozs',
        'total' => 'kopā',

        'errors_no_checkout' => [
            'line_1' => 'Ak nē, ar tavu grozu iznāca upsie, neatļaujot norēķināšanos!',
            'line_2' => 'Noņem vai atjauno redzamos iepirkumus lai turpinātu.',
        ],

        'empty' => [
            'text' => 'Jūsu grozs ir tukšs.',
            'return_link' => [
                '_' => 'Atgriezties uz :link lai atrastu dažus labumiņus!',
                'link_text' => 'veikala skatlogs',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ak nē, ir izveidojušās problēmas ar tavu grozu!',
        'cart_problems_edit' => 'Uzspied šeit lai to rediģētu',
        'declined' => 'Apmaksa tika atcelta.',
        'delayed_shipping' => 'Mēs pašlaik esam pārslogoi ar pasūtījumiem! Tu droši vari izpildīt savu pasūtījumu, bet vari sagaidīt **papildus 1-2 nedēļu aizkavi** kamēr mēs pierausimies esošajiem pasūtījumiem.',
        'hide_from_activity' => 'Slēpt visus osu!supporter tagus šajā pasūtījumā no manas aktivitātes',
        'old_cart' => 'Izskatās ka tavs grozs ir pārāk vecs, un tas tika pārlādēts, lūdzu mēģini atkal.',
        'pay' => 'Norēķināties ar PayPal',
        'title_compact' => 'norēķināšanās',

        'has_pending' => [
            '_' => 'Tev ir nepabeigtas norēķināšanās, uzspied :link, lai tās apskatītu.',
            'link_text' => 'šeit',
        ],

        'pending_checkout' => [
            'line_1' => 'Iepirekš izveidota norēķināšanās tika izveidota, bet nepabeigta.',
            'line_2' => 'Turpini savu norēķināšanos, izvēloties maksājuma veidu.',
        ],
    ],

    'discount' => 'atlaide :percent %',
    'free' => 'par brīvu!',

    'invoice' => [
        'contact' => 'Sazinies:',
        'date' => 'Datums:',
        'echeck_delay' => 'Tā kā jūsu samakasa bija e-samaksa, lūdzu pagaidīt līdz 10 papildus dienām, lai samaksa izietu cauri PayPal!',
        'echeck_denied' => 'PayPal noraidīja eČeka maksājumu.',
        'hide_from_activity' => 'osu!supporter tagi šajā pasūtījumā netiek rādīti jūsu nesenajās aktivitātēs.',
        'sent_via' => 'Aizsūtīt Caur:',
        'shipping_to' => 'Aizsūtīt Uz:',
        'title' => 'Rēķins',
        'title_compact' => 'rēķins',

        'status' => [
            'cancelled' => [
                'title' => 'Jūsu pasūtījums ir atcelts ',
                'line_1' => [
                    '_' => "Ja tu nepieprasīji atcelšanu, lūdzu sazināties ar :link citējot savu pasūtIjuma nummuru (#:order_number).",
                    'link_text' => 'osu!veikala atbalsts',
                ],
            ],
            'delivered' => [
                'title' => 'Tavs pasūtījums tika piegādāts! Mēc ceram, ka tu to izbaudi!',
                'line_1' => [
                    '_' => 'Ja tev ir jebkādas problēmas ar savu pasūtījmu, lūdzam sazināties ar :link.',
                    'link_text' => 'osu!veikala atbalsts',
                ],
            ],
            'prepared' => [
                'title' => 'Jūsu pasūtījums tiek sagatavots!',
                'line_1' => 'Lūdzu, uzgaidi nedaudz ilgāk, līdz tas tiks nosūtīts. Izsekošanas informācija šeit tiks parādīta pēc pasūtījuma apstrādes un nosūtīšanas. Tas var ilgt pat 5 dienas (bet parasti mazāk!) atkarībā no tā, cik esam aizņemti.',
                'line_2' => 'Mēs sūtām visus pasūtījumus no Japānas, izmantojot dažādus kuģošanas pakalpojumus atkarībā no svara un vērtības. Kad pasūtījums būs nosūtīts, šis apgabals tiks atjaunināts ar informāciju.',
            ],
            'processing' => [
                'title' => 'Tava apmaksa vēl nav tikusi apstiprināta!',
                'line_1' => 'Ja tu jau esi samaksājis, iespējams, joprojām gaidām tava maksājuma apstiprinājumu. Lūdzu, atsvaidziniet šo lapu pēc vienas vai vairākām minūtēm!',
                'line_2' => [
                    '_' => 'Ja tu sastapies ar problēmu, kamēr norēķinājies, :link',
                    'link_text' => 'uzspiest šeit lai turpinātu norēķināšanos',
                ],
            ],
            'shipped' => [
                'title' => 'Tavs pasūtījums ir piegādāts!',
                'tracking_details' => 'Izsekošanas saturs seko:',
                'no_tracking_details' => [
                    '_' => "Mums nav detalizēta informācija par izsekošanu, jo nosūtijām tavu pasūtījumu, izmantojot Air Mail, bet tu vari cerēt sagaidīt to 1-3 nedēļu laikā. Eiropai, Europas muita var dažkārtr aizkavēt pasūtījumu ārpus no mūsu kontroles. Ja rodas kādas bažas, lūdzu atbildi pasūtījuma apstiprinājuma e-pastam, kuru tu saņēmi (vai :link).",
                    'link_text' => 'atsūti mums e-pastu',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Atcelt Pasūtījumu',
        'cancel_confirm' => 'Šo pasūtījumu atcels un samaksa netiks pieņemta par to. Samaksas apgādātājs iespējams neatgriezīs naudu uzreiz. Vai tu esi drošs?',
        'cancel_not_allowed' => 'Šo pasūtījumu pašlaik nevar atcelt.',
        'invoice' => 'Apskatīt Čeku',
        'no_orders' => 'Nav redzamu pasūtījumu.',
        'paid_on' => 'Pasūtījums apstiprināts :date',
        'resume' => 'Turpināt Norēķināšanos',
        'shipping_and_handling' => 'Transportēšana & Apstrāde',
        'shopify_expired' => 'Šī pasūtījuma norēķināšanās saitei ir beidzies derīguma termiņš.',
        'subtotal' => 'Starpsumma',
        'total' => 'Kopā',

        'details' => [
            'order_number' => 'Pasūtījums #',
            'payment_terms' => 'Samaksas Nosacījumi',
            'salesperson' => 'Pārdevējs',
            'shipping_method' => 'Piegādes Veids',
            'shipping_terms' => 'Piegādes Nosacījumi',
            'title' => 'Pasūtījuma Detaļas',
        ],

        'item' => [
            'quantity' => 'daudzums',

            'display_name' => [
                'supporter_tag' => ':name priekš :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Ziņa: :message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Tu nevari modificēt savu pasūtījumu, kamēr tas tiek atcelts.',
            'checkout' => 'Tu nevari modificēt savu pasūtījumu, kamēr tas tiek apstrādāts.', // checkout and processing should have the same message.
            'default' => 'Pasūtījums nav izmaināms',
            'delivered' => 'Tu nevari modificēt savu pasūtījumu, jo tas jau tika piegādāts.',
            'paid' => 'Tu nevari modificēt savu pasūtījumu, jo par to jau tika samaksāts.',
            'processing' => 'Tu nevari modificēt savu pasūtījumu, kamēr tas tiek apstrādāts.',
            'shipped' => 'Tu nevari izmainīt savu pasūtījumu, jo tas jau tika piegādāts.',
        ],

        'status' => [
            'cancelled' => 'Atcelts',
            'checkout' => 'Sagatavošana',
            'delivered' => 'Piegādāts',
            'paid' => 'Samaksāts',
            'processing' => 'Gaida apstiprinājumu',
            'shipped' => 'Izsūtīts',
            'title' => 'Pasūtījuma Statuss',
        ],

        'thanks' => [
            'title' => 'Paldies par pirkumu!',
            'line_1' => [
                '_' => 'Tu saņemsi apstiprinājuma e-pastu drīz. Ja tev ir vēl kādi jautāumi, lūdzu :link!',
                'link_text' => 'sazinies ar mums',
            ],
        ],
    ],

    'product' => [
        'name' => 'Vārds',

        'stock' => [
            'out' => 'Šis produkts pašlaik nav pieejams. Pārbaudi vēlāk!',
            'out_with_alternative' => 'Diemžēl šis produkts nav noliktavā. Izmanto apakšu lai izvēlētos citu tipu vai pārbaudi vēlāk!',
        ],

        'add_to_cart' => 'Pievienot grozam',
        'notify' => 'Paziņot man, kad pieejams!',
        'out_of_stock' => '',

        'notification_success' => 'tev paziņos, kad mums būs jauns krājums. uzspied :link lai atceltu',
        'notification_remove_text' => 'šeit',

        'notification_in_stock' => 'Šis produkts jau ir pieejams!',
    ],

    'supporter_tag' => [
        'gift' => 'uzdāvināt spēlētājam',
        'gift_message' => 'pēc izvēles pievienot ziņu savai dāvanai! (līdz :length rakstzīmēm)',

        'require_login' => [
            '_' => 'Jums ir nepieciešams būt :link, lai iegūtu osu!supporter!',
            'link_text' => 'pierakstījies',
        ],
    ],

    'username_change' => [
        'check' => 'Ievadi lietotājvārdu lai redzētu tā pieejamību!',
        'checking' => 'Pārbauda :username pieejamību...',
        'placeholder' => 'Pieprasītais Lietotājvārds',
        'label' => 'Jauns Lietotājvārds',
        'current' => 'Tavs pašreizējais lietotājvārds ir ":username".',

        'require_login' => [
            '_' => 'Tev vajag būt :link, lai nomainītu savu vārdu!',
            'link_text' => 'pierakstījies',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
