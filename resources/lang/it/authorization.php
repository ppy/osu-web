<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'nominate' => [
            'exhausted' => 'Hai raggiunto il limite di nominazioni per questa giornata, per favore riprova domani.',
        ],
        'resolve' => [
            'general_discussion' => 'Le discussioni generali non possono essere risolte.',
            'not_owner' => 'Solo l\'autore del topic e il creatore della mappa possono rispolvere una discussione.',
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
                'locked' => 'Il post è bloccato dall\'effettuare modifiche.',
                'no_forum_access' => 'È richiesto l\'accesso al forum.',
                'not_owner' => 'Solo l\'autore del post lo può modificare.',
                'topic_locked' => 'Non puoi modificare i post di un topic bloccato.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Hai appena postato. Aspetta un po\' o modifica il tuo ultimo post.',
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
                'over' => 'Il sondaggio è finito e non puoi votare.',
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
                'require_supporter_tag' => 'È neccessario avere il supporter.',
            ],
        ],
    ],
];
