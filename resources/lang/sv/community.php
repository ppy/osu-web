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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Älskar du osu!?<br/>
                                Stöd utvecklingen av osu! :D',
            'small_description' => '',
            'support_button' => 'Jag vill stötta osu!',
        ],

        'dev_quote' => 'osu! är ett helt gratis-att-spela spel, men att underhålla det är verkligen inte gratis. Mellan kostanden av att betala servrar och internationell bandbredd av hög kvalité, tid som spenderas av att underhålla systemet och gemenskapen, ge priser till tävlingar, svara på support frågor och allmänt hålla personer glada, så konsumerar osu! ganska mycket pengar! Och, glöm inte att vi gör det utan någon annonsering eller partnerskap med löjliga annonseringsfält och gillamarkeringar!
            <br/><br/>i slutet av dan så underhålls osu! mest av mig själv, ni kanske känner igen mig bäst som "peppy".
            Jag var tvungen att säga upp mig från mitt dag jobb för att hinna med osu!,
            och ibland så har jag svårt att upprätthålla standarderna jag strävar efter.
            Jag skulle vilja ge ett personligt tack till dem som har stöttat osu! än så länge,
            och lika mycket till dem som fortsätter att stötta detta fantastiska spel och gemenskapen in i framtiden :).',

        'supporter_status' => [
            'contribution' => 'Tack för ditt stöd! Än så länge har du bidragit med :dollars spritt över :tags tag-köp!',
            'gifted' => ':giftedTags av dina tag-köp har getts bort som gåvor (till värdet av :giftedDollars), så generöst!',
            'not_yet' => "Du har inte en supporter-tag än :(",
            'title' => 'Nuvarande supporter-status',
            'valid_until' => 'Din nuvarande supporter-tag är giltig tills :date!',
            'was_valid_until' => 'Din supporter-tag var giltig till :date.',
        ],

        'why_support' => [
            'title' => 'Varför ska jag stötta osu!?',
            'blocks' => [
                'dev' => 'Utvecklas och underhålls mest av en kille i Australien',
                'time' => 'Tar upp så mycket tid att hålla igång så det är inte möjligt att kalla det för en "hobby" längre',
                'ads' => 'Inga annonser någonstans. <br/><br/>
                        Till skillnad från 99.95%, så tjänar vi inte på att trycka upp saker i ditt ansikte.',
                'goodies' => 'Du kommer få några extra godsaker!',
            ],
        ],

        'perks' => [
            'title' => 'Oh? Vad får jag?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'snabb och enkel tillgång till att söka beatmaps utan att lämna spelet.',
            ],

            'auto_downloads' => [
                'title' => 'Automatiska Nedladdningar',
                'description' => 'Automatiska nedladdningar när du spelar multiplayer, åskådar andra, eller klickar på länkar i chatten!',
            ],

            'upload_more' => [
                'title' => 'Ladda upp mer',
                'description' => 'Fler antal avvaktning beatmap platser (per rankad beatmap) upp till 10 stycken.',
            ],

            'early_access' => [
                'title' => 'Tidig tillgång',
                'description' => 'Tillgång till tidiga utgåvor, där du kan pröva nya funktioner innan dem kommer ut för alla!',
            ],

            'customisation' => [
                'title' => 'Anpassning',
                'description' => 'Anpassa din profil genom att lägga till en full anpassningsbar användar sida',
            ],

            'beatmap_filters' => [
                'title' => 'Beatmap Filters',
                'description' => 'Filtrera beatmap sökningar på spelade och ej spelade maps och rank uppnåd (om det finns).',
            ],

            'yellow_fellow' => [
                'title' => 'Gul Typ',
                'description' => 'Bli igenkänd i spelet med din nya ljusa gula chat användarnamn färg.',
            ],

            'speedy_downloads' => [
                'title' => 'Snabbare nedladdningar',
                'description' => 'Mindre nedladdnings restriktioner, speciellt när du använder osu!direct.',
            ],

            'change_username' => [
                'title' => 'Ändra användarnamn',
                'description' => 'Möjligheten att ändra ditt användarnamn utan extra konstad. (endast en gång)',
            ],

            'skinnables' => [
                'title' => 'Pynt',
                'description' => 'Extra pynt i spelet, som till exempel huvudmeny bakrund.',
            ],

            'feature_votes' => [
                'title' => 'Funktion Röster',
                'description' => 'Rösta på funktion efterfrågan. (2 gånger per månad)',
            ],

            'sort_options' => [
                'title' => 'Sortering Inställningar',
                'description' => 'Möjligheten att visa beatmap land / vän / mod-specifika rankningar i spelet.',
            ],

            'feel_special' => [
                'title' => 'Känna Sig Speciell',
                'description' => 'Den varma och goda känslan av att du hjälper osu! att hållas igång!',
            ],

            'more_to_come' => [
                'title' => 'Och mer kommer',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Jag är övertygad! :D',
            'support' => 'stötta osu!',
            'gift' => 'eller ge support till en annan spelare i present',
            'instructions' => 'klicka på hjärtat för att gå till osu!store',
        ],
    ],
];
