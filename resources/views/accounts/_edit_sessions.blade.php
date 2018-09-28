<div class="account-edit">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
                {{trans('accounts.security.title')}}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <div class="account-edit-entry">
                <div class="account-edit-entry__label account-edit-entry__label--top-pinned">{{trans('accounts.security.web_sessions')}}</div>
                <div class="user-session-list">
                    @foreach ($sessions as $sessionId => $session)
                        <div class="user-session-list-session">
                            <div class="user-session-list-session__header">
                                <span class="user-session-list-session__icon">
                                    <i class="fas fa-fw fa-{{$session['mobile'] ? 'mobile-alt' : 'desktop'}}"></i>
                                </span>
                                <span class="user-session-list-session__title">
                                    {{$session['mobile'] ? $session['device'] : $session['platform']}} ({{$session['browser']}})
                                    @if($currentSessionId === $sessionId)
                                        <span class="user-session-list-session__current-badge">{{trans('accounts.security.current_session')}}</span>
                                    @endif
                                </span>
                            </div>
                            <div class="user-session-list-session__details">
                                <span class="user-session-list-session__last-active">{{trans('accounts.security.last_active')}} {!! timeago($session['last_visit']) !!}</span>
                                <span class="user-session-list-session__ip" title="{{$session['ip']}}">
                                    <span class="user-session-list-session__icon flag-country flag-country--small-box"
                                        style="background-image: url('/images/flags/{{$session['country']['code']}}.png');"
                                    ></span>
                                    {{$session['country']['name']}}
                                </span>
                                <button
                                    class="user-session-list-session__logout"
                                    type="button"
                                    data-method="delete"
                                    data-remote="1"
                                    data-confirm="{{trans('accounts.security.end_session_confirmation')}}"
                                    data-reload-on-success="1"
                                    data-url="{{route('account.sessions.destroy', ['id' => $sessionId])}}"
                                >{{trans('accounts.security.end_session')}}<i class="fas fa-fw fa-sign-out-alt user-session-list-session__logout-icon"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
