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
    'beatmapset_update_notice' => [
        'new' => 'Der har været en ny opdatering på beatmap ":title" siden dit sidste besøg.',
        'subject' => 'Ny opdatering for beatmap ":title"',
        'unwatch' => 'Hvis du ikke længere ønsker at følge denne beatmap kan du enten klikke på "Unwatch" linket fundet på ovenstående side, eller fra modding følgesiden:',
        'visit' => 'Besøg diskussions-siden her:',
    ],

    'common' => [
        'closing' => 'Mvh,',
        'hello' => 'Hej :user,',
        'report' => 'Svar venligst på denne mail MED DET SAMME hvis du ikke anmodede om denne ændring.',
    ],

    'forum_new_reply' => [
        'new' => 'Der har været et nyt svar i ":title" siden dit sidste besøg.',
        'subject' => '[osu!] Nyt svar for emne ":title"',
        'unwatch' => 'Hvis du ikke længere ønsker at følge dette emne kan du enten klikke på "Følg ikke emne" linket fundet nederst på ovenstående emner, eller fra emne følgesiden:',
        'visit' => 'Hop direkte til det seneste svar ved at bruge det følgende link:',
    ],

    'password_reset' => [
        'code' => 'Din bekræftelseskode er:',
        'requested' => 'Enten dig eller nogen som lader til at være dig har anmodet om adgang til et nyt kodeord på din osu! account.',
        'subject' => 'osu! konto genoprettelse',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'Vi har modtaget din betaling og er i gang med at klargøre din ordre til shipping. Det kan tage et par dage for os at sende den afsted afhængigt af mængden af ordrer. Du kan følge processen her, inklusiv tracking detaljer hvor det er tilgængeligt:',
        'processing' => 'Vi har modtaget din betaling og er i gang med at behandle din ordre. Du kan følge processen her:',
        'questions' => "Hvis du har nogen spørgsmål så tøv ikke med at svare på denne mail.",
        'shipping' => 'Forsendelse',
        'subject' => 'Vi har modtaget din osu!store bestilling!',
        'thank_you' => 'Tak for din osu!store ordre!',
        'total' => 'I alt',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'Personen som har givet dig dette tag kan vælge at forblive anonym, så de er ikke blevet nævnt i denne notifikation.',
        'anonymous_gift_maybe_not' => 'Men du ved sikkert allerede hvem det er ;).',
        'duration' => 'Takket være dem har du nu adgang til osu!direct og andre osu!supporter goder i de næste :duration.',
        'features' => 'Du kan finde flere detaljer omkring disse goder her:',
        'gifted' => 'Nogen har givet dig et osu!supporter tag!',
        'subject' => 'Du er blevet givet et osu!supporter tag!',
    ],

    'user_email_updated' => [
        'changed_to' => 'Dette er en bekræftelses-mail for at informere dig om at din osu! mail-adresse er blevet ændret til: ":email".',
        'check' => 'Sikr dig venligst at du modtog denne mail ved din nye addresse for at forhindre at du mister adgangen til din osu! account i fremtiden.',
        'sent' => 'Af sikkerhedsgrunde blev denne mail sendt til både din nye og gamle mail-addresse.',
        'subject' => 'Bekræftelse for opdatering af osu! email-adresse',
    ],

    'user_force_reactivation' => [
        'main' => 'Din account er formodet at være blevet infiltreret, har nylig mistænksom aktivitet eller et MEGET svagt kodeord. Som et resultat af dette, har vi brug for at du sætter et nyt kodeord. Sikr dig venligst at du vælger et stærk kodeord.',
        'perform_reset' => 'Du kan udføre nulstillingen fra :url',
        'reason' => 'Begrundelse:',
        'subject' => 'osu! Account Genaktivering Påkrævet',
    ],

    'user_password_updated' => [
        'confirmation' => 'Dette er en bekræftekse på, at din osu! adgangskode er blevet ændret.',
        'subject' => 'Bekræftelse for opdatering af osu! adgangskode',
    ],

    'user_verification' => [
        'code' => 'Din bekræftelseskode er:',
        'code_hint' => 'Du kan indtaste din kode med eller uden mellemrum.',
        'link' => 'Alternativt kan du også besøge dette link for at færdiggøre verifikationen:',
        'report' => 'Hvis du ikke anmodede om dette bedes du venligst svare på denne mail MED DET SAMME da din account kan være i fare.',
        'subject' => 'osu! kontobekræftelse',

        'action_from' => [
            '_' => 'En handling udført på din account fra :country behøver verifikation.',
            'unknown_country' => 'ukendt land',
        ],
    ],
];
