<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Wat dacht je anders van osu! ?',
    'require_login' => 'Log in om verder te gaan.',
    'require_verification' => 'Gelieve te verifiëren om verder te gaan.',
    'restricted' => "Je kan dit niet doen terwijl je restricted bent.",
    'silenced' => "Je kunt dit niet doen terwijl je silenced bent.",
    'unauthorized' => 'Toegang geweigerd.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Hyping kan niet ongedaan gemaakt worden.',
            'has_reply' => 'Je kan geen discussie met reacties verwijderen',
        ],
        'nominate' => [
            'exhausted' => 'Je hebt je dagelijkse nominatie-limiet bereikt, probeer het morgen opnieuw.',
            'incorrect_state' => 'Fout tijdens het uitvoeren van deze actie, probeer de pagina te herladen.',
            'owner' => "Je kan je eigen beatmap niet nomineren.",
            'set_metadata' => 'Je moet eerst het genre en de taal instellen voor je de nominatie invoert.',
        ],
        'resolve' => [
            'not_owner' => 'Alleen de eigenaar van de thread of de eigenaar van de beatmap kan een discussie als opgelost markeren.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Alleen de eigenaar van deze beatmap of een nominator/QAT groepslid kan mapper notities posten.',
        ],

        'vote' => [
            'bot' => "Kan niet stemmen op discussie gemaakt door bot",
            'limit_exceeded' => 'Wacht even voor je meer stemmen indient',
            'owner' => "Je kan niet stemmen op je eigen discussie.",
            'wrong_beatmapset_state' => 'Je kan alleen stemmen op discussies van beatmaps die in afwachting zijn.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'U kunt alleen uw eigen berichten verwijderen.',
            'resolved' => 'U kunt een bericht van een opgeloste discussie niet verwijderen.',
            'system_generated' => 'Automatisch gegenereerd bericht kan niet worden verwijderd.',
        ],

        'edit' => [
            'not_owner' => 'Alleen de eigenaar kan deze post bewerken.',
            'resolved' => 'U kunt geen bericht van een opgeloste discussie bewerken.',
            'system_generated' => 'Automatisch gegenereerde posts kunnen niet worden bewerkt.',
        ],

        'store' => [
            'beatmapset_locked' => 'Deze beatmap is vergrendeld voor discussie.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'U kunt metagegevens van een nominale kaart niet wijzigen. Neem contact op met een BN of NAT lid als u denkt dat deze onjuist is ingesteld.',
        ],
    ],

    'chat' => [
        'annnonce_only' => 'Dit kanaal is enkel voor aankondigingen bestemd.',
        'blocked' => 'Kan geen bericht versturen naar een gebruiker die jou blokkeert of die jij geblokkeerd hebt.',
        'friends_only' => 'Gebruiker blokkeert berichten van mensen die niet op de vriendenlijst staan.',
        'moderated' => 'Dat kanaal wordt op dit moment gemodereerd.',
        'no_access' => 'Je hebt geen toegang tot dat kanaal.',
        'receive_friends_only' => 'Het is mogelijk dat de gebruiker niet zal kunnen antwoorden omdat je enkel berichten van mensen op je vriendenlijst aanvaardt.',
        'restricted' => 'Je kunt geen berichten versturen wanneer je het zwijgen is opgelegd, wanneer je bent beperkt of verbannen.',
        'silenced' => 'Je kunt geen berichten verzenden als je op stil staat, bent beperkt of bent verbannen.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Je kunt geen verwijderde berichten bewerken.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Je kan je stem niet meer veranderen nadat de stemperiode van deze wedstrijd is afgelopen.',

        'entry' => [
            'limit_reached' => 'Je hebt de limiet voor inschrijvingen bereikt',
            'over' => 'Bedankt voor de inzendingen! Inzendingen zijn gesloten voor deze wedstrijd en de stembus gaan binnenkort open.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Geen rechten om dit forum de modereren.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Alleen de laatste post kan worden verwijderd.',
                'locked' => 'Je kan geen posts in een gesloten onderwerp verwijderen.',
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'not_owner' => 'Alleen de eigenaar kan deze post verwijderen.',
            ],

            'edit' => [
                'deleted' => 'Je kan een verwijderde post niet bewerken.',
                'locked' => 'De post is afgesloten voor bewerkingen.',
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'not_owner' => 'Alleen de eigenaar kan de post bewerken.',
                'topic_locked' => 'Kan geen post in een gesloten onderwerp bewerken.',
            ],

            'store' => [
                'play_more' => 'Probeer eerst de game te spelen voor je op de forums post! Als je een probleem hebt met te spelen, post dan alstublieft in de Help en Support forum.',
                'too_many_help_posts' => "Je moet eerst de game spelen voor je extra posts kan maken. Als je nog steeds problemen ondervindt, e-mail dan support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Bewerk je laatste bericht in plaats van opnieuw te posten.',
                'locked' => 'Je kunt niet antwoorden op een gesloten onderwerp.',
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'no_permission' => 'Geen toestemming om te antwoorden.',

                'user' => [
                    'require_login' => 'Log in om te antwoorden.',
                    'restricted' => "Je kan niet reageren terwijl je gerestricteerd bent.",
                    'silenced' => "Je kan niet antwoorden wanneer je gesilenced bent.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'no_permission' => 'Geen toestemming om een topic te starten.',
                'forum_closed' => 'Forum is gesloten en kan niet in gepost worden.',
            ],

            'vote' => [
                'no_forum_access' => 'Toegang tot deze forum is nodig.',
                'over' => 'De stemperiode is voorbij en er kan niet meer gestemd worden.',
                'play_more' => 'Je moet meer spelen voordat je kan stemmen op het forum.',
                'voted' => 'Je stem veranderen is niet toegestaan.',

                'user' => [
                    'require_login' => 'Log in om te stemmen.',
                    'restricted' => "Je kan niet stemmen als je gerestricteerd bent.",
                    'silenced' => "Je kan niet stemmen wanneer je gesilenced bent.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Toegang tot deze forum is nodig.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Foutieve cover gespecificeerd.',
                'not_owner' => 'Alleen de eigenaar kan de cover bewerken.',
            ],
            'store' => [
                'forum_not_allowed' => 'Dit forum accepteert geen topic covers.',
            ],
        ],

        'view' => [
            'admin_only' => 'Alleen admins kunnen dit forum zien.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => 'Enkel de eigenaar van de score kan deze vastzetten.',
            'too_many' => 'Te veel scores vastgezet.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Gebruikerspagina is gesloten.',
                'not_owner' => 'Je kan alleen je eigen gebruikerspagina bewerken.',
                'require_supporter_tag' => 'osu!supporter tag is vereist.',
            ],
        ],
    ],
];
