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
@section('script')
    @parent

    <div class="js-user-verification modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog--full">
            <div class="user-verification-popup">
                <div class="osu-layout__row">
                    <div class="user-verification-popup__modal">
                        <div class="js-user-verification--box user-verification-popup__box">
                            @yield('user-verification-box')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
