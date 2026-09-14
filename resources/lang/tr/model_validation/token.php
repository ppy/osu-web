<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* İstemci Kimlik Bilgileri ile izin verilmez',
        'all_scope_no_mix' => '* diğer kapsamlarla birlikte geçerli değildir',
        'client_missing_owner' => 'İstemci sahibi eksik',
        'client_unauthorized' => 'İstemci yetkilendirilmemiş.',
        'delegate_bot_only' => '',
        'client_credentials_only' => 'Bu kapsam yalnızca client_credentials token\'ları için geçerlidir.',
        'delegate_invalid_combination' => '',
        'delegate_required' => 'temsilci scope gerekli.',
        'empty' => 'Scope olmayan tokenler geçerli değil.',
        'bot_only' => 'Bu scope sadece botlar veya sahip olduğun istemciler için mevcut.',
    ],
];
