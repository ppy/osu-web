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
<script data-turbolinks-eval="always">
    var STATIC_DOMAIN = "{{ Config::get("osu.static", "//s.ppy.sh") }}";
    var csrf = "{{ csrf_token() }}";
    var section = "{{ $current_section }}";
    var page = "{{ $current_action }}";
    var logoutUrl = "{{ route("users.logout") }}";
    var helpUrl = "{{ route("help.wiki") }}";
    var canonicalUrl = "{{ $canonicalUrl or '' }}";
    var reloadUrl = "{{ $reloadUrl or '' }}";
</script>

@include ('layout._current_user')
