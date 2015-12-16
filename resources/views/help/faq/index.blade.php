{{--
    Copyright 2015 ppy Pty. Ltd.

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
@extends("master")

@section('content')
<div class="osu-layout__section osu-layout__section--full">
    <div class="osu-layout__row osu-layout__row--with-gutter faq-header">
        <div class="osu-layout__row--page header-row faq-header--background">
            <div class="wide col-sm-12 faq-input-wrapper">
                <div class="input-search-container faq-input-container"> 
                    <input placeholder="what is your issue?" />
                    <div class="fa fa-search"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="osu-layout__row osu-layout__row--with-gutter faq-listing">
        <div class="wide col-sm-12">
            <div class="faq__row--page osu-layout__row--page">
                <ul class="faq__list-heading-heading">
                    <li class="faq__list-heading--header faq__list-heading--item"><h2>Most popular topics</h2></li>
                    <li class="faq__list-heading--item faq__list-heading--link"><a href="#">first item</a></li>
                    <li class="faq__list-heading--item faq__list-heading--link"><a href="#">first item</a></li>
                    <li class="faq__list-heading--item faq__list-heading--link"><a href="#">first item</a></li>
                    <li class="faq__list-heading--item faq__list-heading--link"><a href="#">first item</a></li>
                    <li class="faq__list-heading--item faq__list-heading--link"><a href="#">first item</a></li>
                </ul>
            </div>
        </div>
        <div class="wide col-sm-6">
            <div class="faq__row--page osu-layout__row--page">
            <ul class="faq__list">
                <li class="faq__list--header faq__list--item"><h2>Most popular topics</h2></li>
                <li class="faq__list--item faq__list--link"><a href="#">first item</a></li>
                <li class="faq__list--item faq__list--link"><a href="#">first item</a></li>
                <li class="faq__list--item faq__list--link"><a href="#">first item</a></li>
                <li class="faq__list--item faq__list--link"><a href="#">first item</a></li>
                <li class="faq__list--item faq__list--link"><a href="#">first item</a></li>
            </ul>
            <a href="#" class="faq__list--more">more</a>
            </div>
        </div>
        <div class="wide col-sm-6">
            <div class="faq__row--page osu-layout__row--page">
            <ul class="faq__list">
                <li class="faq__list--header faq__list--item"><h2>Most popular topics</h2></li>
                <li class="faq__list--item faq__list--link"><a href="#">first item</a></li>
                <li class="faq__list--item faq__list--link"><a href="#">first item</a></li>
                <li class="faq__list--item faq__list--link"><a href="#">first item</a></li>
                <li class="faq__list--item faq__list--link"><a href="#">first item</a></li>
                <li class="faq__list--item faq__list--link"><a href="#">first item</a></li>
            </ul>
            <a href="#" class="faq__list--more">more</a>
            </div>
        </div>
    </div>    
</div>


@stop