// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BbcodeEditor } from 'bbcode-editor';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import { route } from 'laroute';
import * as React from 'react';

interface Props {
  beatmapset: BeatmapsetExtendedJson;
}

interface State {
  description?: { bbcode: string; description: string };
  isBusy: boolean;
  isEditing: boolean;
}

interface BbcodeEditorOnChangeParams {
  event: React.MouseEvent<HTMLElement>;
  hasChanged: boolean;
  type: 'cancel' | 'save';
  value: string;
}

export default class Description extends React.PureComponent<Props, State> {
  constructor(props: Props) {
    super(props);

    this.state = {
      isBusy: false,
      isEditing: false,
    };
  }

  render() {
    const canEdit = this.props.beatmapset.description.bbcode !== undefined;
    const description = this.state.description ?? this.props.beatmapset.description;

    return (
      <div className='beatmapset-description'>
        {this.state.isEditing && canEdit ? (
          <BbcodeEditor
            disabled={this.state.isBusy}
            modifiers={['beatmapset-description-editor']}
            onChange={this.onEditorChange}
            rawValue={description.bbcode ?? ''}
          />
        ) : (
          <div className='beatmapset-description__container u-fancy-scrollbar'>
            <div
              className='beatmapset-description__content'
              dangerouslySetInnerHTML={{ __html: description.description ?? '' }}
            />
          </div>
        )}

        {!this.state.isEditing && canEdit && (
          <div className='beatmapset-description__edit-button'>
            <button
              className='btn-circle'
              onClick={this.toggleEditing}
              type='button'
            >
              <span className='btn-circle__content'>
                <i className='fas fa-pencil-alt' />
              </span>
            </button>
          </div>
        )}
      </div>
    );
  }

  private onEditorChange = (action: BbcodeEditorOnChangeParams) => {
    switch (action.type) {
      case 'cancel':
        this.setState({ isEditing: false });
        break;

      case 'save':
        if (action.hasChanged) {
          this.saveDescription(action);
        } else {
          this.setState({ isEditing: false });
        }
    }
  };

  private saveDescription = ({ event, value }: BbcodeEditorOnChangeParams) => {
    this.setState({ isBusy: true });

    void $.ajax(route('beatmapsets.update', { beatmapset: this.props.beatmapset.id }), {
      data: {
        description: value,
      },
      method: 'PATCH',
    }).done((data) => {
      this.setState({
        description: data.description,
        isEditing: false,
      });
    }).fail(() => {
      osu.emitAjaxError(event.target);
    }).always(() => {
      this.setState({ isBusy: false });
    });
  };

  private toggleEditing = () => {
    this.setState({ isEditing: !this.state.isEditing });
  };
}
