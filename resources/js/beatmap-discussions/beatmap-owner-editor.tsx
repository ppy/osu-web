// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import UserAvatar from 'components/user-avatar';
import UserLink from 'components/user-link';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { normaliseUsername } from 'models/user';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { transparentGif } from 'utils/html';
import { trans } from 'utils/lang';

type BeatmapsetWithDiscussionJson = BeatmapsetExtendedJson;

interface XhrCollection {
  updateOwner: JQuery.jqXHR<BeatmapsetWithDiscussionJson>;
  userLookup: JQuery.jqXHR<UserJson>;
}

interface Props {
  beatmap: BeatmapJson;
  beatmapsetUser: UserJson;
  user: UserJson;
  userByName: Map<string, UserJson>;
}

@observer
export default class BeatmapOwnerEditor extends React.Component<Props> {
  @observable private checkingUser: string | null = null;
  @observable private editing = false;
  private inputRef = React.createRef<HTMLInputElement>();
  @observable private inputUsername: string;
  private shouldFocusInputOnNextRender = false;
  @observable private updatingOwner = false;
  private userLookupTimeout?: number;
  private xhr: Partial<XhrCollection> = {};

  @computed
  private get inputUser() {
    return this.props.userByName.get(normaliseUsername(this.inputUsername));
  }

  constructor(props: Props) {
    super(props);

    this.inputUsername = props.user.username;

    makeObservable(this);
  }

  componentDidUpdate() {
    if (this.shouldFocusInputOnNextRender) {
      this.shouldFocusInputOnNextRender = false;
      this.inputRef.current?.focus();
    }
  }

  componentWillUnmount() {
    window.clearTimeout(this.userLookupTimeout);
    Object.values(this.xhr).forEach((xhr) => xhr?.abort());
  }

  render() {
    const blockClass = classWithModifiers('beatmap-owner-editor', {
      editing: this.editing,
    });

    return (
      <div className={blockClass}>
        <div className='beatmap-owner-editor__col'>
          <span className='beatmap-owner-editor__mode'>
            <span className={`fal fa-fw fa-extra-mode-${this.props.beatmap.mode}`} />
          </span>
        </div>

        <div className='beatmap-owner-editor__col beatmap-owner-editor__col--version'>
          <span className='u-ellipsis-overflow'>
            {this.props.beatmap.version}
          </span>
        </div>

        <div className='beatmap-owner-editor__col beatmap-owner-editor__col--avatar'>
          {this.renderAvatar()}
        </div>

        <div className='beatmap-owner-editor__col'>
          {this.renderUsername()}
        </div>

        <div className='beatmap-owner-editor__col beatmap-owner-editor__col--buttons'>
          {this.renderButtons()}
        </div>
      </div>
    );
  }

  @action
  private handleCancelEditingClick = () => {
    this.editing = false;
  };

  @action
  private handleResetClick = () => {
    if (!confirm(trans('beatmap_discussions.owner_editor.reset_confirm'))) return;

    this.editing = false;
    this.updateOwner(this.props.beatmapsetUser.id);
  };

  private handleSaveClick = () => {
    if (this.inputUser == null) return;

    this.updateOwner(this.inputUser.id);
  };

  @action
  private handleStartEditingClick = () => {
    this.editing = true;
    this.shouldFocusInputOnNextRender = true;
    this.inputUsername = this.props.user.username;
  };

  @action
  private handleUsernameInput = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.inputUsername = e.currentTarget.value;
    const inputUsernameNormalised = normaliseUsername(this.inputUsername);

    if (inputUsernameNormalised === this.checkingUser) return;

    window.clearTimeout(this.userLookupTimeout);
    this.xhr.userLookup?.abort();
    this.checkingUser = this.inputUser == null && inputUsernameNormalised !== '' ? inputUsernameNormalised : null;

    if (this.checkingUser != null) {
      this.userLookupTimeout = window.setTimeout(this.userLookup, 500);
    }
  };

  private handleUsernameInputKeyup = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key === 'Enter') this.handleSaveClick();
  };

  private renderAvatar() {
    if (this.checkingUser != null) {
      return <Spinner />;
    }

    const user = this.editing
      ? (this.inputUser ?? { avatar_url: transparentGif })
      : this.props.user;

    const avatar = <UserAvatar modifiers='full-circle' user={user} />;

    return this.editing
      ? avatar
      : <UserLink className='beatmap-owner-editor__avatar' user={this.props.user}>{avatar}</UserLink>;
  }

  private renderButtons() {
    if (this.updatingOwner) {
      return <Spinner />;
    }

    const reset = (
      <button
        className='beatmap-owner-editor__button'
        disabled={this.props.beatmap.user_id === this.props.beatmapsetUser.id}
        onClick={this.handleResetClick}
      >
        <span className='fas fa-fw fa-undo' />
      </button>
    );

    if (!this.editing) {
      return (
        <>
          <button className='beatmap-owner-editor__button' onClick={this.handleStartEditingClick}>
            <span className='fas fa-fw fa-pen' />
          </button>

          {reset}
        </>
      );
    }

    return (
      <>
        <button className='beatmap-owner-editor__button' disabled={this.inputUser == null} onClick={this.handleSaveClick}>
          <span className='fas fa-fw fa-check' />
        </button>

        <button className='beatmap-owner-editor__button' onClick={this.handleCancelEditingClick}>
          <span className='fas fa-fw fa-times' />
        </button>

        {reset}
      </>
    );
  }

  private renderUsername() {
    if (!this.editing) {
      return (
        <UserLink
          className='beatmap-owner-editor__input beatmap-owner-editor__input--static'
          user={this.props.user}
        />
      );
    }

    return (
      <input
        ref={this.inputRef}
        className={classWithModifiers('beatmap-owner-editor__input', {
          error: this.inputUser == null,
        })}
        disabled={this.updatingOwner}
        onChange={this.handleUsernameInput}
        onKeyUp={this.handleUsernameInputKeyup}
        value={this.inputUsername}
      />
    );
  }

  @action
  private updateOwner = (userId: number) => {
    this.xhr.updateOwner?.abort();

    if (this.props.beatmap.user_id === userId) {
      this.editing = false;

      return;
    }

    this.updatingOwner = true;

    this.xhr.updateOwner = $.ajax(route('beatmaps.update-owner', { beatmap: this.props.beatmap.id }), {
      data: { beatmap: { user_id: userId } },
      method: 'PUT',
    });
    this.xhr.updateOwner.done((data) => runInAction(() => {
      $.publish('beatmapsetDiscussions:update', { beatmapset: data });
      this.editing = false;
    })).fail(onErrorWithCallback(() => {
      this.updateOwner(userId);
    })).always(action(() => {
      this.updatingOwner = false;
    }));
  };

  private userLookup = () => {
    const currentCheckingUser = this.checkingUser;

    if (currentCheckingUser == null) return;

    this.xhr.userLookup = $.ajax(route('users.check-username-exists'), {
      data: { username: currentCheckingUser },
      method: 'POST',
    });
    this.xhr.userLookup.done((user) => runInAction(() => {
      if (user.id > 0) {
        this.props.userByName.set(currentCheckingUser, user);
      }
    })).fail(
      onErrorWithCallback(this.userLookup),
    ).always(action(() => {
      this.checkingUser = null;
    }));
  };
}
