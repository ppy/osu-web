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
        'new' => 'Juste pour vous informer qu\'il y a eu une mise à jour dans la beatmap ":title" depuis votre dernière visite.',
        'subject' => 'Nouvelle mise à jour pour la beatmap ":title"',
        'unwatch' => 'Si vous ne souhaitez plus suivre cette beatmap, vous pouvez soit cliquer sur le lien "Ne plus suivre" trouvé dans la page ci-dessus, soit sur la page de la liste de suivi de modding :',
        'visit' => 'Visitez la page de discussion ici :',
    ],

    'common' => [
        'closing' => 'Cordialement,',
        'hello' => 'Bonjour :user,',
        'report' => 'Veuillez répondre à cet email IMMÉDIATEMENT si vous n\'avez pas demandé ce changement.',
    ],

    'forum_new_reply' => [
        'new' => 'Juste pour vous informer qu\'il y a eu une nouvelle réponse dans la discussion ":title" depuis votre dernière visite.',
        'subject' => '[osu!] Nouvelle réponse pour le sujet ":title"',
        'unwatch' => 'Si vous souhaitez ne plus observer ce sujet, vous pouvez soit cliquer sur le lien de désabonnement qui se trouve en dessous du sujet plus haut, ou depuis la page de gestion des souscriptions aux sujets:',
        'visit' => 'Aller directement à la dernière réponse en utilisant le lien suivant :',
    ],

    'password_reset' => [
        'code' => 'Votre code de vérification est :',
        'requested' => 'Vous ou quelqu\'un prétendant être vous avez demandé une réinitialisation de mot de passe sur votre compte osu!.',
        'subject' => 'Récupération de compte osu!',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'Nous avons reçu votre paiement et préparons votre commande pour l\'expédition. Il peut nous prendre quelques jours pour l\'expédition, selon la quantité de commandes. Vous pouvez suivre la progression de votre commande ici, y compris les détails de suivi lorsque disponible :',
        'processing' => 'Nous avons reçu votre paiement et sommes en train de traiter votre commande. Vous pouvez suivre l\'avancement de votre commande ici :',
        'questions' => "Si vous avez des questions, n'hésitez pas à répondre à ce courriel.",
        'shipping' => 'Livraison',
        'subject' => 'Nous avons bien reçu votre commande osu!store !',
        'thank_you' => 'Merci pour votre commande sur le magasin osu! !',
        'total' => 'Total',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'La personne qui vous a donné cette étiquette peut choisir de rester anonyme, donc elle n\'a pas été mentionnée dans cette notification.',
        'anonymous_gift_maybe_not' => 'Mais vous savez probablement déjà qui c\'est ;).',
        'duration' => 'Grâce à eux, vous avez accès à osu!direct et d\'autres avantages osu!supporter pour les prochains :duration.',
        'features' => 'Vous trouverez plus de détails sur ces fonctionnalités ici :',
        'gifted' => 'Quelqu\'un vient de vous offrir un tag osu!supporter !',
        'subject' => 'On vous a offert un tag osu!supporter !',
    ],

    'user_email_updated' => [
        'changed_to' => 'Ceci est un email de confirmation pour vous informer que votre adresse e-mail osu! a été changée à : ":email".',
        'check' => 'Veuillez vous assurer que vous avez reçu cet e-mail à votre nouvelle adresse pour éviter de perdre votre compte osu!.',
        'sent' => 'Pour des raisons de sécurité, ce courriel a été envoyé à votre nouvelle et ancienne adresse e-mail.',
        'subject' => 'Confirmation du changement d\'email d\'osu!',
    ],

    'user_force_reactivation' => [
        'main' => 'On soupçonne que votre compte a été compromis, que des activités suspectes ont été effectuées récemment ou que votre mot de passe est très faible. Par conséquent, nous vous demandons de définir un nouveau mot de passe. Veuillez choisir un mot de passe SÉCURISÉ.',
        'perform_reset' => 'Vous pouvez le réinitialiser sur :url',
        'reason' => 'Raison :',
        'subject' => 'Réactivation du compte osu! requise',
    ],

    'user_password_updated' => [
        'confirmation' => 'Ceci est juste une confirmation que votre mot de passe osu! a été changé.',
        'subject' => 'Confirmation du changement de mot de passe d\'osu!',
    ],

    'user_verification' => [
        'code' => 'Votre code de vérification est :',
        'code_hint' => 'Vous pouvez entrer le code avec ou sans espace.',
        'link' => 'Vous pouvez également visiter ce lien ci-dessous pour terminer la vérification :',
        'report' => 'Si vous n\'avez pas demandé ceci, veuillez RÉPONDRE IMMÉDIATEMENT car votre compte est peut être en danger.',
        'subject' => 'vérification du compte osu!',

        'action_from' => [
            '_' => 'Une action effectuée sur votre compte depuis :country requiert une vérification.',
            'unknown_country' => 'pays inconnu',
        ],
    ],
];
