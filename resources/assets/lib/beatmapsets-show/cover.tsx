// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'img2x';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  beatmapset: BeatmapsetExtendedJson;
}

@observer
export default class Cover extends React.Component<Props> {
  render() {
    const expanded = core.userPreferences.get('beatmapset_cover_expanded');

    return (
      <div className={classWithModifiers('beatmapset-page-cover', { expanded })}>
        <Img2x
          className='beatmapset-page-cover__image'
          src={this.props.beatmapset.covers.cover}
        />

        <div className='beatmapset-page-cover__content'>
          <div
            className='beatmapset-status beatmapset-status--show'
            style={{
              '--bg': `var(--beatmapset-${this.props.beatmapset.status}-bg-transparent)`,
              '--colour': `var(--beatmapset-${this.props.beatmapset.status}-colour)`,
            } as React.CSSProperties}
          >
            {osu.trans(`beatmapsets.show.status.${this.props.beatmapset.status}`)}
          </div>

          <button
            className='beatmapset-page-cover__preview js-audio--play js-audio--player'
            data-audio-url={this.props.beatmapset.preview_url}
            type='button'
          />

          <div className='beatmapset-page-cover__toggle'>
            <button
              className='page-toggle page-toggle--beatmapset-cover'
              onClick={this.toggleExpand}
              title={osu.trans(`common.buttons.${expanded ? 'collapse' : 'expand'}`)}
            >
              <span className={`fas fa-chevron-${expanded ? 'up' : 'down'}`} />
            </button>
          </div>
        </div>
      </div>
    );
  }

  private toggleExpand = () => {
    void core.userPreferences.set('beatmapset_cover_expanded', !core.userPreferences.get('beatmapset_cover_expanded'));
  };
}
