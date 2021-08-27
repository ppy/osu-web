// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AchievementJson from 'interfaces/achievement-json';
import UserAchievementJson from 'interfaces/user-achievement-json';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { mergeModifiers, Modifiers } from 'utils/css';
import { nextVal } from 'utils/seq';
import AchievementBadgeIcon from './achievement-badge-icon';
import AchievementBadgePopup from './achievement-badge-popup';

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
        classes: `tooltip-achievement qtip`,
        tip: {
          height: 20,
          width: 30,
        },
      },
    };

    $(elem).qtip(options, event);
  };
}
