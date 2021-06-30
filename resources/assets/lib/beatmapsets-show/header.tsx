// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import Img2x from 'img2x';
import * as React from 'react';

interface Props {
  beatmapset: BeatmapsetJson;
}

export default class Header extends React.PureComponent<Props> {
  render() {
    return (
      <div className='beatmapset-header'>
        <div className='beatmapset-header__cover-container'>
          <Img2x
            className='beatmapset-header__cover'
            src={this.props.beatmapset.covers.cover}
          />

          <div className='beatmapset-header__info-cover'>
            <div
              className='beatmapset-status beatmapset-status--header'
              style={{
                '--bg': `var(--beatmapset-${this.props.beatmapset.status}-bg)`,
                '--colour': `var(--beatmapset-${this.props.beatmapset.status}-colour)`,
              } as React.CSSProperties}
            >
              {osu.trans(`beatmapsets.show.status.${this.props.beatmapset.status}`)}
            </div>
          </div>
        </div>
      </div>
    );
  }
}
