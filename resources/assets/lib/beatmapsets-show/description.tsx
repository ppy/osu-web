// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BbcodeEditor, { OnChangeProps } from 'components/bbcode-editor';
import { BeatmapsetJsonForShow } from 'interfaces/beatmapset-extended-json';
import { route } from 'laroute';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithClick } from 'utils/ajax';
import Controller from './controller';

interface Props {
  controller: Controller;
}

@observer
export default class Description extends React.Component<Props> {
  @observable private isEditing = false;
  @observable private xhr: JQuery.jqXHR<BeatmapsetJsonForShow> | null = null;

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    const canEdit = this.props.controller.beatmapset.description.bbcode !== undefined;
    const description = this.props.controller.beatmapset.description;

    return (
      <div className='page-extra page-extra--userpage'>
        {!this.isEditing && canEdit && (
          <div className='page-extra__actions'>
            <button
              className='btn-circle btn-circle--page-toggle'
              onClick={this.onStartEditClick}
              type='button'
            >
              <span className='fas fa-pencil-alt' />
            </button>
          </div>
        )}

        {this.isEditing && canEdit ? (
          <BbcodeEditor
            disabled={this.xhr != null}
            modifiers='profile-page'
            onChange={this.onEditorChange}
            rawValue={description.bbcode ?? ''}
          />
        ) : (
          <div className='page-extra__content-overflow-wrapper-outer u-fancy-scrollbar'>
            <div
              className='page-extra__content-overflow-wrapper-inner'
              dangerouslySetInnerHTML={{ __html: description.description ?? '' }}
            />
          </div>
        )}

      </div>
    );
  }

  @action
  private onEditorChange = (change: OnChangeProps) => {
    switch (change.type) {
      case 'cancel':
        this.isEditing = false;
        break;

      case 'save':
        if (change.hasChanged) {
          this.saveDescription(change);
        } else {
          this.isEditing = false;
        }
        break;
    }
  };

  @action
  private readonly onStartEditClick = () => {
    this.isEditing = true;
  };

  private readonly saveDescription = ({ event, value }: OnChangeProps) => {
    if (this.xhr != null) return;

    this.xhr = $.ajax(route('beatmapsets.update', { beatmapset: this.props.controller.beatmapset.id }), {
      data: { description: value },
      method: 'PATCH',
    });

    this.xhr.done((beatmapset) => runInAction(() => {
      this.isEditing = false;
      this.props.controller.state.beatmapset = beatmapset;
    })).fail(
      onErrorWithClick(event?.target),
    ).always(action(() => {
      this.xhr = null;
    }));
  };
}
