// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { Spinner } from 'spinner';
import UserAvatar from 'user-avatar';
import { onErrorWithCallback } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { transparentGif } from 'utils/html';

type BeatmapsetWithDiscussionJson = BeatmapsetExtendedJson;

interface Props {
  beatmap: BeatmapJson;
  beatmapsetUser: UserJson;
  user: UserJson;
  userByName: Map<string, UserJson>;
}

@observer
export default class BeatmapOwnerEditor extends React.Component<Props> {
  @observable private checkingUser = false;
  @observable private editing = false;
  private inputRef = React.createRef<HTMLInputElement>();
  @observable private inputUser?: UserJson;
  @observable private inputUsername: string;
  private shouldFocusInputOnNextRender = false;
  @observable private updatingOwner = false;
  private userLookupTimeout?: number;
  private xhr: Partial<Record<string, JQuery.jqXHR>> = {};

  constructor(props: Props) {
    super(props);

    this.inputUsername = props.user.username;
    this.inputUser = props.user;
  }

  componentDidUpdate() {
    if (this.shouldFocusInputOnNextRender) {
      this.shouldFocusInputOnNextRender = false;
      this.inputRef.current?.focus();
    }
  }

  compontentWillUnmount() {
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

  private handleCancelEditingClick = () => {
    this.editing = false;
  };

  private handleResetClick = () => {
    if (!confirm(osu.trans('beatmap_discussions.owner_editor.reset_confirm'))) return;

    this.editing = false;
    this.updateOwner(this.props.beatmapsetUser.id);
  };

  private handleSaveClick = () => {
    if (this.inputUser == null) return;

    this.updateOwner(this.inputUser.id);
  };

  private handleStartEditingClick = () => {
    this.editing = true;
    this.shouldFocusInputOnNextRender = true;
    this.inputUser = this.props.user;
    this.inputUsername = this.props.user.username;
  };

  private handleUsernameInput = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.inputUsername = e.currentTarget.value;

    this.inputUser = this.props.userByName.get(this.inputUsername);

    window.clearTimeout(this.userLookupTimeout);

    if (this.inputUser == null && this.inputUsername !== '') {
      this.checkingUser = true;
      window.setTimeout(this.userLookup, 500);
    }
  };

  private renderAvatar() {
    if (this.checkingUser) {
      return <Spinner />;
    }

    const user = this.editing
      ? (this.inputUser ?? { avatar_url: transparentGif })
      : this.props.user;

    return <UserAvatar modifiers={['full-circle']} user={user} />;
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
        <span className='beatmap-owner-editor__input beatmap-owner-editor__input--static u-ellipsis-overflow'>
          {this.props.user.username}
        </span>
      );
    }

    return (
      <input
        ref={this.inputRef}
        className={classWithModifiers('beatmap-owner-editor__input', {
          error: this.inputUser == null,
        })}
        onChange={this.handleUsernameInput}
        value={this.inputUsername}
      />
    );
  }

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
    }).done((data: BeatmapsetWithDiscussionJson) => {
      $.publish('beatmapsetDiscussions:update', { beatmapset: data });
      this.editing = false;
    }).fail(onErrorWithCallback(() => {
      this.updateOwner(userId);
    })).always(() => {
      this.updatingOwner = false;
    });
  };

  private userLookup = () => {
    this.xhr.userLookup?.abort();

    this.xhr.userLookup = $.ajax(route('users.check-username-exists'), {
      data: { username: this.inputUsername },
      method: 'POST',
    }).done((user: UserJson) => {
      if (user.id > 0) {
        this.props.userByName.set(user.username, user);
        this.inputUser = user;
      }
    }).fail(
      onErrorWithCallback(this.userLookup),
    ).always(() => {
      this.checkingUser = false;
    });
  };
}
