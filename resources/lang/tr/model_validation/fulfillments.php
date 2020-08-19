<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'username_change' => [
        'only_one' => 'Gerçekleştirilen her sipariş başına kullanıcı adı değiştirme işlemi 1 defaya mahsustur.',
        'insufficient_paid' => 'Kullanıcı adı değiştirme ücreti ödenen miktarı (:expected > :actual) aşıyor',
        'reverting_username_mismatch' => 'Şuanki kullanıcı adı (:current), değiştirmek istediğiniz kullanıcı adı (:username) ile eşleşmemektedir',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Yapılan bağış, osu!supporter etiketi hediyesi için yeterli miktarda değil. (:actual > :expected)',
    ],
];
