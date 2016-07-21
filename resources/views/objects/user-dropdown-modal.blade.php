<div id="user-dropdown-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal__dialog js-user-dropdown-modal__dialog">
        @if (Auth::check())
            <div class="js-react--user-card"></div>
        @else
            <div class="modal-content modal-content--no-shadow">
                <div class="modal-header modal-header--login"><h1 class="modal-header__title">{{ trans("users.login._") }}</h1></div>
                <div class="modal-body modal-body--user-dropdown modal-body--no-rounding">
                    <h2 class="modal-body__title modal-body__title">{{ trans("users.login.title") }}</h2>

                    {!! Form::open(["url" => route("users.login"), "id" => "login-form", "class" => "modal-body__form form", "data-remote" => true]) !!}
                        <div class="form__input-group form-group form-group--compact">
                            <input class="modal-af form-group__control form-control" name="username" type="text" placeholder="{{ trans("users.login.username") }}" required>
                            <input class="form-group__control form-control" name="password" type="password" placeholder="{{ trans("users.login.password") }}" required>
                        </div>

                        <button class="btn-osu btn-osu-default form__button" type="submit"><i class="fa fa-sign-in"></i></button>
                    {!! Form::close() !!}

                    <p class="modal-body__paragraph"><a href="{{ route("users.forgot-password") }}" target="_blank">{{ trans("users.login.forgot") }}</a></p>
                    <p class="modal-body__paragraph"><a href="{{ route("users.register") }}" target="_blank">{{ trans("users.login.register") }}</a></p>
                </div>
            </div>
        @endif
    </div>
</div>