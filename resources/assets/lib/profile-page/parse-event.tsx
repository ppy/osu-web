// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import EventJson from 'interfaces/event-json';
import * as React from 'react';
import { Modifiers } from 'utils/css';
import { trans } from 'utils/lang';
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

    case 'beatmapsetDelete':
      return {
        badge: <span className='far fa-trash-alt' />,
        iconModifiers: 'danger',
        mappings: {
          beatmapset: event.beatmapset.title,
        },
      };

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

    case 'rank':
      return {
        badge: <div className={`score-rank score-rank--${event.scoreRank}`} />,
        mappings: {
          beatmap: <em><a href={event.beatmap.url}>{event.beatmap.title}</a></em>,
          mode: trans(`beatmaps.mode.${event.mode}`),
          rank: event.rank,
          user: <strong><em><a href={event.user.url}>{event.user.username}</a></em></strong>,
        },
      };

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
