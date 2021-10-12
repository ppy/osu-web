// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { snakeCase } from 'lodash';
import AchievementBadge from 'profile-page/achievement-badge';
import ExtraHeader from 'profile-page/extra-header';
import { Event, isTypeOf } from 'profile-page/recent-activity-events';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import StringWithComponent from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';

interface Props {
  name: string;
  pagination: unknown;
  recentActivity: Event[];
  withEdit: boolean;
}

interface RenderEntryValues {
  badge: React.ReactNode;
  mappings: React.ReactNode;
}

function link(url: string, title: string) {
  return <a className='profile-extra-entries__link' href={url}>{title}</a>;
}

export default class RecentActivity extends React.PureComponent<Props> {
  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.withEdit} />
        {this.props.recentActivity.length > 0 ? this.renderEntries() : this.renderEmpty()}
      </div>
    );
  }

  private parseEvent(event: Event): RenderEntryValues {
    let badge: React.ReactNode = null;
    let mappings: Record<string, React.ReactNode> = {};

    if (isTypeOf(event, 'achievement')) {
      badge = (
        <AchievementBadge
          achievement={event.achievement}
          modifiers={['recent-activity']}
          userAchievement={{
            achieved_at: event.created_at,
            achievement_id: event.achievement.id,
          }}
        />
      );

      mappings = {
        achievement: <strong>{event.achievement.name}</strong>,
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
      };
    } else if (isTypeOf(event, 'beatmapPlaycount')) {
      mappings = {
        beatmap: link(event.beatmap.url, event.beatmap.title),
        count: event.count,
      };
    } else if (isTypeOf(event, 'beatmapsetApprove')) {
      mappings = {
        approval: osu.trans(`events.beatmapset_status.${event.approval}`),
        beatmapset: link(event.beatmapset.url, event.beatmapset.title),
        user: <strong>{link(event.user.url, event.user.username)}</strong>,
      };
    } else if (isTypeOf(event, 'beatmapsetDelete')) {
      mappings = {
        beatmapset: event.beatmapset.title,
      };
    } else if (isTypeOf(event, 'beatmapsetRevive')) {
      mappings = {
        beatmapset: link(event.beatmapset.url, event.beatmapset.title),
        user: <strong>{link(event.user.url, event.user.username)}</strong>,
      };
    } else if (isTypeOf(event, 'beatmapsetUpdate')) {
      mappings = {
        beatmapset: <em>{link(event.beatmapset.url, event.beatmapset.title)}</em>,
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
      };
    } else if (isTypeOf(event, 'beatmapsetUpload')) {
      mappings = {
        beatmapset: link(event.beatmapset.url, event.beatmapset.title),
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
      };
    } else if (isTypeOf(event, 'rank')) {
      badge = <div className={`score-rank score-rank--${event.scoreRank}`} />

      mappings = {
        beatmap: <em>{link(event.beatmap.url, event.beatmap.title)}</em>,
        mode: osu.trans(`beatmaps.mode.${event.mode}`),
        rank: event.rank,
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
      };
    } else if (isTypeOf(event, 'rankLost')) {
      mappings = {
        beatmap: <em>{link(event.beatmap.url, event.beatmap.title)}</em>,
        mode: osu.trans(`beatmaps.mode.${event.mode}`),
        rank: event.rank,
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,

      };
    } else if (isTypeOf(event, 'userSupportAgain')) {
      mappings = {
        user: <strong>{link(event.user.url, event.user.username)}</strong>,
      };
    } else if (isTypeOf(event, 'userSupportFirst')) {
      mappings = {
        user: <strong>{link(event.user.url, event.user.username)}</strong>,
      };
    } else if (isTypeOf(event, 'userSupportGift')) {
      mappings = {
        user: <strong>{link(event.user.url, event.user.username)}</strong>,
      };
    } else if (isTypeOf(event, 'usernameChange')) {
      mappings = {
        previousUsername: <strong>{event.user.previousUsername}</strong>,
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
      };
    }

    return { badge, mappings };
  }

  private renderEmpty() {
    return <p className='profile-extra-entries'>{osu.trans('events.empty')}</p>;
  }

  private renderEntries() {
    return (
      <div>
        <ul className='profile-extra-entries'>
          {this.props.recentActivity.map(this.renderEntry)}
        </ul>
        <div className='profile-extra-entries__item'>
          <ShowMoreLink
            data={{
              name: 'recentActivity',
              url: route('users.recent-activity', { user: this.props.user.id }),
            }}
            event='profile:showMore'
            hasMore={this.props.pagination.recentActivity.hasMore}
            loading={this.props.pagination.recentActivity.loading}
            modifiers={['profile-page', 't-greyseafoam-dark']}

          />
        </div>
      </div>
    );
  }

  private renderEntry = (event: Event) => {
    if (event.parse_error) return null;

    const { badge, mappings } = this.parseEvent(event);

    return (
      <li key={event.id} className='profile-extra-entries__item'>
        <div className='profile-extra-entries__detail'>
          <div className='profile-extra-entries__icon'>
            {badge ?? null}
          </div>
          <div className='profile-extra-entries__text'>
            <StringWithComponent
              mappings={mappings ?? {}}
              pattern={osu.trans(`events.${snakeCase(event.type)}`).replace(/<[^>]*>/g, '')}
            />
          </div>
        </div>
        <div className='profile-extra-entries__time'>
          <TimeWithTooltip dateTime={event.created_at} relative />
        </div>
      </li>
    );
  };
}
