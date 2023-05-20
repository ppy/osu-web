// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import DiscreteBar from 'components/discrete-bar';
import StringWithComponent from 'components/string-with-component';
import { BeatmapsetJsonForShow } from 'interfaces/beatmapset-extended-json';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const bn = 'beatmapset-hype';

interface Props {
  beatmapset: BeatmapsetJsonForShow;
}

@observer
export default class Hype extends React.Component<Props> {
  private get hype() {
    if (this.props.beatmapset.hype == null) {
      throw new Error('beatmapset is missing hype data');
    }

    return this.props.beatmapset.hype;
  }

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
              {trans(`beatmapsets.show.status.${this.props.beatmapset.status}`)}
            </div>
          </div>
          <p className={`${bn}__description-row ${bn}__description-row--current`}>
            {trans('beatmapsets.show.hype.current._', {
              status: trans(`beatmapsets.show.hype.current.status.${this.props.beatmapset.status}`),
            })}
          </p>
          {this.props.beatmapset.status === 'qualified' ? (
            <p className={`${bn}__description-row ${bn}__description-row--action`}>
              <StringWithComponent
                mappings={{
                  link: <a href={this.reportUrl}>{trans('beatmapsets.show.hype.report.link')}</a>,
                }}
                pattern={this.userCanDisqualify
                  ? trans('beatmapsets.show.hype.disqualify._')
                  : trans('beatmapsets.show.hype.report._')
                }
              />
            </p>
          ) : (
            <p
              className={`${bn}__description-row ${bn}__description-row--action`}
              dangerouslySetInnerHTML={{
                __html: trans('beatmapsets.show.hype.action'),
              }}
            />
          )}
        </div>

        <div className={`${bn}__box ${bn}__box--float`}>
          <div className={`${bn}__lights-header`}>
            <span className={`${bn}__lights-title`}>
              {trans('beatmaps.hype.section_title')}
            </span>
            <span>
              {formatNumber(this.hype.current)}
              {' / '}
              {formatNumber(this.hype.required)}
            </span>
          </div>

          <DiscreteBar
            current={this.hype.current}
            modifiers='beatmapset-hype'
            total={this.hype.required}
          />

          <div
            className={`${bn}__button`}
            title={this.props.beatmapset.current_user_attributes?.can_hype_reason}
          >
            <BigButton
              disabled={core.currentUser != null && !this.props.beatmapset.current_user_attributes.can_hype}
              href={this.hypeUrl}
              icon='fas fa-bullhorn'
              modifiers='full'
              text={trans('beatmaps.hype.button')}
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
      ? [trans('beatmaps.nominations.disqualify'), 'fas fa-thumbs-down']
      : [trans('beatmapsets.show.hype.report.button'), 'fas fa-exclamation-triangle'];

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
