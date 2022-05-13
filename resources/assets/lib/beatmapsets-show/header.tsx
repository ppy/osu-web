// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapList from 'beatmap-discussions/beatmap-list';
import StringWithComponent from 'components/string-with-component';
import { UserLink } from 'components/user-link';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import * as React from 'react';
import { getArtist, getTitle } from 'utils/beatmap-helper';
import BeatmapPicker from './beatmap-picker';
import Controller from './controller';

interface Props {
  controller: Controller;
}

@observer
export default class Header extends React.Component<Props> {
  private get controller() {
    return this.props.controller;
  }

  render() {
    return (
      <div className='beatmapset-header'>
        <div className='beatmapset-header__status'>
          <div
            className='beatmapset-status beatmapset-status--header'
            style={{
              '--bg': `var(--beatmapset-${this.controller.currentBeatmap.status}-bg)`,
              '--colour': `var(--beatmapset-${this.controller.currentBeatmap.status}-colour)`,
            } as React.CSSProperties}
          >
            {osu.trans(`beatmapsets.show.status.${this.controller.currentBeatmap.status}`)}
          </div>

          {this.controller.beatmapset.nsfw && (
            <div className='beatmapset-badge beatmapset-badge--header beatmapset-badge--nsfw'>
              {osu.trans('beatmapsets.nsfw_badge.label')}
            </div>
          )}
        </div>

        <div className='beatmapset-header__title-container u-ellipsis-overflow'>
          <div className='beatmapset-header__title u-ellipsis-overflow'>
            <a
              className='beatmapset-header__text-link'
              href={route('beatmapsets.index', { q: getTitle(this.controller.beatmapset) })}
            >
              {getTitle(this.controller.beatmapset)}
            </a>
          </div>

          <div className='beatmapset-header__artist u-ellipsis-overflow'>
            <StringWithComponent
              mappings={{
                artist:
                  <a
                    className='beatmapset-header__text-link'
                    href={route('beatmapsets.index', { q: getArtist(this.controller.beatmapset) })}
                  >
                    {getArtist(this.controller.beatmapset)}
                  </a>,
              }}
              pattern={osu.trans('beatmapsets.show.details.by_artist')}
            />
          </div>
        </div>

        <div className='beatmapset-header__creator'>
          <StringWithComponent
            mappings={{
              creator:
                <UserLink
                  user={{ id: this.controller.beatmapset.user_id, username: this.controller.beatmapset.creator }}
                />,
            }}
            pattern={osu.trans('beatmapsets.show.details.created_by')}
          />
        </div>

        <div className='beatmapset-header__chooser'>
          <div className='beatmapset-header__chooser-list'>
            <BeatmapList
              beatmaps={this.controller.currentBeatmaps}
              beatmapset={this.controller.beatmapset}
              currentBeatmap={this.controller.currentBeatmap}
              large={false}
              modifiers='beatmapset-show'
              onSelectBeatmap={this.onSelectBeatmap}
            />
          </div>

          <div className='beatmapset-header__chooser-picker'>
            <BeatmapPicker controller={this.controller} />
          </div>
        </div>
      </div>
    );
  }

  private onSelectBeatmap = (beatmapId: number) => {
    const selectedBeatmap = this.controller.currentBeatmaps.find((beatmap) => beatmap.id === beatmapId);

    if (selectedBeatmap == null) {
      throw new Error('invalid beatmapId specified');
    }

    this.controller.setCurrentBeatmap(selectedBeatmap);
  };
}
