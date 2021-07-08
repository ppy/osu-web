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
        <div className='beatmapset-page-cover__image beatmapset-page-cover__image--default' />
        <Img2x
          className='beatmapset-page-cover__image'
          hideOnError
          src={this.props.beatmapset.covers.cover}
        />

        <div className='beatmapset-page-cover__content'>
          <div className='beatmapset-page-cover__content-item beatmapset-page-cover__content-item--left'>
            <div
              className='beatmapset-status beatmapset-status--cover'
              style={{
                '--bg': `var(--beatmapset-${this.props.beatmapset.status}-bg-transparent)`,
                '--colour': `var(--beatmapset-${this.props.beatmapset.status}-colour)`,
              } as React.CSSProperties}
            >
              {osu.trans(`beatmapsets.show.status.${this.props.beatmapset.status}`)}
            </div>

            {this.props.beatmapset.nsfw && (
              <div className='nsfw-badge nsfw-badge--cover'>
                {osu.trans('beatmapsets.nsfw_badge.label')}
              </div>
            )}
          </div>

          <div className='beatmapset-page-cover__content-item beatmapset-page-cover__content-item--right'>
            {this.props.beatmapset.storyboard && (
              <div
                className='beatmapset-status beatmapset-status--show-icon'
                title={osu.trans('beatmapsets.show.info.storyboard')}
              >
                <i className='fas fa-image' />
              </div>
            )}

            <button
              className='beatmapset-page-cover__preview js-audio--play js-audio--player'
              data-audio-url={this.props.beatmapset.preview_url}
              type='button'
            />
          </div>

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
