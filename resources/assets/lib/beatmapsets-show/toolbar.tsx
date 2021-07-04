// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BigButton } from 'big-button';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import { route } from 'laroute';
import OsuUrlHelper from 'osu-url-helper';
import * as React from 'react';

interface Props {
  beatmapset: BeatmapsetExtendedJson;
  currentBeatmap: BeatmapJsonExtended;
}

interface DownloadButtonProps {
  bottomTextKey?: string;
  href: string;
  icon?: string;
  key: React.Key;
  osuDirect?: boolean;
  topTextKey?: string;
}

const DownloadButton = ({
  bottomTextKey,
  href,
  key,
  osuDirect = false,
  topTextKey = '_',
}: DownloadButtonProps) => (
  <BigButton
    key={key}
    extraClasses={!osuDirect ? ['js-beatmapset-download-link'] : undefined}
    modifiers={['beatmapset-toolbar']}
    props={{
      'data-turbolinks': false,
      href,
    }}
    text={{
      bottom: bottomTextKey && osu.trans(`beatmapsets.show.details.download.${bottomTextKey}`),
      top: osu.trans(`beatmapsets.show.details.download.${topTextKey}`),
    }}
  />
);

export default class Toolbar extends React.PureComponent<Props> {
  render() {
    return (
      <div className='beatmapset-toolbar'>
        <div className='beatmapset-toolbar__count'>
          <div>
            <div>
              {osu.trans('beatmapsets.show.details.count.total_play')}
            </div>
            <div className='beatmapset-toolbar__count-value'>
              {osu.formatNumber(this.props.beatmapset.play_count)}
            </div>
          </div>

          <div>
            <div>
              {osu.trans('beatmapsets.show.details.count.diff_play')}
            </div>
            <div className='beatmapset-toolbar__count-value'>
              {osu.formatNumber(this.props.currentBeatmap.playcount)}
            </div>
          </div>
        </div>

        <div className='beatmapset-toolbar__buttons'>
          {this.renderDownloadButtons()}
        </div>
      </div>
    );
  }

  renderDownloadButtons() {
    if (currentUser.id && !this.props.beatmapset.availability?.download_disabled) {
      return (
        <>
          {this.props.beatmapset.video ? (
            <>
              <DownloadButton
                key='video'
                bottomTextKey='video'
                href={route('beatmapsets.download', { beatmapset: this.props.beatmapset.id })}
              />
              <DownloadButton
                key='no-video'
                bottomTextKey='no-video'
                href={route('beatmapsets.download', { beatmapset: this.props.beatmapset.id, noVideo: 1 })}
              />
            </>
          ) : (
            <DownloadButton
              key='default'
              href={route('beatmapsets.download', { beatmapset: this.props.beatmapset.id })}
            />
          )}

          <DownloadButton
            key='direct'
            href={currentUser.is_supporter
              ? OsuUrlHelper.beatmapDownloadDirect(this.props.currentBeatmap.id)
              : route('support-the-game')
            }
            osuDirect
            topTextKey='direct'
          />
        </>
      );
    }
  }
}
