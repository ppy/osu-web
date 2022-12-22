// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapListItem from 'components/beatmap-list-item';
import StringWithComponent from 'components/string-with-component';
import { UserLink } from 'components/user-link';
import { observer } from 'mobx-react';
import * as React from 'react';
import { formatDuration, formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import Controller from './controller';
import CountBadge from './count-badge';
import Extra from './extra';
import Metadata from './metadata';
import Stats from './stats';

interface Props {
  controller: Controller;
}

@observer
export default class Info extends React.Component<Props> {
  render() {
    const showedBeatmap = this.props.controller.hoveredBeatmap ?? this.props.controller.currentBeatmap;

    return (
      <div className='beatmapset-info'>
        <div className='beatmapset-info__item beatmapset-info__item--diff'>
          <div className='beatmapset-info__diff-detail'>
            <BeatmapListItem beatmap={showedBeatmap} />

            {' '}
            <span className='beatmapset-info__diff-mapper u-ellipsis-overflow'>
              <StringWithComponent
                mappings={{
                  mapper: <UserLink user={this.props.controller.mapper(showedBeatmap)} />,
                }}
                pattern={trans('beatmapsets.show.details.mapped_by')}
              />
            </span>
          </div>

          <CountBadge
            data={{
              length: formatDuration(showedBeatmap.total_length),
              song_bpm: showedBeatmap.bpm > 1000 ? '∞' : formatNumber(showedBeatmap.bpm),
            }}
            modifiers='length-bpm'
          />
        </div>

        <div className='beatmapset-info__item beatmapset-info__item--stats'>
          <Metadata controller={this.props.controller} />
          <div className='beatmapset-info__line' />
          <Stats controller={this.props.controller} />
          <div className='beatmapset-info__line beatmapset-info__line--mobile' />
          <Extra controller={this.props.controller} />
        </div>
      </div>
    );
  }
}
