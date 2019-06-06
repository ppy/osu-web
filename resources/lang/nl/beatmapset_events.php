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
    'event' => [
        'approve' => 'Goedgekeurd.',
        'discussion_delete' => 'Moderator verwijderde discussie :discussion.',
        'discussion_lock' => 'Discussie voor deze beatmap is uitgeschakeld. (:text)',
        'discussion_post_delete' => 'Moderator verwijderde post van discussie :discussion.',
        'discussion_post_restore' => 'Moderator herstelde post van discussie :discussion.',
        'discussion_restore' => 'Moderator herstelde discussie :discussion.',
        'discussion_unlock' => 'Discussie voor deze beatmap is ingeschakeld.',
        'disqualify' => 'Gediskwalificeerd door :user. Reden: :discussion (:text).',
        'disqualify_legacy' => 'Gediskwalificeerd door :user. Reden: :text.',
        'issue_reopen' => 'Probleem opgelost :discussie heropend.',
        'issue_resolve' => 'Probleem: discussie gemarkeerd als opgelost.',
        'kudosu_allow' => 'Kudosu ontkenning voor discussie: discussie is verwijderd.',
        'kudosu_deny' => 'Discussie: discussie geweigerd voor kudosu.',
        'kudosu_gain' => 'Discussie: discussie door: gebruiker heeft genoeg stemmen ontvangen voor kudosu.',
        'kudosu_lost' => 'Discussie: discussie door: gebruiker heeft stemmen verloren en kudosu is verwijderd.',
        'kudosu_recalculate' => 'Discussie: discussie heeft de kudosu toekenningen laten herberekenen.',
        'love' => 'Geloved door :user',
        'nominate' => 'Genomineerd door :user.',
        'nomination_reset' => 'Nieuw probleem: discussie (: tekst) veroorzaakte een nominatie reset.',
        'qualify' => 'Deze beatmap heeft het benodigde aantal nominaties bereikt en is nu gekwalificeerd.',
        'rank' => 'Ranked.',
    ],

    'index' => [
        'title' => 'Beatmapset Gebeurtenissen',

        'form' => [
            'period' => 'Periode',
            'types' => 'Types',
        ],
    ],

    'item' => [
        'content' => 'Inhoud',
        'discussion_deleted' => '[verwijderd]',
        'type' => 'Type',
    ],

    'type' => [
        'approve' => 'Goedkeuring',
        'discussion_delete' => 'Discussie verwijdering',
        'discussion_post_delete' => 'Discussie antwoord verwijdering',
        'discussion_post_restore' => 'Discussie antwoord herstelling',
        'discussion_restore' => 'Discussie herstelling',
        'disqualify' => 'Diskwalificatie',
        'issue_reopen' => 'Discussie heropening',
        'issue_resolve' => 'Discussie oplossen',
        'kudosu_allow' => 'Kudosu toelaatbaarheid',
        'kudosu_deny' => 'Kudosu weigering',
        'kudosu_gain' => 'Kudosu verzamelen',
        'kudosu_lost' => 'Kudosu verlies',
        'kudosu_recalculate' => 'Kudosu herberekening',
        'love' => 'Liefde',
        'nominate' => 'Nominatie',
        'nomination_reset' => 'Nominatie opnieuw instellen',
        'qualify' => 'Kwalificatie',
        'rank' => 'Postitionering',
    ],
];
