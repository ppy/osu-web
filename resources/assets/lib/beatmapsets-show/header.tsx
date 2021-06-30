// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import Img2x from 'img2x';
import { route } from 'laroute';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import { UserLink } from 'user-link';
import { getArtist, getTitle } from 'utils/beatmap-helper';

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
        </div>
      </div>
    );
  }
}
