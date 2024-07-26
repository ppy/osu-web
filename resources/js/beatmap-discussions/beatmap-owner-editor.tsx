// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import UsernameInput from 'components/username-input';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { normaliseUsername } from 'models/user';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import BeatmapMapper from './beatmap-mapper';
import DiscussionsState from './discussions-state';

interface XhrCollection {
  updateOwner: JQuery.jqXHR<BeatmapsetWithDiscussionsJson>;
}

interface Props {
  beatmap: BeatmapJson;
  beatmapset: BeatmapsetExtendedJson;
  discussionsState: DiscussionsState; // only for updating the state with the response.
  mappers: UserJson[];
}

@observer
export default class BeatmapOwnerEditor extends React.Component<Props> {
  @observable private editing = false;
  private readonly inputRef = React.createRef<HTMLInputElement>();
  @observable private inputUsername = '';
  private shouldFocusInputOnNextRender = false;
  @observable private updatingOwner = false;
  @observable private validUsers = new Map<number, UserJson>();
  private readonly xhr: Partial<XhrCollection> = {};

  private get canSave() {
    return this.validUsers.size > 0 && normaliseUsername(this.inputUsername).length === 0;
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
    this.inputUsername = value;
  };

  @action
  private readonly handleValidUsersChanged = (value: Map<number, UserJson>) => {
    this.validUsers = value;
  };

  private renderButtons() {
    if (this.updatingOwner) {
      return <Spinner />;
    }

    const reset = (
      <button
        className='beatmap-owner-editor__button'
        disabled={this.props.beatmap.user_id === this.props.beatmapset.user_id}
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

  private readonly renderMapper = (mapper: UserJson, onRemoveClick: (user: UserJson) => void) => (
    <BeatmapMapper key={mapper.id} onRemoveUser={onRemoveClick} user={mapper} />
  );

  private renderUsernames() {
    if (!this.editing) {
      return this.props.mappers.map((mapper) => <BeatmapMapper key={mapper.id} user={mapper} />);
    }

    return (
      <UsernameInput
        initialUsers={this.props.mappers}
        // initialValue not set for owner editor as value is reset when cancelled.
        modifiers='beatmap-owner-editor'
        onEnterPressed={this.handleSaveClick}
        onValidUsersChanged={this.handleValidUsersChanged}
        onValueChanged={this.handleUsernameInputValueChanged}
        renderUser={this.renderMapper}
      />
    );
  }

  @action
  private updateOwners(userIds: number[]) {
    this.xhr.updateOwner?.abort();

    // TODO: handle no change case?
    // if (this.props.beatmap.user_id === userId) {
    //   this.editing = false;

    //   return;
    // }

    this.updatingOwner = true;

    this.xhr.updateOwner = $.ajax(route('beatmaps.update-owner', { beatmap: this.props.beatmap.id }), {
      data: { user_ids: userIds },
      method: 'PUT',
    });
    this.xhr.updateOwner
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
