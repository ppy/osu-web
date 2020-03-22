{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $inStock = $product->inStock(1, true);
    $blockClass = 'product-box product-box--card';

    if (!$inStock) {
        $blockClass .= ' product-box--oos';
    }

    if ($product->promoted && $inStock) {
        $backgroundImage = $product->header_image;
        $blockClass .= ' product-box--card-large';
        $markdownPreset = 'store-product';
    } else {
        $backgroundImage = $product->image;
        $blockClass .= ' product-box--card-small';
        $markdownPreset = 'store-product-small';
    }
@endphp
<a
    href="{{ route('store.products.show', $product) }}"
    class="{{ $blockClass }}"
    {!! background_image($backgroundImage) !!}
>
    <div class="product-box__text">
        {!! markdown($product->header_description, $markdownPreset) !!}
    </div>

    <i class="product-box__oos-bar"></i>
</a>
