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
