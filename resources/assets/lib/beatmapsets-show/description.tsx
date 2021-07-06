// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import * as React from 'react';

interface Props {
  beatmapset: BeatmapsetExtendedJson;
}

interface State {
  isEditing: boolean;
}

export default class Description extends React.PureComponent<Props, State> {
  constructor(props: Props) {
    super(props);

    this.state = {
      isEditing: false,
    };
  }

  render() {
    const canEdit = this.props.beatmapset.description.bbcode !== undefined;

    return (
      <div className='beatmapset-description'>
        <div className='beatmapset-description__container u-fancy-scrollbar'>
          <div
            dangerouslySetInnerHTML={{ __html: this.props.beatmapset.description.description ?? '' }}
            className='beatmapset-description__content'
          />
        </div>

        {canEdit && (
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

  private toggleEditing = () => {
    this.setState({ isEditing: !this.state.isEditing });
  };
}
