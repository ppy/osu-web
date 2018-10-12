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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Non è possibile annullare l\'hyping.',
            'has_reply' => 'Impossibile eliminare una discussione con risposte',
        ],
        'nominate' => [
            'exhausted' => 'Hai raggiunto il limite di nominazioni per questa giornata, per favore riprova domani.',
            'incorrect_state' => 'Errore nel eseguire l\'azione, prova a ricaricare la pagina.',
            'owner' => "Non puoi nominare la tua beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Solo l\'autore del topic e il creatore della mappa possono rispolvere una discussione.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Solo il creatore della beatmap, i nominatori e membri del QAT possono postare note.',
        ],

        'vote' => [
            'limit_exceeded' => 'Per favore attendi un po\' prima di esprimere altri voti',
            'owner' => "Impossibile votare la propria discussione.",
            'wrong_beatmapset_state' => 'Possibile votare solo su discussioni di mappe in attesa.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'I post automaticamente generati non possono essere modificati.',
            'not_owner' => 'Solo l\'autore del post può editarlo.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'L\'accesso al canale richiesto non è permesso.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'È richiesto l\'accesso al canale di destinazione.',
                    'moderated' => 'Il canale è momentaneamente moderato.',
                    'not_lazer' => 'Puoi parlare solo in #lazer al momento.',
                ],

                'not_allowed' => 'Non puoi inviare un messaggio mentre sei bannato/ristretto/silenziato.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Non puoi cambiare il tuo voto quando il periodo di votazione per questo contest è finito.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Solo l\'ultimo post può essere eliminato.',
                'locked' => 'Impossibile eliminare i post di un topic bloccato.',
                'no_forum_access' => 'È richiesto l\'accesso al forum.',
                'not_owner' => 'Solo l\'autore del post lo può eliminare.',
            ],

            'edit' => [
                'deleted' => 'Impossibile modificare un post cancellato.',
                'locked' => 'Il post è bloccato dall\'effettuare modifiche.',
                'no_forum_access' => 'È richiesto l\'accesso al forum.',
                'not_owner' => 'Solo l\'autore del post lo può modificare.',
                'topic_locked' => 'Non puoi modificare i post di un topic bloccato.',
            ],

            'store' => [
                'play_more' => 'Prova a giocare prima di postare nei forum, per favore! Se hai problemi a giocare, posta nel forum Aiuto e Supporto.',
                'too_many_help_posts' => "Devi giocare di più prima di poter fare ulteriori post. Se hai ancora problemi a giocare, invia un email a support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Modifica il tuo ultimo post invece di postare di nuovo.',
                'locked' => 'Non puoi rispondere ad un topic bloccato.',
                'no_forum_access' => 'È richiesto l\'accesso al forum.',
                'no_permission' => 'Non hai i permessi per rispondere.',

                'user' => [
                    'require_login' => 'Per favore effettua il login per rispondere.',
                    'restricted' => "Non è possibile rispondere mentre sei ristretto.",
                    'silenced' => "Non è possibile rispondere mentre sei silenziato.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'È richiesto l\'accesso al forum.',
                'no_permission' => 'Non hai i permessi per creare un nuovo topic.',
                'forum_closed' => 'Il forum è chiuso e non puoi postare nulla lì.',
            ],

            'vote' => [
                'no_forum_access' => 'È richiesto l\'accesso al forum.',
                'over' => 'Il sondaggio è finito e non puoi più votare.',
                'voted' => 'Non è permesso cambiare voti.',

                'user' => [
                    'require_login' => 'Per favore effettua il login per votare.',
                    'restricted' => "Non puoi votare mentre sei ristretto.",
                    'silenced' => "Non puoi votare mentre sei silenziato.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'È richiesto l\'accesso al forum.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'La cover specificata non è valida.',
                'not_owner' => 'Solo l\'autore può modificare la cover.',
            ],
        ],

        'view' => [
            'admin_only' => 'Solo gli amministratori possono vedere questo forum.',
        ],
    ],

    'require_login' => 'Per favore effettua il login per poter procedere.',

    'unauthorized' => 'Accesso Negato.',

    'silenced' => "Non puoi farlo mentre sei silenziato.",

    'restricted' => "Non puoi farlo mentre sei ristretto.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La pagina utente è bloccata.',
                'not_owner' => 'Puoi modificare solo la tua pagina utente.',
                'require_supporter_tag' => 'è necessario avere un tag supporter.',
            ],
        ],
    ],
];
