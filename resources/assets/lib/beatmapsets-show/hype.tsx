// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import StringWithComponent from 'components/string-with-component';
import { BeatmapsetJsonForShow } from 'interfaces/beatmapset-extended-json';
import { route } from 'laroute';
import { times } from 'lodash';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';

const bn = 'beatmapset-hype';

interface Props {
  beatmapset: BeatmapsetJsonForShow & { hype: NonNullable<BeatmapsetJsonForShow['hype']> };
}

export default class Hype extends React.PureComponent<Props> {
  private get hypeUrl() {
    return `${route('beatmapsets.discussion', {
      beatmap: '-',
      beatmapset: this.props.beatmapset.id,
      filter: 'praises',
      mode: 'generalAll',
    })}#new`;
  }

  private get reportUrl() {
    return `${route('beatmapsets.discussion', {
      beatmap: '-',
      beatmapset: this.props.beatmapset.id,
      mode: 'generalAll',
    })}#new`;
  }

  private get userCanDisqualify() {
    return core.currentUser != null && (
      core.currentUser.is_moderator
      || core.currentUser.is_admin
      || core.currentUser.is_full_bn
    );
  }

  render() {
    return (
      <div className={bn}>
        <div className={`${bn}__box ${bn}__box--description`}>
          <div className={`${bn}__description-row ${bn}__description-row--status`}>
            <div className='beatmapset-status beatmapset-status--hype'>
              {osu.trans(`beatmapsets.show.status.${this.props.beatmapset.status}`)}
            </div>
          </div>
          <p className={`${bn}__description-row ${bn}__description-row--current`}>
            {osu.trans('beatmapsets.show.hype.current._', {
              status: osu.trans(`beatmapsets.show.hype.current.status.${this.props.beatmapset.status}`),
            })}
          </p>
          {this.props.beatmapset.status === 'qualified' ? (
            <p className={`${bn}__description-row ${bn}__description-row--action`}>
              <StringWithComponent
                mappings={{
                  link: <a href={this.reportUrl}>{osu.trans('beatmapsets.show.hype.report.link')}</a>,
                }}
                pattern={this.userCanDisqualify
                  ? osu.trans('beatmapsets.show.hype.disqualify._')
                  : osu.trans('beatmapsets.show.hype.report._')
                }
              />
            </p>
          ) : (
            <p
              className={`${bn}__description-row ${bn}__description-row--action`}
              dangerouslySetInnerHTML={{
                __html: osu.trans('beatmapsets.show.hype.action'),
              }}
            />
          )}
        </div>

        <div className={`${bn}__box ${bn}__box--float`}>
          <div className={`${bn}__lights-header`}>
            <span className={`${bn}__lights-title`}>
              {osu.trans('beatmaps.hype.section_title')}
            </span>
            <span>
              {formatNumber(this.props.beatmapset.hype.current)}
              {' / '}
              {formatNumber(this.props.beatmapset.hype.required)}
            </span>
          </div>

          <div className={`${bn}__lights`}>
            {times(this.props.beatmapset.hype.required).map((i) => (
              <div
                key={i}
                className={classWithModifiers('bar', [
                  'beatmapset-hype',
                  i < this.props.beatmapset.hype.current ? 'beatmapset-on' : 'beatmapset-off',
                ])}
              />
            ))}
          </div>

          <div
            className={`${bn}__button`}
            title={this.props.beatmapset.current_user_attributes?.can_hype_reason}
          >
            <BigButton
              disabled={core.currentUser != null && !this.props.beatmapset.current_user_attributes.can_hype}
              href={this.hypeUrl}
              icon='fas fa-bullhorn'
              modifiers='full'
              text={osu.trans('beatmaps.hype.button')}
            />
          </div>

          <div className={`${bn}__button`}>{this.renderReportButton()}</div>
        </div>
      </div>
    );
  }

  private renderReportButton() {
    if (this.props.beatmapset.status !== 'qualified') return null;

    const [text, icon] = this.userCanDisqualify
      ? [osu.trans('beatmaps.nominations.disqualify'), 'fas fa-thumbs-down']
      : [osu.trans('beatmapsets.show.hype.report.button'), 'fas fa-exclamation-triangle'];

    return (
      <BigButton
        href={this.reportUrl}
        icon={icon}
        modifiers='full'
        text={text}
      />
    );
  }
}
