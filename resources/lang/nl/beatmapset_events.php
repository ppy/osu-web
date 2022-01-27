<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Goedgekeurd.',
        'beatmap_owner_change' => 'Eigenaar van moeilijkheid :beatmap veranderd naar :new_user.',
        'discussion_delete' => 'Moderator verwijderde discussie :discussion.',
        'discussion_lock' => 'Discussie voor deze beatmap is uitgeschakeld. (:text)',
        'discussion_post_delete' => 'Moderator verwijderde post van discussie :discussion.',
        'discussion_post_restore' => 'Moderator herstelde post van discussie :discussion.',
        'discussion_restore' => 'Moderator herstelde discussie :discussion.',
        'discussion_unlock' => 'Discussie voor deze beatmap is ingeschakeld.',
        'disqualify' => 'Gediskwalificeerd door :user. Reden: :discussion (:text).',
        'disqualify_legacy' => 'Gediskwalificeerd door :user. Reden: :text.',
        'genre_edit' => 'Genre veranderd van :old naar :new.',
        'issue_reopen' => 'Opgelost probleem :discussion door :discussion_user heropend door :user.',
        'issue_resolve' => 'Probleem :discussion door :discussion_user gemarkeerd als opgelost door :user.',
        'kudosu_allow' => 'Kudosu ontkenning voor discussie :discussion is verwijderd.',
        'kudosu_deny' => 'Discussie :discussion geweigerd voor kudosu.',
        'kudosu_gain' => 'Discussie :discussion door :user heeft genoeg stemmen ontvangen voor kudosu.',
        'kudosu_lost' => 'Discussie :discussion door :user heeft stemmen verloren en kudosu is verwijderd.',
        'kudosu_recalculate' => 'Discussie :discussion heeft de kudosu toekenningen laten herberekenen.',
        'language_edit' => 'Taal veranderd van :old naar :new.',
        'love' => 'Geloved door :user',
        'nominate' => 'Genomineerd door :user.',
        'nominate_modes' => 'Genomineerd door :user (:modes).',
        'nomination_reset' => 'Nieuw probleem: discussie (: tekst) veroorzaakte een nominatie reset.',
        'nomination_reset_received' => 'Nominatie door :user werd gereset door :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominatie werd gereset door :user (:text)',
        'qualify' => 'Deze beatmap heeft het benodigde aantal nominaties bereikt en is nu gekwalificeerd.',
        'rank' => 'Ranked.',
        'remove_from_loved' => 'Verwijderd uit Loved door :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Expliciete beoordeling verwijderd',
            'to_1' => 'Gemarkeerd als expliciet',
        ],
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
        'beatmap_owner_change' => 'Moeilijkheidsgraad eigenaar veranderen',
        'discussion_delete' => 'Discussie verwijdering',
        'discussion_post_delete' => 'Discussie antwoord verwijdering',
        'discussion_post_restore' => 'Discussie antwoord herstelling',
        'discussion_restore' => 'Discussie herstelling',
        'disqualify' => 'Diskwalificatie',
        'genre_edit' => 'Genre bewerken',
        'issue_reopen' => 'Discussie heropening',
        'issue_resolve' => 'Discussie oplossen',
        'kudosu_allow' => 'Kudosu toelaatbaarheid',
        'kudosu_deny' => 'Kudosu weigering',
        'kudosu_gain' => 'Kudosu verzamelen',
        'kudosu_lost' => 'Kudosu verlies',
        'kudosu_recalculate' => 'Kudosu herberekening',
        'language_edit' => 'Taal bewerken',
        'love' => 'Liefde',
        'nominate' => 'Nominatie',
        'nomination_reset' => 'Nominatie opnieuw instellen',
        'nomination_reset_received' => 'Nominatie reset ontvangen',
        'nsfw_toggle' => 'Expliciete markering',
        'qualify' => 'Kwalificatie',
        'rank' => 'Postitionering',
        'remove_from_loved' => 'Loved verwijdering',
    ],
];
