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
                                    <i class="fas fa-fw fa-{{ $session['mobile'] ? 'mobile-alt' : 'desktop'}}"></i>
                                </span>
                                <span class="user-session-list-session__title">
                                    {{$session['device'] }} ({{$session['browser']}})
                                    @if($currentSessionId === $sessionId)
                                        [{{trans('accounts.security.current_session')}}]
                                    @endif
                                </span>
                            </div>
                            <div class="user-session-list-session__details">
                                <span class="user-session-list-session__last-active">{{trans('accounts.security.last_active')}} {!! timeago($session['last_visit']) !!}</span>
                                <span class="user-session-list-session__ip">
                                    <span class="user-session-list-session__icon flag-country flag-country--small-box"
                                        title="{{$session['country']['name']}}"
                                        style="background-image: url('/images/flags/{{$session['country']['code']}}.png');"
                                    ></span>
                                    {{ mask_ip($session['ip']) }}
                                </span>
                                <button
                                    class="user-session-list-session__logout"
                                    type="button"
                                    data-method="delete"
                                    data-remote="1"
                                    data-confirm="{{trans('accounts.security.end_session_confirmation')}}"
                                    data-reload-on-success="1"
                                    data-url="{{route('account.sessions.destroy', ['id' => $sessionId])}}"
                                ><i class="fas fa-fw fa-sign-out-alt"></i>{{trans('accounts.security.end_session')}}</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
