{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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

<div id="paybar" class="store-checkout__paybar"></div>
<script src="{{ mix("js/paybar.js") }}" data-turbolinks-track="reload"></script>
<script type="text/javascript">
    XPBWidget.init({
        element_id   : 'paybar',
        type         : 'lightbox',
        project      : "{{ config('xsolla.project_id') }}",
        v1           : "{{ $checkout->getXsollaCheckoutDescription() }}",
        v2           : "{{ $checkout->getXsollaCheckoutCode() }}",
        out          : {{ $order->getTotal() }},
        email        : "{{ Auth::user()->user_email }}",
        scripthost   : 'https://secure.xsolla.com',
        itemTemplate : '<span><a href="%HREF%" target="_blank"><img src="%ICON_SRC%" /><b>%NAME%</b></a></span>',
        css          : 'example4.css',
        errorCallback: function(message, category) { alert('Error "' + message + '"	at ' + category); },
        doneCallback : function() {},
        template     : { id: 'inline', icon_count: 5, other: true }
    });
</script>
