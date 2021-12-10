// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import EventJson from 'interfaces/event-json';
import * as React from 'react';
import { Modifiers } from 'utils/css';
import { switchNever } from 'utils/switch-never';
import AchievementBadge from './achievement-badge';

export default function parseEvent(event: EventJson, modifiers: Modifiers): { badge?: React.ReactNode; mappings?: Record<string, React.ReactNode> } {
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
        mappings: {
          beatmap: <a href={event.beatmap.url}>{event.beatmap.title}</a>,
          count: event.count,
        },
      };

    case 'beatmapsetApprove':
      return {
        mappings: {
          approval: osu.trans(`events.beatmapset_status.${event.approval}`),
          beatmapset: <a href={event.beatmapset.url}>{event.beatmapset.title}</a>,
          user: <strong><a href={event.user.url}>{event.user.username}</a></strong>,
        },
      };

    case 'beatmapsetDelete':
      return {
        mappings: {
          beatmapset: event.beatmapset.title,
        },
      };

    case 'beatmapsetRevive':
      return {
        mappings: {
          beatmapset: <a href={event.beatmapset.url}>{event.beatmapset.title}</a>,
          user: <strong><a href={event.user.url}>{event.user.username}</a></strong>,
        },
      };

    case 'beatmapsetUpdate':
      return {
        mappings: {
          beatmapset: <em><a href={event.beatmapset.url}>{event.beatmapset.title}</a></em>,
          user: <strong><em><a href={event.user.url}>{event.user.username}</a></em></strong>,
        },
      };

    case 'beatmapsetUpload':
      return {
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
          mode: osu.trans(`beatmaps.mode.${event.mode}`),
          rank: event.rank,
          user: <strong><em><a href={event.user.url}>{event.user.username}</a></em></strong>,
        },
      };

    case 'rankLost':
      return {
        mappings: {
          beatmap: <em><a href={event.beatmap.url}>{event.beatmap.title}</a></em>,
          mode: osu.trans(`beatmaps.mode.${event.mode}`),
          user: <strong><em><a href={event.user.url}>{event.user.username}</a></em></strong>,
        },
      };

    case 'userSupportAgain':
      return {
        mappings: {
          user: <strong><a href={event.user.url}>{event.user.username}</a></strong>,
        },
      };

    case 'userSupportFirst':
      return {
        mappings: {
          user: <strong><a href={event.user.url}>{event.user.username}</a></strong>,
        },
      };

    case 'userSupportGift':
      return {
        mappings: {
          user: <strong><a href={event.user.url}>{event.user.username}</a></strong>,
        },
      };

    case 'usernameChange':
      return {
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
