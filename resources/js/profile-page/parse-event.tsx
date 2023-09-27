// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import EventJson from 'interfaces/event-json';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans, transExists } from 'utils/lang';
import { switchNever } from 'utils/switch-never';
import AchievementBadge from './achievement-badge';

export default function parseEvent(event: EventJson, modifiers: Modifiers): { badge?: React.ReactNode; iconModifiers?: string; mappings?: Record<string, React.ReactNode> } {
  if (event.parse_error) return {};

  switch (event.type) {
    case 'achievement':
      return {
        badge: (
          <AchievementBadge
            achievedAt={event.created_at}
            achievement={event.achievement}
            modifiers={modifiers}
          />
        ),
        mappings: {
          achievement: <strong>{event.achievement.name}</strong>,
          user: <strong><em><a href={event.user.url}>{event.user.username}</a></em></strong>,
        },
      };

    case 'beatmapPlaycount':
      return {
        badge: <span className='fas fa-play' />,
        mappings: {
          beatmap: <a href={event.beatmap.url}>{event.beatmap.title}</a>,
          count: event.count,
        },
      };

    case 'beatmapsetApprove':
      return {
        badge: <span className='fas fa-check' />,
        iconModifiers: event.approval,
        mappings: {
          approval: trans(`events.beatmapset_status.${event.approval}`),
          beatmapset: <a href={event.beatmapset.url}>{event.beatmapset.title}</a>,
          user: <strong><a href={event.user.url}>{event.user.username}</a></strong>,
        },
      };

    case 'beatmapsetDelete': {
      const canView = core.currentUser != null && (core.currentUser.is_bng || core.currentUser.is_moderator);

      return {
        badge: <span className='far fa-trash-alt' />,
        iconModifiers: 'danger',
        mappings: {
          beatmapset: canView
            ? <a href={event.beatmapset.url}>{event.beatmapset.title}</a>
            : event.beatmapset.title,
        },
      };
    }

    case 'beatmapsetRevive':
      return {
        badge: <span className='fas fa-trash-restore' />,
        mappings: {
          beatmapset: <a href={event.beatmapset.url}>{event.beatmapset.title}</a>,
          user: <strong><a href={event.user.url}>{event.user.username}</a></strong>,
        },
      };

    case 'beatmapsetUpdate':
      return {
        badge: <span className='fas fa-sync-alt' />,
        iconModifiers: 'green',
        mappings: {
          beatmapset: <em><a href={event.beatmapset.url}>{event.beatmapset.title}</a></em>,
          user: <strong><em><a href={event.user.url}>{event.user.username}</a></em></strong>,
        },
      };

    case 'beatmapsetUpload':
      return {
        badge: <span className='fas fa-arrow-up' />,
        iconModifiers: 'orange',
        mappings: {
          beatmapset: <a href={event.beatmapset.url}>{event.beatmapset.title}</a>,
          user: <strong><em><a href={event.user.url}>{event.user.username}</a></em></strong>,
        },
      };

    case 'rank': {
      const rankNumber = formatNumber(event.rank);
      // TODO: remove check after all languages are updated to have both `rank` and `value.rank`.
      let rank: React.ReactNode = transExists('events.rank') && !transExists('events.value.rank')
        ? rankNumber
        : (
          <StringWithComponent
            mappings={{ rank: rankNumber }}
            pattern={trans('events.value.rank')}
          />
        );
      if (event.rank <= 50) {
        rank = <strong>{rank}</strong>;
      }

      return {
        badge: <div className={`score-rank score-rank--${event.scoreRank}`} />,
        mappings: {
          beatmap: <em><a href={event.beatmap.url}>{event.beatmap.title}</a></em>,
          mode: trans(`beatmaps.mode.${event.mode}`),
          rank,
          user: <strong><em><a href={event.user.url}>{event.user.username}</a></em></strong>,
        },
      };
    }

    case 'rankLost':
      return {
        badge: <span className='fas fa-angle-double-down' />,
        mappings: {
          beatmap: <em><a href={event.beatmap.url}>{event.beatmap.title}</a></em>,
          mode: trans(`beatmaps.mode.${event.mode}`),
          user: <strong><em><a href={event.user.url}>{event.user.username}</a></em></strong>,
        },
      };

    case 'userSupportAgain':
      return {
        badge: <span className='fas fa-heart' />,
        iconModifiers: 'pink',
        mappings: {
          user: <strong><a href={event.user.url}>{event.user.username}</a></strong>,
        },
      };

    case 'userSupportFirst':
      return {
        badge: <span className='fas fa-heart' />,
        iconModifiers: 'pink',
        mappings: {
          user: <strong><a href={event.user.url}>{event.user.username}</a></strong>,
        },
      };

    case 'userSupportGift':
      return {
        badge: <span className='fas fa-gift' />,
        iconModifiers: 'pink',
        mappings: {
          user: <strong><a href={event.user.url}>{event.user.username}</a></strong>,
        },
      };

    case 'usernameChange':
      return {
        badge: <span className='fas fa-tag' />,
        mappings: {
          previousUsername: <strong>{event.user.previousUsername}</strong>,
          user: <strong><em><a href={event.user.url}>{event.user.username}</a></em></strong>,
        },
      };

    default: {
      switchNever(event);
      return {};
    }
  }
}
