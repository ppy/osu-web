<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'create' => [
        'finish' => 'Concluir',
        'key' => 'Escaneie o QR code com o app de autenticação e insira a chave de verificação',
        'key_copy' => 'Ou clique neste link para copiar a chave para o app de autenticação',
        'key_link' => 'Use este link caso esteja usando um telefone celular',
        'password' => 'Insira a sua senha para configurar a verificação por autenticador',
        'start' => 'Continuar',
    ],

    'destroy' => [
        'missing' => 'A sua verificação por autenticador não está configurada.',
        'ok' => 'Aplicativo de autenticação removido.',
    ],

    'edit' => [
        'password' => 'Por favor, insira sua senha atual para remover o autenticador.',
        'start' => 'Remover',
    ],

    'store' => [
        'existing' => 'Você já possui um app de verificação por autenticador configurado.',
        'ok' => 'A verificação por autenticador foi configurada',
        'restart' => 'Ocorreu um erro. Por favor, reinicie o processo.',
    ],
];
