{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<?php
    $_inStock = $product->inStock(1, true);
    $_large = $product->promoted && $_inStock;

    $_topClass = 'osu-layout__col';

    if (!$_large) {
        $_topClass .= ' osu-layout__col--sm-6';
    }
?>

<div class="{{ $_topClass }}" style="order: {{ $_inStock ? '0' : '1' }};">
    <a
        href="{{ route('store.products.show', $product) }}"
        class="product-box product-box--{{ $_large ? 'large' : 'small' }}"
        style="background-image: url('{{ $_large ? $product->header_image : $product->image }}')"
    >
        <div class="product-box__text">
            {!! markdown($product->header_description) !!}
        </div>

        @if(!$_inStock)
            <i class="product-box__bar product-box__bar--oos"></i>
        @endif
    </a>
</div>
