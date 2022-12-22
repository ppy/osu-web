// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import Controller from './controller';

interface Props {
  controller: Controller;
}

@observer
export default class Cover extends React.Component<Props> {
  render() {
    const expanded = core.userPreferences.get('beatmapset_cover_expanded');

    return (
      <div className={classWithModifiers('beatmapset-page-cover', { expanded })}>
        <BeatmapsetCover
          beatmapset={this.props.controller.beatmapset}
          forceShowVisual // check already covered by parent component
          modifiers={['full', 'rect']}
          size='cover'
        />

        <div className='beatmapset-page-cover__content'>
          <div className='beatmapset-page-cover__content-item beatmapset-page-cover__content-item--left'>
            <div
              className='beatmapset-status beatmapset-status--cover'
              style={{
                '--bg': `var(--beatmapset-${this.props.controller.currentBeatmap.status}-bg-transparent)`,
                '--colour': `var(--beatmapset-${this.props.controller.currentBeatmap.status}-colour)`,
              } as React.CSSProperties}
            >
              {trans(`beatmapsets.show.status.${this.props.controller.currentBeatmap.status}`)}
            </div>

            {this.props.controller.beatmapset.nsfw && (
              <div className='beatmapset-badge beatmapset-badge--cover beatmapset-badge--nsfw'>
                {trans('beatmapsets.nsfw_badge.label')}
              </div>
            )}
          </div>

          <div className='beatmapset-page-cover__content-item beatmapset-page-cover__content-item--right'>
            {this.props.controller.beatmapset.storyboard && (
              <div
                className='beatmapset-status beatmapset-status--show-icon'
                title={trans('beatmapsets.show.info.storyboard')}
              >
                <i className='fas fa-image' />
              </div>
            )}

            <button
              className='beatmapset-page-cover__preview js-audio--play js-audio--player'
              data-audio-url={this.props.controller.beatmapset.preview_url}
              type='button'
            >
              <span className='play-button' />
            </button>
          </div>

          <div className='beatmapset-page-cover__toggle'>
            <button
              className='beatmapset-page-cover__preview beatmapset-page-cover__preview--circle'
              onClick={this.toggleExpand}
              title={trans(`common.buttons.${expanded ? 'collapse' : 'expand'}`)}
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
