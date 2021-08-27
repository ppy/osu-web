// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'img2x';
import AchievementJson from 'interfaces/achievement-json';
import UserAchievementJson from 'interfaces/user-achievement-json';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import StringWithComponent from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { classWithModifiers, mergeModifiers, Modifiers } from 'utils/css';
import { nextVal } from 'utils/seq';
import AchievementBadgeIcon from './achievement-badge-icon';

interface AchievementBadgePopupProps {
  achievement: AchievementJson;
  userAchievement?: UserAchievementJson | null;
}

function AchievementBadgePopup({ achievement, userAchievement }: AchievementBadgePopupProps) {
  return (
    <>
      <div className='tooltip-achievement__main'>
        <div className='tooltip-achievement__badge'>
          <AchievementBadgeIcon
            achievement={achievement}
            modifiers={{
              'dynamic-height': true,
              locked: userAchievement == null,
            }}
          />
        </div>

        <div className='tooltip-achievement__grouping'>
          {achievement.grouping}
        </div>

        <div className={classWithModifiers('tooltip-achievement__detail-container', { hoverable: achievement.instructions != null })}>
          <div className='tooltip-achievement__detail tooltip-achievement__detail--normal'>
            <div className='tooltip-achievement__name'>
              {achievement.name}
            </div>
            <div
              className='tooltip-achievement__description'
              dangerouslySetInnerHTML={{ __html: achievement.description }}
            />
          </div>
          {achievement.instructions != null && (
            <div className='tooltip-achievement__detail tooltip-achievement__detail--hover'>
              <div
                className='tooltip-achievement__instructions'
                dangerouslySetInnerHTML={{ __html: achievement.instructions }}
              />
            </div>
          )}
        </div>

        {userAchievement != null ? (
          <div className='tooltip-achievement__date'>
            <StringWithComponent
              mappings={{ date: <TimeWithTooltip dateTime={userAchievement.achieved_at} /> }}
              pattern={osu.trans('users.show.extra.achievements.achieved-on')}
            />
          </div>
        ) : (
          <div className='tooltip-achievement__date'>
            {osu.trans('users.show.extra.achievements.locked')}
          </div>
        )}
      </div>
    </>
  );
}

interface Props {
  achievement: AchievementJson;
  modifiers: Modifiers;
  userAchievement?: UserAchievementJson | null;
}

export default class AchievementBadge extends React.PureComponent<Props> {
  private tooltipId = '';

  render() {
    this.tooltipId = `${this.props.achievement.slug}-${nextVal()}`;

    return (
      <AchievementBadgeIcon
        achievement={this.props.achievement}
        modifiers={mergeModifiers(this.props.modifiers, { locked: this.props.userAchievement == null })}
        onMouseOver={this.onMouseOver}
      />
    );
  }

  private readonly onMouseOver = (event: React.MouseEvent<HTMLImageElement>) => {
    event.persist();
    const elem = event.currentTarget;

    if (elem._tooltip === this.tooltipId) return;

    const $content = $(renderToStaticMarkup(
      <AchievementBadgePopup
        achievement={this.props.achievement}
        userAchievement={this.props.userAchievement}
      />,
    ));

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
