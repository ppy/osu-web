// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageExtraSectionTitle from 'components/profile-page-extra-section-title';
import AchievementJson from 'interfaces/achievement-json';
import UserAchievementJson from 'interfaces/user-achievement-json';
import { keyBy } from 'lodash';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import AchievementBadge from './achievement-badge';
import ExtraHeader from './extra-header';
import ExtraPageProps from './extra-page-props';

interface UserAchievementData {
  achievement: AchievementJson;
  userAchievement?: UserAchievementJson;
}

@observer
export default class Medals extends React.Component<ExtraPageProps> {
  @computed
  private get groupedAchievements() {
    const isCurrentUser = core.currentUser?.id === this.props.controller.state.user.id;

    // group by .grouping and then further group by .ordering
    const ret = new Map<string, Map<number, UserAchievementData[]>>();

    for (const achievement of Object.values(this.props.controller.achievements)) {
      if (achievement == null) continue;

      const userAchievement = this.userAchievements[achievement.id.toString()];
      const visible = this.currentModeFilter(achievement) && (isCurrentUser || userAchievement != null);

      if (visible) {
        let grouped = ret.get(achievement.grouping);
        if (grouped == null) {
          grouped = new Map();
          ret.set(achievement.grouping, grouped);
        }
        let ordered = grouped.get(achievement.ordering);
        if (ordered == null) {
          ordered = [];
          grouped.set(achievement.ordering, ordered);
        }

        ordered.push({ achievement, userAchievement });
      }
    }

    return ret;
  }

  @computed
  private get recentUserAchievements() {
    const ret: Required<UserAchievementData>[] = [];

    for (const ua of this.props.controller.state.user.user_achievements) {
      const achievement = this.props.controller.achievements[ua.achievement_id];

      if (achievement != null && this.currentModeFilter(achievement)) {
        ret.push({
          achievement,
          userAchievement: ua,
        });

        if (ret.length >= 8) {
          break;
        }
      }
    }

    return ret;
  }

  @computed
  private get userAchievements() {
    return keyBy(this.props.controller.state.user.user_achievements, 'achievement_id');
  }

  constructor(props: ExtraPageProps) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />

        {this.recentUserAchievements.length > 0 &&
          <div className='page-extra__recent-medals-box'>
            <ProfilePageExtraSectionTitle titleKey='users.show.extra.medals.recent' />

            <div className='page-extra__recent-medals'>
              {this.recentUserAchievements.map((ua) => (
                <div key={ua.achievement.id} className='page-extra__recent-medal'>
                  <AchievementBadge
                    achievedAt={ua.userAchievement.achieved_at}
                    achievement={ua.achievement}
                    modifiers='dynamic-height'
                  />
                </div>
              ))}
            </div>
          </div>
        }

        {this.groupedAchievements.size > 0 ? (
          <div className='medals-group'>
            {[...this.groupedAchievements.entries()].map(([grouping, groupedAchievements]) => (
              <div key={grouping} className='medals-group__group'>
                <h3 className='medals-group__title'>{grouping}</h3>

                {[...groupedAchievements.entries()].map(([ordering, orderedAchievements]) => (
                  <div key={ordering} className='medals-group__medals'>
                    {orderedAchievements.map((ua) => (
                      <div key={ua.achievement.id} className='medals-group__medal'>
                        <AchievementBadge
                          achievedAt={ua.userAchievement?.achieved_at}
                          achievement={ua.achievement}
                          modifiers='listing'
                        />
                      </div>
                    ))}
                  </div>
                ))}
              </div>
            ))}
          </div>
        ) : (
          osu.trans('users.show.extra.medals.empty')
        )}
      </div>
    );
  }

  private currentModeFilter(achievement: AchievementJson) {
    return achievement.mode == null || achievement.mode === this.props.controller.currentMode;
  }
}
