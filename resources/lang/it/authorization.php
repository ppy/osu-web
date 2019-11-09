<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Non è possibile annullare l\'hyping.',
            'has_reply' => 'Impossibile eliminare una discussione con risposte',
        ],
        'nominate' => [
            'exhausted' => 'Hai raggiunto il limite di nominazioni per questa giornata, per favore riprova domani.',
            'full_bn_required' => 'Devi essere un nominatore completo per eseguire questa nomina di qualifica.',
            'full_bn_required_hybrid' => 'Devi essere un nominatore completo per nominare dei set di beatmap con più di una modalità di gioco.',
            'incorrect_state' => 'Errore nell\'eseguire questa azione, prova a ricaricare la pagina.',
            'owner' => "Non puoi nominare la tua beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Solo l\'autore del topic e il creatore della mappa possono risolvere una discussione.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Solo il creatore della beatmap o un nominatore/membro del NAT possono postare note.',
        ],

        'vote' => [
            'limit_exceeded' => 'Per favore attendi un po\' prima di esprimere altri voti',
            'owner' => "Non puoi votare la tua discussione.",
            'wrong_beatmapset_state' => 'Puoi votare solo su discussioni di beatmap in sospeso.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Puoi eliminare solo i tuoi post.',
            'resolved' => 'Non puoi eliminare un post di una discussione risolta.',
            'system_generated' => 'Non si può eliminare un post generato automaticamente.',
        ],

        'edit' => [
            'not_owner' => 'Solo l\'autore del post può modificarlo.',
            'resolved' => 'Non puoi modificare un post di una discussione risolta.',
            'system_generated' => 'I post generati automaticamente non possono essere modificati.',
        ],

        'store' => [
            'beatmapset_locked' => 'Questa beatmap è bloccata per la discussione.',
        ],
    ],

    'chat' => [
        'blocked' => 'Non puoi inviare messaggi ad un utente che ti sta bloccando o che hai bloccato.',
        'friends_only' => 'L\'utente sta bloccando i messaggi da chi non è nella sua lista amici.',
        'moderated' => 'Quel canale è attualmente moderato.',
        'no_access' => 'Non hai accesso a quel canale.',
        'restricted' => 'Non puoi inviare messaggi mentre sei silenziato, limitato o bannato.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Non puoi modificare un post eliminato.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Non puoi cambiare il tuo voto quando il periodo di votazione per questo contest è finito.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Non sei autorizzato a moderare questo forum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Solo l\'ultimo post può essere eliminato.',
                'locked' => 'Non puoi eliminare i post di un topic bloccato.',
                'no_forum_access' => 'È necessario accedere al forum richiesto.',
                'not_owner' => 'Solo l\'autore del post lo può eliminare.',
            ],

            'edit' => [
                'deleted' => 'Non puoi modificare un post eliminato.',
                'locked' => 'Non è permesso effettuare modifiche in questo post.',
                'no_forum_access' => 'È necessario accedere al forum richiesto.',
                'not_owner' => 'Solo l\'autore del post lo può modificare.',
                'topic_locked' => 'Non puoi modificare i post di un topic bloccato.',
            ],

            'store' => [
                'play_more' => 'Prova a giocare prima di postare nei forum! Se hai problemi a giocare, posta nel forum di Aiuto e Supporto.',
                'too_many_help_posts' => "Devi giocare di più prima di poter fare ulteriori post. Se hai ancora problemi a giocare, invia un email a support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Modifica il tuo ultimo post invece di postare di nuovo.',
                'locked' => 'Non puoi rispondere ad un topic bloccato.',
                'no_forum_access' => 'È necessario accedere al forum richiesto.',
                'no_permission' => 'Non hai i permessi per rispondere.',

                'user' => [
                    'require_login' => 'Per favore effettua il login per rispondere.',
                    'restricted' => "Non puoi rispondere mentre sei limitato.",
                    'silenced' => "Non puoi rispondere mentre sei silenziato.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'È necessario accedere al forum richiesto.',
                'no_permission' => 'Non hai i permessi per creare un nuovo topic.',
                'forum_closed' => 'Il forum è chiuso e non puoi postare nulla lì.',
            ],

            'vote' => [
                'no_forum_access' => 'È necessario accedere al forum richiesto.',
                'over' => 'Il sondaggio è finito e non puoi più votare.',
                'play_more' => 'Devi giocare di più prima di votare sul forum.',
                'voted' => 'Non è permesso cambiare voto.',

                'user' => [
                    'require_login' => 'Per favore effettua il login per votare.',
                    'restricted' => "Non puoi votare mentre sei limitato.",
                    'silenced' => "Non puoi votare mentre sei silenziato.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'È necessario accedere al forum richiesto.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'La cover specificata non è valida.',
                'not_owner' => 'Solo l\'autore può modificare la cover.',
            ],
            'store' => [
                'forum_not_allowed' => 'Questo forum non accetta copertine di argomento.',
            ],
        ],

        'view' => [
            'admin_only' => 'Solo gli amministratori possono vedere questo forum.',
        ],
    ],

    'require_login' => 'Per favore effettua il login per poter procedere.',

    'unauthorized' => 'Accesso Negato.',

    'silenced' => "Non puoi farlo mentre sei silenziato.",

    'restricted' => "Non puoi farlo mentre sei limitato.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La tua userpage è bloccata.',
                'not_owner' => 'Puoi modificare solo la tua pagina utente.',
                'require_supporter_tag' => 'è necessario avere la tag osu!supporter.',
            ],
        ],
    ],
];
