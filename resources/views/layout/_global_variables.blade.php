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
<script data-turbolinks-eval="always">
    var csrf = "{{ csrf_token() }}";
    var section = "{{ $currentSection }}";
    var page = "{{ $currentAction }}";
    var canonicalUrl = "{{ $canonicalUrl or '' }}";
    var reloadUrl = "{{ $reloadUrl or '' }}";
</script>

@include ('layout._current_user')

<div id="js-usercard__loading-template" class="hidden">
    {{-- This content is a placeholder so that qtip has something to fade in while the react component mounts --}}
    <div>
        <div class="usercard">
            <div class="usercard__background-container">
                <div class="usercard__background-overlay"></div>
            </div>
        <div class="usercard__card">
            <div class="usercard__card-content">
                <div class="usercard__avatar-space"></div>
            </div>
            <div class="usercard__metadata">
                <div class="usercard__username">{{ trans('users.card.loading') }}</div>
                <div class="usercard__status-bar usercard__status-bar--offline">
                    <span class="far fa-fw fa-circle usercard__status-icon"></span>
                    <span class="usercard__status-message">Offline</span>
                </div>
            </div>
        </div>
    </div>
</div>
