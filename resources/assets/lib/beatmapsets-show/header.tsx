// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import Img2x from 'img2x';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import GameMode from 'interfaces/game-mode';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import { UserLink } from 'user-link';
import { getArtist, getTitle } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import BeatmapPicker from './beatmap-picker';

interface Props {
  beatmaps: Map<GameMode, BeatmapJsonExtended[]>;
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJsonExtended;
}

@observer
export default class Header extends React.Component<Props> {
  render() {
    const expanded = core.userPreferences.get('beatmapset_cover_expanded');

    return (
      <div className='beatmapset-header'>
        <div className={classWithModifiers('beatmapset-header__cover-container', { expanded })}>
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

            <button
              className='beatmapset-header__preview js-audio--play js-audio--player'
              data-audio-url={this.props.beatmapset.preview_url}
              type='button'
            />

            <div className='beatmapset-header__page-toggle'>
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

        <div className='beatmapset-header__details'>
          <div className='beatmapset-header__details-item beatmapset-header__details-item--artist-title u-ellipsis-overflow'>
            <span className='beatmapset-header__details-text beatmapset-header__details-text--title'>
              <a
                className='beatmapset-header__details-text-link'
                href={route('beatmapsets.index', { q: getTitle(this.props.beatmapset) })}
              >
                {getTitle(this.props.beatmapset)}
              </a>
            </span>

            <span className='beatmapset-header__details-text beatmapset-header__details-text--artist'>
              <StringWithComponent
                mappings={{
                  ':artist':
                    <a
                      key='artist'
                      className='beatmapset-header__details-text-link'
                      href={route('beatmapsets.index', { q: getArtist(this.props.beatmapset) })}
                    >
                      {getArtist(this.props.beatmapset)}
                    </a>,
                }}
                pattern={osu.trans('beatmapsets.show.details.by_artist')}
              />
            </span>
          </div>


          <div className='beatmapset-header__details-item beatmapset-header__details-item--creator u-ellipsis-overflow'>
            <StringWithComponent
              mappings={{
                ':creator':
                  <UserLink
                    key='creator'
                    user={{ id: this.props.beatmapset.user_id, username: this.props.beatmapset.creator }}
                  />,
              }}
              pattern={osu.trans('beatmapsets.show.details.created_by')}
            />
          </div>

          <div className='beatmapset-header__details-item beatmapset-header__details-item--picker'>
            <BeatmapPicker
              beatmaps={this.props.beatmaps.get(this.props.currentBeatmap.mode) ?? ([] as BeatmapJsonExtended[])}
              currentBeatmap={this.props.currentBeatmap}
            />
          </div>
        </div>
      </div>
    );
  }

  private toggleExpand = () => {
    void core.userPreferences.set('beatmapset_cover_expanded', !core.userPreferences.get('beatmapset_cover_expanded'));
  };
}
