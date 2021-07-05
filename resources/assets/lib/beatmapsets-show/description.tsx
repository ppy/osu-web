// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import * as React from 'react';

interface Props {
  beatmapset: BeatmapsetExtendedJson;
}

export default class Description extends React.PureComponent<Props> {
  render() {
    return (
      <div className='beatmapset-description'>
        <div className='beatmapset-description__container u-fancy-scrollbar'>
          <div
            dangerouslySetInnerHTML={{ __html: this.props.beatmapset.description.description ?? '' }}
            className='beatmapset-description__content'
          />
        </div>
      </div>
    );
  }
}
