// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';
import { beatmapDownloadDirect } from 'utils/url';
import BigButton from './big-button';

interface DownloadButtonOptions {
  bottomTextKey?: string;
  href: string;
  icon?: string;
  topTextKey?: string;
}

interface Props {
  beatmapset: BeatmapsetExtendedJson;
  currentBeatmap: BeatmapExtendedJson;
  mode: "discussions" | "info";
}

@observer
export default class BeatmapsetDownloadButtons extends React.Component<Props> {
  private get modifiers() {
    return this.props.mode === 'discussions' ? 'full' : 'beatmapset-header';
  }

  render() {
    return (
      <>
        {this.renderDownloadButtons()}
        {this.renderLoginButton()}
      </>
    );
  }

  private downloadButton({ bottomTextKey, href, icon = 'fas fa-download', topTextKey = '_' }: DownloadButtonOptions) {
    return (
      <BigButton
        href={href}
        icon={icon}
        modifiers={this.modifiers}
        text={this.props.mode === 'discussions'
          ? trans(`beatmapsets.show.details.download.${bottomTextKey === 'no-video' ? bottomTextKey : topTextKey}`)
          : {
            bottom: bottomTextKey == null ? undefined : trans(`beatmapsets.show.details.download.${bottomTextKey}`),
            top: trans(`beatmapsets.show.details.download.${topTextKey}`),
          }}
      />
    );
  }

  private renderDownloadButtons() {
    if (core.currentUser == null || this.props.beatmapset.availability.download_disabled) return;

    const legacyScoreOnly = core.userPreferences.get('legacy_score_only');

    return (
      <>
        {this.props.beatmapset.video ? (
          <>
            {this.downloadButton({
              bottomTextKey: 'video',
              href: route('beatmapsets.download', { beatmapset: this.props.beatmapset.id }),
            })}

            {this.downloadButton({
              bottomTextKey: 'no-video',
              href: route('beatmapsets.download', { beatmapset: this.props.beatmapset.id, noVideo: 1 }),
            })}
          </>
        ) : (this.downloadButton({
          href: route('beatmapsets.download', { beatmapset: this.props.beatmapset.id }),
        }))}

        {this.downloadButton({
          href: core.currentUser.is_supporter || !legacyScoreOnly
            ? beatmapDownloadDirect(this.props.currentBeatmap.id)
            : route('support-the-game'),
          topTextKey: legacyScoreOnly ? 'direct' : 'lazer',
        })}
      </>
    );
  }

  private renderLoginButton() {
    if (core.currentUser != null) return;

    return (
      <BigButton
        extraClasses={['js-user-link']}
        icon='fas fa-lock'
        modifiers={this.modifiers}
        text={{
          bottom: trans('beatmapsets.show.details.login_required.bottom'),
          top: trans('beatmapsets.show.details.login_required.top'),
        }}
      />
    );
  }
}
