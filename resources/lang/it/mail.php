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
        'new' => 'Dopo la tua ultima visita, c\'è stato un nuovo aggiornamento nella beatmap ":title".',
        'subject' => 'Nuovo aggiornamento per la beatmap ":title"',
        'unwatch' => 'Se non desideri più seguire su questa beatmap, puoi cliccare il link "Smetti di guardare" in fondo alla pagina, o tramite la pagina per gli aggiornamenti sul modding:',
        'visit' => 'Visita la pagina della discussione qui:',
    ],

    'common' => [
        'closing' => 'Saluti,',
        'hello' => 'Ciao :user,',
        'report' => 'Per favore, rispondi IMMEDIATAMENTE a questa email se non hai richiesto questa modifica.',
    ],

    'forum_new_reply' => [
        'new' => 'Dopo la tua ultima visita, c\'è stato un nuovo aggiornamento in ":title".',
        'subject' => '[osu!] Nuova risposta dal topic ":title"',
        'unwatch' => 'Se non desideri più seguire questo topic, puoi cliccare il link "Annulla iscrizione al topic" presente al fondo del topic, o tramite la pagina di gestione dei topic a cui sei iscritto:',
        'visit' => 'Passa direttamente all\'ultima risposta utilizzando il seguente link:',
    ],

    'password_reset' => [
        'code' => 'Il tuo codice di verifica è:',
        'requested' => 'Tu o qualcuno che pretende di essere te ha richiesto un reset della password del tuo account osu!.',
        'subject' => 'Ripristino account osu!',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'Abbiamo ricevuto il tuo pagamento e stiamo preparando l\'ordine per la spedizione. Ci vorranno alcuni giorni per inviartelo, a seconda della quantità di ordini. Puoi seguire i progressi del tuo ordine qui, inclusi i dettagli di tracciamento, ove disponibili:',
        'processing' => 'Abbiamo ricevuto il tuo pagamento e stiamo elaborando l\'ordine. Puoi seguire i progressi del tuo ordine qui:',
        'questions' => "Se hai dubbi, non esitare a contattarci rispondendo a questa email.",
        'shipping' => 'Spedizione',
        'subject' => 'Abbiamo ricevuto il tuo ordine su osu!store!',
        'thank_you' => 'Grazie per il tuo ordine sul osu!store!',
        'total' => 'Totale',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'La persona che ti ha regalato questo tag potrebbe aver scelto di rimanere anonima, pertanto non è stata menzionata in questa notifica.',
        'anonymous_gift_maybe_not' => 'Ma probabilmente già sai chi è ;).',
        'duration' => 'Grazie a loro, ora hai accesso ad osu!direct e ad altri benefici di osu!supporter per :duration.',
        'features' => 'Puoi trovare ulteriori dettagli su queste funzionalità qui:',
        'gifted' => 'Qualcuno ti ha appena regalato un tag osu!supporter!',
        'subject' => 'Ti hanno regalato un tag osu!supporter!',
    ],

    'user_email_updated' => [
        'changed_to' => 'Questa è una email di conferma per informarti che l\'indirizzo email del tuo account osu! è stato cambiato in: ":email".',
        'check' => 'Assicurati di aver ricevuto questa email al tuo nuovo indirizzo per evitare di perdere in futuro l\'accesso al tuo account osu!.',
        'sent' => 'Per motivi di sicurezza, questa email è stata inviata al tuo nuovo e vecchio indirizzo email.',
        'subject' => 'conferma il cambio della email di osu!',
    ],

    'user_force_reactivation' => [
        'main' => 'Il tuo account potrebbe essere stato compromesso, la sua attività recente è sospetta oppure ha una password MOLTO debole. Come risultato, ti richiediamo di inserire una nuova password. Per favore, assicurati che sia molto SICURA.',
        'perform_reset' => 'Puoi eseguire il reset da :url',
        'reason' => 'Motivazione:',
        'subject' => 'Riattivazione dell\'account di osu! richiesta',
    ],

    'user_password_updated' => [
        'confirmation' => 'Questa è solo una conferma che la tua password di osu! è stata cambiata.',
        'subject' => 'conferma il cambio della password di osu!',
    ],

    'user_verification' => [
        'code' => 'Il tuo codice di verifica è:',
        'code_hint' => 'Puoi inserire il codice con o senza spazi.',
        'link' => 'In alternativa, puoi anche visitare il link qui sotto per completare la verifica:',
        'report' => 'Se non lo hai richiesto, RISPONDI IMMEDIATAMENTE visto che il tuo account potrebbe essere in pericolo.',
        'subject' => 'verifica account osu!',

        'action_from' => [
            '_' => 'Un\'azione effettuata sul tuo account da :country richiede verifica.',
            'unknown_country' => 'paese sconosciuto',
        ],
    ],
];
