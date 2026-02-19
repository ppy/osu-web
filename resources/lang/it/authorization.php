<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Che ne dici di giocare un po\' ad osu!?',
    'require_login' => 'Accedi per poter continuare.',
    'require_verification' => 'Esegui la verifica per poter continuare.',
    'restricted' => "Non puoi farlo mentre sei limitato.",
    'silenced' => "Non puoi farlo mentre sei silenziato.",
    'unauthorized' => 'Accesso negato.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Non è possibile rimuovere l\'Hype.',
            'has_reply' => 'Impossibile eliminare una discussione con risposte',
        ],
        'nominate' => [
            'exhausted' => 'Hai raggiunto il limite di nomine per oggi, riprova domani.',
            'incorrect_state' => 'Errore nell\'eseguire questa azione, prova a ricaricare la pagina.',
            'owner' => "Non puoi nominare la tua beatmap.",
            'set_metadata' => 'Devi impostare il genere e la lingua prima di nominarla.',
        ],
        'resolve' => [
            'not_owner' => 'Solo l\'autore del topic e il creatore della mappa possono risolvere una discussione.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Solo il creatore della beatmap o un nominatore/membro del NAT possono postare note.',
        ],

        'vote' => [
            'bot' => "Non puoi votare in una discussione creata da un bot",
            'limit_exceeded' => 'Attendi un po\' prima di aggiungere più voti',
            'owner' => "Non puoi votare la tua discussione.",
            'wrong_beatmapset_state' => 'Puoi votare solo sulle discussioni di beatmap in attesa.',
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
    ],

    'beatmapset' => [
        'discussion_locked' => 'Questa beatmap è bloccata per la discussione.',

        'metadata' => [
            'nominated' => 'Non puoi modificare i metadata di una mappa nominata. Contatta un membro di BN o NAT se pensi che siano stati impostati in modo errato.',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => 'Devi fare un punteggio su una beatmap per assegnare un\'etichetta.',
        ],
    ],

    'chat' => [
        'blocked' => 'Non puoi inviare messaggi a un utente che ti sta bloccando o che hai bloccato.',
        'friends_only' => 'L\'utente sta bloccando i messaggi da chi non è nella sua lista amici.',
        'moderated' => 'Questo canale è attualmente moderato.',
        'no_access' => 'Non hai accesso a quel canale.',
        'no_announce' => 'Non hai il permesso di pubblicare un annuncio.',
        'receive_friends_only' => 'L\'utente potrebbe non essere in grado di rispondere perché stai accettando messaggi solo da persone della tua lista amici.',
        'restricted' => 'Non puoi inviare messaggi mentre sei silenziato, limitato o bannato.',
        'silenced' => 'Non puoi inviare messaggi mentre sei silenziato, limitato o bannato.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'I commenti sono disabilitati',
        ],
        'update' => [
            'deleted' => "Non puoi modificare un post eliminato.",
        ],
    ],

    'contest' => [
        'judging_not_active' => 'La valutazione per questo concorso non è attiva.',
        'voting_over' => 'Non puoi cambiare il tuo voto quando il periodo di votazione per questo contest è finito.',

        'entry' => [
            'limit_reached' => 'Hai raggiunto il limite massimo di iscrizioni per questo contest',
            'over' => 'Grazie per le tue iscrizioni! Le richieste sono terminate per questo contest e le votazioni avverranno presto.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Non sei autorizzato a moderare questo forum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Solo l\'ultimo post può essere eliminato.',
                'locked' => 'Non puoi eliminare i post di un topic bloccato.',
                'no_forum_access' => 'È richiesto l\'accesso al forum.',
                'not_owner' => 'Solo l\'autore del post lo può eliminare.',
            ],

            'edit' => [
                'deleted' => 'Non puoi modificare un post eliminato.',
                'locked' => 'Non è permesso effettuare modifiche in questo post.',
                'no_forum_access' => 'È necessario accedere al forum richiesto.',
                'no_permission' => 'Nessun permesso per modificare.',
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
                'locked' => 'Non puoi rispondere a un topic bloccato.',
                'no_forum_access' => 'È necessario accedere al forum richiesto.',
                'no_permission' => 'Non hai i permessi per rispondere.',

                'user' => [
                    'require_login' => 'Accedi per rispondere.',
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
                    'require_login' => 'Effettua il login per poter votare.',
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

    'room' => [
        'destroy' => [
            'not_owner' => 'Solo il proprietario della stanza può chiuderla.',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "Impossibile fissare questo tipo di punteggio",
            'failed' => "Non puoi fissare un punteggio incompleto.",
            'not_owner' => 'Solo il proprietario del punteggio può fissarlo.',
            'too_many' => 'Hai già fissato troppi punteggi.',
        ],
    ],

    'team' => [
        'application' => [
            'store' => [
                'already_member' => "Fai già parte della squadra.",
                'already_other_member' => "Fai già parte di un'altra squadra.",
                'currently_applying' => 'Hai in sospeso una richiesta di partecipazione da una squadra.',
                'team_closed' => 'Attualmente la squadra non accetta richieste di partecipazione.',
                'team_full' => "La squadra è al completo e non può accettare ulteriori membri.",
            ],
        ],
        'part' => [
            'is_leader' => "Il capitano non può abbandonare la squadra.",
            'not_member' => 'Non un membro della squadra.',
        ],
        'store' => [
            'require_supporter_tag' => 'È necessario un tag osu!supporter per creare una squadra.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La tua userpage è bloccata.',
                'not_owner' => 'Puoi modificare solo la tua pagina utente.',
                'require_supporter_tag' => 'è necessario avere il tag osu!supporter.',
            ],
        ],
        'update_email' => [
            'locked' => 'l\'indirizzo email è bloccato',
        ],
    ],
];
