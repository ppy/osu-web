{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
