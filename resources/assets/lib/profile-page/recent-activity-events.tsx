// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AchievementJson from 'interfaces/achievement-json';
import GameMode from 'interfaces/game-mode';
import Rank from 'interfaces/rank';
import * as React from 'react';
import { Modifiers } from 'utils/css';
import AchievementBadge from './achievement-badge';

export const eventTypes = [
  'achievement',
  'beatmapPlaycount',
  'beatmapsetApprove',
  'beatmapsetDelete',
  'beatmapsetRevive',
  'beatmapsetUpdate',
  'beatmapsetUpload',
  'rank',
  'rankLost',
  'usernameChange',
  'userSupportAgain',
  'userSupportFirst',
  'userSupportGift',
] as const;

export type EventType = (typeof eventTypes)[number];

interface EventBase {
  created_at: string;
  id: number;
  parse_error?: boolean;
  type: EventType;
}

export type Event =
  AchievementEvent
  | BeatmapPlaycountEvent
  | BeatmapsetApproveEvent
  | BeatmapsetDeleteEvent
  | BeatmapsetReviveEvent
  | BeatmapsetUpdateEvent
  | BeatmapsetUploadEvent
  | RankEvent
  | RankLostEvent
  | UserSupportAgainEvent
  | UserSupportFirstEvent
  | UserSupportGiftEvent
  | UsernameChangeEvent;

interface EventBeatmap {
  title: string;
  url: string;
}

interface EventBeatmapset {
  title: string;
  url: string;
}

interface EventUser {
  url: string;
  username: string;
}

interface AchievementEvent extends EventBase {
  achievement: AchievementJson;
  type: 'achievement';
  user: EventUser;
}

interface BeatmapPlaycountEvent extends EventBase {
  beatmap: EventBeatmap;
  count: number;
  type: 'beatmapPlaycount';
}

interface BeatmapsetApproveEvent extends EventBase {
  approval: string;
  beatmapset: EventBeatmapset;
  type: 'beatmapsetApprove';
  user: EventUser;
}

interface BeatmapsetDeleteEvent extends EventBase {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetDelete';
}

interface BeatmapsetReviveEvent extends EventBase {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetRevive';
  user: EventUser;
}

interface BeatmapsetUpdateEvent extends EventBase {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetUpdate';
  user: EventUser;
}

interface BeatmapsetUploadEvent extends EventBase {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetUpload';
  user: EventUser;
}

interface RankEvent extends EventBase {
  beatmap: EventBeatmap;
  mode: GameMode;
  rank: number;
  scoreRank: Rank;
  type: 'rank';
  user: EventUser;
}

interface RankLostEvent extends EventBase {
  beatmap: EventBeatmap;
  mode: GameMode;
  type: 'rankLost';
  user: EventUser;
}

interface UsernameChangeEvent extends EventBase {
  type: 'usernameChange';
  user: EventUser & {
    previousUsername: string;
  };
}

interface UserSupportAgainEvent extends EventBase {
  type: 'userSupportAgain';
  user: EventUser;
}

interface UserSupportFirstEvent extends EventBase {
  type: 'userSupportFirst';
  user: EventUser;
}

interface UserSupportGiftEvent extends EventBase {
  type: 'userSupportGift';
  user: EventUser;
}

function link(url: string, title: string) {
  return <a href={url}>{title}</a>;
}

export function parseEvent(event: Event, modifiers: Modifiers): { badge?: React.ReactNode; mappings?: Record<string, React.ReactNode> } {
  if (event.parse_error) return { badge: undefined, mappings: undefined };

  switch (event.type) {
    case 'achievement':
      return {
        badge: (
          <AchievementBadge
            achievement={event.achievement}
            modifiers={modifiers}
            userAchievement={{
              achieved_at: event.created_at,
              achievement_id: event.achievement.id,
            }}
          />
        ),
        mappings: {
          achievement: <strong>{event.achievement.name}</strong>,
          user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
        },
      };

    case 'beatmapPlaycount':
      return {
        mappings: {
          beatmap: link(event.beatmap.url, event.beatmap.title),
          count: event.count,
        },
      };

    case 'beatmapsetApprove':
      return {
        mappings: {
          approval: osu.trans(`events.beatmapset_status.${event.approval}`),
          beatmapset: link(event.beatmapset.url, event.beatmapset.title),
          user: <strong>{link(event.user.url, event.user.username)}</strong>,
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
          beatmapset: link(event.beatmapset.url, event.beatmapset.title),
          user: <strong>{link(event.user.url, event.user.username)}</strong>,
        },
      };

    case 'beatmapsetUpdate':
      return {
        mappings: {
          beatmapset: <em>{link(event.beatmapset.url, event.beatmapset.title)}</em>,
          user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
        },
      };

    case 'beatmapsetUpload':
      return {
        mappings: {
          beatmapset: link(event.beatmapset.url, event.beatmapset.title),
          user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
        },
      };

    case 'rank':
      return {
        badge: <div className={`score-rank score-rank--${event.scoreRank}`} />,
        mappings: {
          beatmap: <em>{link(event.beatmap.url, event.beatmap.title)}</em>,
          mode: osu.trans(`beatmaps.mode.${event.mode}`),
          rank: event.rank,
          user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
        },
      };

    case 'rankLost':
      return {
        mappings: {
          beatmap: <em>{link(event.beatmap.url, event.beatmap.title)}</em>,
          mode: osu.trans(`beatmaps.mode.${event.mode}`),
          user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
        },
      };

    case 'userSupportAgain':
      return {
        mappings: {
          user: <strong>{link(event.user.url, event.user.username)}</strong>,
        },
      };

    case 'userSupportFirst':
      return {
        mappings: {
          user: <strong>{link(event.user.url, event.user.username)}</strong>,
        },
      };

    case 'userSupportGift':
      return {
        mappings: {
          user: <strong>{link(event.user.url, event.user.username)}</strong>,
        },
      };

    case 'usernameChange':
      return {
        mappings: {
          previousUsername: <strong>{event.user.previousUsername}</strong>,
          user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
        },
      };

    default: {
      const never: never = event;
      // This assumes unknown events fail parsing in the response and there aren't missing cases.
      return never;
    }
  }
}
