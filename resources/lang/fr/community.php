<?php
/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
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
    'support' => [
        'header' => [
            'big_description' => 'Vous aimez osu!?<br/>
                                Supportez le dévloppement d\'osu! :D',
            'small_description' => '',
            'support_button' => 'Je veux supporter osu!'
        ],
        'dev_quote' => 'osu! est un free-to-play complet, mais le maintenir n\'est pas gratuit. Entre le prix des serveurs et de la grande bande passante internationale, le temps passé à maitenir le système et la communauté, parvenir des prix pour les compétitions, répondre aux questions du support et généralement garder les gens heureux, osu! consommes une certaine somme d\'argent! Oh, et n\'oubliez pas le fait que nous le faisons sans pub ou partenariat avec des toolbars ou autres!
            <br/><br/>osu! est à largement développé par moi-même, pour cela vous me connaisez sûrement avec le surnom "peppy".
            J\'ai du quitté mon travail à temps plein pour garder le rythme avec osu!,
            et à certaints temps je lutte pour garder mes standars que je m\'efforce à garder.
            J\'aurais aimé d\'offrir mes remerciments personnels pour ce qui ont supportés osu! jusque là,
            et aussi ceux qui continueront à supporter ce super jeu et la communauté dans le futur :).',
        'why_support' => [
            'title' => 'Pourquoi je supporterais osu!?',
            'blocks' => [
                'dev' => 'Développé et maitenu par une seule personne en Australie',
                'time' => 'Prend tellement de temps pour le maitenir que ce n\'est plus possible d\'appeler ça un "hobby".',
                'ads' => 'Aucune pub, nullepart. <br/><br/>
                        Pas comme 99,95% des sites, nous ne profitons pas de votre clic pour l\'argent.',
                'goodies' => 'Vous obtiendrez des goodies!'
            ]
        ],
        'perks' => [
            'title' => 'Ah? J\'aurais quoi?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'accès à la recherche et au téléchargement de beatmap sans quitter le jeu.'
            ],
            'auto_downloads' => [
                'title' => 'Téléchargements automatiques',
                'description' => 'Téléchargements automatiques en multijoueur, lorsque vous observez ou dans le chat!'
            ],
            'upload_more' => [
                'title' => 'Plus de slots d\'upload',
                'description' => 'Slots de beatmaps additionnels jusqu\'à 10.'
            ],
            'early_access' => [
                'title' => 'Accès anticipé',
                'description' => 'Accès aux versions anticipées, vous obtiendrez les nouvelles fonctions avant tout le monde!'
            ],
            'customisation' => [
                'title' => 'Personnalisation',
                'description' => 'Personnalisez votre profil avec une page utilisateur complètement changable.'
            ],
            'beatmap_filters' => [
                'title' => 'Filtres de beatmaps',
                'description' => 'Filtrez les recherches de beatmaps par les jouées et les non-jouées et les notes obtenus (si une).'
            ],
            'yellow_fellow' => [
                'title' => 'Compagnon jaune',
                'description' => 'Soyez reconnu en jeu avec un pseudo tout jaune.'
            ],
            'speedy_downloads' => [
                'title' => 'Téléchargements rapides',
                'description' => 'Moins de restrictions de téléchargements, surtout avec osu!direct.'
            ],
            'change_username' => [
                'title' => 'Changez de pseudo',
                'description' => 'Vous pouvez changer votre pseudo sans coûts. (une fois seulement)'
            ],
            'skinnables' => [
                'title' => 'Skin',
                'description' => 'Plus d\'options de skin, comme le fond du menu principal.'
            ],
            'feature_votes' => [
                'title' => 'Votes de fonctions',
                'description' => 'Votez pour les demandes de fonctions. (2x par mois)'
            ],
            'sort_options' => [
                'title' => 'Options de filtrage',
                'description' => 'NOUVEAU: La capacité de filtrer le classement par pays / amis / mods spécifiques.'
            ],
            'feel_special' => [
                'title' => 'Sentiment spécial',
                'description' => 'Le sentiment d\'aider osu! à fonctionner!'
            ],
            'more_to_come' => [
                'title' => 'Plus à venir',
                'description' => ''
            ]
        ],
        'convinced' => [
            'title' => 'Je suis convaincu! :D',
            'support' => 'supportez osu!',
            'gift' => 'ou envoyez en cadeau à un utilisateur',
            'instructions' => 'cliquez sur le coeur pour aller au osu!store'
        ]
    ],
    'slack' => [
        'header' => [
            'small' => 'osu!dev',
            'large' => 'Accès au slack public d\'osu!'
        ],
        'disabled' => 'La communauté Slack publique est indisponible. Si vous souhaitez y aller, créez un ticket sur la <a href="https://github.com/ppy">repo GitHub</a> ou contactez-nous à <a href="mailto::mail">:mail</a>.',
        'guest-begin' => 'Vous devez être ',
        'guest-middle' => 'connecté',
        'guest-end' => ' pour recevoir une invitation Slack!',
        'receive-invite' => 'Vous pouvez recevoir une invitation pour le réseau Slack public ici',
        'bullet-points' => 'Merci de bien lire les conditions sur <a href=":link">ce post.</a><br />Veuillez noter que les offences sur votre compte ne sera pas toléré.',
        'recent-issues' => 'Votre compte à des problèmes récents. Merci de <a href="mailto::mail">contacter le support</a> pour plus de détails.',
        'agree-button' => 'Accepter',
        'accepted' => 'Votre requête a été acceptée. Vous devriez recevoir un e-mail bientôt.',
        'invite-already-accepted' => 'Vous avez déjà un compte Slack! Si vous avez un problème, <a href="mailto::mail">contactez le support.</a>'
    ]
];
