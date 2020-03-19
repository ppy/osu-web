{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
