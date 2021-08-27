// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'img2x';
import GameMode from 'interfaces/game-mode';
import * as React from 'react';
import StringWithComponent from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { classWithModifiers, Modifiers } from 'utils/css';
import { nextVal } from 'utils/seq';

interface AchievementJson {
  description: string;
  grouping: string;
  icon_url: string;
  id: number;
  instructions: string | null;
  mode: GameMode;
  name: string;
  ordering: number;
  slug: string;
}

interface UserAchievementJson {
  achieved_at: string;
  achievement_id: number;
}

interface Props {
  achievement: AchievementJson;
  modifiers: Modifiers;
  userAchievement?: UserAchievementJson | null;
}

export default class AchievementBadge extends React.PureComponent<Props> {
  private readonly tooltip = React.createRef<HTMLDivElement>();
  private tooltipId = '';

  render() {
    this.tooltipId = `${this.props.achievement.slug}-${nextVal()}`;

    const lockedModifier = { locked: this.props.userAchievement == null };
    const badgeClass = classWithModifiers('badge-achievement', this.props.modifiers, lockedModifier);
    const tooltipBadgeClass = classWithModifiers('badge-achievement', 'dynamic-height',  lockedModifier);

    return (
      <div className={`js-tooltip-achievement ${badgeClass}`}>
        <Img2x
          alt={this.props.achievement.name}
          className='badge-achievement__image'
          onMouseOver={this.onMouseOver}
          src={this.props.achievement.icon_url}
        />

        <div className='hidden'>
          <div
            ref={this.tooltip}
            className='js-tooltip-achievement--content tooltip-achievement__main'
          >
            <div className='tooltip-achievement__badge'>
              <div className={tooltipBadgeClass}>
                <Img2x
                  alt={this.props.achievement.name}
                  className='badge-achievement__image'
                  src={this.props.achievement.icon_url}
                />
              </div>
            </div>

            <div className='tooltip-achievement__grouping'>
              {this.props.achievement.grouping}
            </div>

            <div className={classWithModifiers('tooltip-achievement__detail-container', { hoverable: this.props.achievement.instructions != null })}>
              <div className='tooltip-achievement__detail tooltip-achievement__detail--normal'>
                <div className='tooltip-achievement__name'>
                  {this.props.achievement.name}
                </div>
                <div
                  className='tooltip-achievement__description'
                  dangerouslySetInnerHTML={{ __html: this.props.achievement.description }}
                />
              </div>
              {this.props.achievement.instructions != null && (
                <div className='tooltip-achievement__detail tooltip-achievement__detail--hover'>
                  <div
                    className='tooltip-achievement__instructions'
                    dangerouslySetInnerHTML={{ __html: this.props.achievement.instructions }}
                  />
                </div>
              )}
            </div>

            {this.props.userAchievement != null ? (
              <div className='tooltip-achievement__date'>
                <StringWithComponent
                  mappings={{ date: <TimeWithTooltip dateTime={this.props.userAchievement.achieved_at} /> }}
                  pattern={osu.trans('users.show.extra.achievements.achieved-on')}
                />
              </div>
            ) : (
              <div className='tooltip-achievement__date'>
                {osu.trans('users.show.extra.achievements.locked')}
              </div>
            )}
          </div>
        </div>
      </div>
    );
  }

  private readonly onMouseOver = (event: React.MouseEvent<HTMLImageElement>) => {
    event.persist();
    const elem = event.currentTarget;

    if (elem._tooltip === this.tooltipId) return;

    if (this.tooltip.current == null) throw new Error('tooltip content is missing');

    const $content = $(this.tooltip.current).clone();

    if (elem._tooltip != null) {
      elem._tooltip = this.tooltipId;
      $(elem).qtip('set', { 'content.text': $content });
      return;
    }

    elem._tooltip = this.tooltipId;
    const classes = classWithModifiers('qtip tooltip-achievement', { locked: this.props.userAchievement == null });

    const options = {
      content: $content,
      hide: {
        delay: 200,
        fixed: true,
      },
      overwrite: false,
      position: {
        adjust: {
          scroll: false,
        },
        at: 'top center',
        my: 'bottom center',
        viewport: $(window),
      },
      show: {
        delay: 200,
        event: event.type,
        ready: true,
      },
      style: {
        classes: `${classes} qtip`,
        tip: {
          height: 20,
          width: 30,
        },
      },
    };

    $(elem).qtip(options, event);
  };
}
