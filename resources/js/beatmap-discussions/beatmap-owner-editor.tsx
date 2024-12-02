// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import InputContainer from 'components/input-container';
import { Spinner } from 'components/spinner';
import UsernameInput from 'components/username-input';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import UserJson from 'interfaces/user-json';
import WithBeatmapOwners from 'interfaces/with-beatmap-owners';
import { route } from 'laroute';
import { xor } from 'lodash';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { normaliseUsername } from 'models/user';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { hasGuestOwners } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import BeatmapOwner from './beatmap-owner';
import DiscussionsState from './discussions-state';

interface Props {
  beatmap: WithBeatmapOwners<BeatmapJson>;
  beatmapset: BeatmapsetExtendedJson;
  discussionsState: DiscussionsState; // only for updating the state with the response.
}

@observer
export default class BeatmapOwnerEditor extends React.Component<Props> {
  @observable editing = false;
  private readonly inputRef = React.createRef<HTMLInputElement>();
  @observable private inputUsername = '';
  private shouldFocusInputOnNextRender = false;
  @observable private showError = false;
  private updateOwnerXhr?: JQuery.jqXHR<BeatmapsetWithDiscussionsJson>;
  @observable private updatingOwner = false;
  @observable private validUsers = new Map<number, UserJson>();

  private get canSave() {
    return this.validUsers.size > 0 && normaliseUsername(this.inputUsername).length === 0;
  }

  private get owners() {
    return this.props.discussionsState.beatmapOwners(this.props.beatmap);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidUpdate() {
    if (this.shouldFocusInputOnNextRender) {
      this.shouldFocusInputOnNextRender = false;
      this.inputRef.current?.focus();
    }
  }

  componentWillUnmount() {
    this.updateOwnerXhr?.abort();
  }

  render() {
    return (
      <div className='beatmap-owner-editor'>
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

        <div className='beatmap-owner-editor__col'>
          {this.renderUsernames()}
        </div>

        <div className='beatmap-owner-editor__col beatmap-owner-editor__col--buttons'>
          {this.renderButtons()}
        </div>
      </div>
    );
  }

  @action
  private readonly handleCancelEditingClick = () => {
    this.editing = false;
    this.showError = false;
  };

  @action
  private readonly handleResetClick = () => {
    if (!confirm(trans('beatmap_discussions.owner_editor.reset_confirm'))) return;

    this.editing = false;
    this.updateOwners([this.props.beatmapset.user_id]);
  };

  private readonly handleSaveClick = () => {
    if (!this.canSave) return;

    this.updateOwners([...this.validUsers.keys()]);
  };

  @action
  private readonly handleStartEditingClick = () => {
    this.editing = true;
    this.shouldFocusInputOnNextRender = true;
  };

  @action
  private readonly handleUsernameInputValueChanged = (value: string) => {
    // field should not be flagged as error on the first lookup.
    // reset showError if input is cleared.
    if (value === '') {
      this.showError = false;
    }

    this.inputUsername = value;
  };

  @action
  private readonly handleValidUsersChanged = (value: Map<number, UserJson>) => {
    this.validUsers = value;
    this.showError = this.inputUsername !== '';
  };

  private renderButtons() {
    if (this.updatingOwner) {
      return <Spinner />;
    }

    const reset = (
      <button
        className='beatmap-owner-editor__button'
        disabled={!hasGuestOwners(this.props.beatmap, this.props.beatmapset)}
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
        <button className='beatmap-owner-editor__button' disabled={!this.canSave} onClick={this.handleSaveClick}>
          <span className='fas fa-fw fa-check' />
        </button>

        <button className='beatmap-owner-editor__button' onClick={this.handleCancelEditingClick}>
          <span className='fas fa-fw fa-times' />
        </button>

        {reset}
      </>
    );
  }

  private readonly renderOwner = (owner: UserJson, onRemoveClick: (user: UserJson) => void) => (
    <BeatmapOwner key={owner.id} editing={this.editing} onRemoveUser={onRemoveClick} user={owner} />
  );

  private renderUsernames() {
    const usernameInputId = `beatmap-owner-editor-username-input-${this.props.beatmap.id}`;

    return (
      <InputContainer
        for={usernameInputId}
        hasError={!this.canSave}
        modifiers='beatmap-owner-editor'
        showError={this.showError}
      >
        <div className={classWithModifiers('beatmap-owner-editor-owners', { editing: this.editing })}>
          {this.editing ? (
            <UsernameInput
              id={usernameInputId}
              initialUsers={this.owners}
              // initialValue not set for owner editor as value is reset when cancelled.
              modifiers='beatmap-owner-editor'
              onEnterPressed={this.handleSaveClick}
              onValidUsersChanged={this.handleValidUsersChanged}
              onValueChanged={this.handleUsernameInputValueChanged}
              renderUser={this.renderOwner}
            />
          ) : (
            this.owners.map((owner) => <BeatmapOwner key={owner.id} editing={this.editing} user={owner} />)
          )}
        </div>
      </InputContainer>
    );
  }

  @action
  private updateOwners(userIds: number[]) {
    this.updateOwnerXhr?.abort();

    if (xor([...this.validUsers.keys()], this.owners.map((owner) => owner.id)).length === 0) {
      this.editing = false;
      return;
    }

    this.updatingOwner = true;

    this.updateOwnerXhr = $.ajax(route('beatmaps.update-owner', { beatmap: this.props.beatmap.id }), {
      data: { user_ids: userIds },
      method: 'POST',
    });
    this.updateOwnerXhr
      .done((beatmapset) => runInAction(() => {
        this.props.discussionsState.update({ beatmapset });
        this.editing = false;
      }))
      .fail(onError)
      .always(action(() => {
        this.updatingOwner = false;
      }));
  }
}
