// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import StringWithComponent from 'components/string-with-component';
import { UserLink } from 'components/user-link';
import BeatmapPlaycountJson from 'interfaces/beatmap-playcount-json';
import GameMode from 'interfaces/game-mode';
import * as React from 'react';
import { getArtist, getTitle } from 'utils/beatmap-helper';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { beatmapUrl } from 'utils/url';

const bn = 'beatmap-playcount';

interface Props {
  currentMode: GameMode;
  playcount: BeatmapPlaycountJson;
}

export default class BeatmapPlaycount extends React.PureComponent<Props> {
  render() {
    const beatmap = this.props.playcount.beatmap;
    const beatmapset = this.props.playcount.beatmapset;

    if (beatmap == null || beatmapset == null) {
      throw new Error('playcount JSON is missing beatmap or beatmapset include');
    }

    const url = beatmapUrl(beatmap, this.props.currentMode);

    return (
      <div className={bn}>
        <a className={`${bn}__cover`} href={url}>
          <BeatmapsetCover beatmapset={beatmapset} modifiers='full' size='list' />
          <div className={`${bn}__cover-count`}>
            {this.renderPlaycountText()}
          </div>
        </a>
        <div className={`${bn}__detail`}>
          <div className={`${bn}__info`}>
            <div className={`${bn}__info-row u-ellipsis-overflow`}>
              <a className={`${bn}__title`} href={url}>
                {`${getTitle(beatmapset)} [${beatmap.version}] `}
                <span className={`${bn}__title-artist`}>
                  {trans('users.show.extra.beatmaps.by_artist', { artist: getArtist(beatmapset) })}
                </span>
              </a>
            </div>
            <div className={`${bn}__info-row u-ellipsis-overflow`}>
              <span className={`${bn}__artist`}>
                <StringWithComponent
                  mappings={{
                    artist: <strong>{getArtist(beatmapset)}</strong>,
                  }}
                  pattern={trans('users.show.extra.beatmaps.by_artist')}
                />
              </span>
              {' ' /* separator for overflow tooltip */}
              <span className={`${bn}__mapper`}>
                <StringWithComponent
                  mappings={{
                    mapper: (
                      <UserLink
                        className={`${bn}__mapper-link`}
                        user={{
                          id: beatmapset.user_id,
                          username: beatmapset.creator,
                        }}
                      />
                    ),
                  }}
                  pattern={trans('beatmapsets.show.details.mapped_by')}
                />
              </span>
            </div>
          </div>

          <div className={`${bn}__detail-count`}>
            {this.renderPlaycountText()}
          </div>
        </div>
      </div>
    );
  }

  private renderPlaycountText() {
    return (
      <div
        className={`${bn}__count`}
        title={trans('users.show.extra.historical.most_played.count')}
      >
        <span className={`${bn}__count-icon`}>
          <span className='fas fa-play' />
        </span>
        {formatNumber(this.props.playcount.count)}
      </div>
    );
  }
}
