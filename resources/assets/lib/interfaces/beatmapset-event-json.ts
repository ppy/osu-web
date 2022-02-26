// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from './beatmapset-json';
import GameMode from './game-mode';

interface VoteEventJson {
  score: number;
  user_id: number;
}

interface BaseBeatmapsetEvent {
  beatmapset?: BeatmapsetJson;
  created_at: string;
  discussion?: BeatmapsetDiscussionJson;
  id: number;
  user_id?: number;
}

interface NominateEvent extends BaseBeatmapsetEvent {
  comment: {
    modes: GameMode[];
  } | null;
  type: 'nominate';
}

interface LoveEvent extends BaseBeatmapsetEvent {
  comment: null;
  type: 'love';
}

interface RemoveFromLovedEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id?: number;
    beatmap_discussion_post_id?: number;
    reason: string;
  };
  type: 'remove_from_loved';
}

interface QualifyEvent extends BaseBeatmapsetEvent {
  comment: null;
  type: 'qualify';
}

interface DisqualifyEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id?: number;
    beatmap_discussion_post_id?: number;
    nominator_ids?: number[];
  } | string;
  type: 'disqualify';
}

interface ApproveEvent extends BaseBeatmapsetEvent {
  comment: null;
  type: 'approve';
}

interface RankEvent extends BaseBeatmapsetEvent {
  comment: null;
  type: 'rank';
}

interface KudosuAllowEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id: number;
    beatmap_discussion_post_id: number;
  };
  type: 'kudosu_allow';
}

interface KudosuDenyEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id: number;
    beatmap_discussion_post_id: number;
  };
  type: 'kudosu_deny';
}

interface KudosuGainEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id?: number;
    beatmap_discussion_post_id?: number;
    new_vote: VoteEventJson;
    votes: VoteEventJson[];
  };
  type: 'kudosu_gain';
}

interface KudosuLostEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id?: number;
    beatmap_discussion_post_id?: number;
    new_vote: VoteEventJson;
    votes: VoteEventJson[];
  };
  type: 'kudosu_lost';
}

interface KudosuRecalculateEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id?: number;
    beatmap_discussion_post_id?: number;
  };
  type: 'kudosu_recalculate';
}

interface IssueResolveEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id?: number;
    beatmap_discussion_post_id?: number;
  };
  type: 'issue_resolve';
}

interface IssueReopenEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id?: number;
    beatmap_discussion_post_id?: number;
  };
  type: 'issue_reopen';
}

interface DiscussionLockEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id: number;
    beatmap_discussion_post_id: number;
    reason: string;
  };
  type: 'discussion_lock';
}

interface DiscussionUnlockEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id?: number;
    beatmap_discussion_post_id?: number;
  };
  type: 'discussion_unlock';
}

interface DiscussionDeleteEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id?: number;
    beatmap_discussion_post_id?: number;
  };
  type: 'discussion_delete';
}

interface DiscussionRestoreEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id: number;
    beatmap_discussion_post_id: number;
  };
  type: 'discussion_restore';
}

interface DiscussionPostDeleteEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id: number;
    beatmap_discussion_post_id: number;
  };
  type: 'discussion_post_delete';
}

interface DiscussionPostRestoreEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id: number;
    beatmap_discussion_post_id: number;
  };
  type: 'discussion_post_restore';
}

interface NominationResetEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id?: number;
    beatmap_discussion_post_id?: number;
    nominator_ids?: number[];
  };
  type: 'nomination_reset';
}

interface NominationResetReceivedEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_discussion_id: number;
    beatmap_discussion_post_id: number;
    source_user_id: number;
    source_user_username: string;
  };
  type: 'nomination_reset_received';
}

interface GenreEditEvent extends BaseBeatmapsetEvent {
  comment: {
    new: string;
    old: string;
  };
  type: 'genre_edit';
}

interface LanguageEditEvent extends BaseBeatmapsetEvent {
  comment: {
    new: string;
    old: string;
  };
  type: 'language_edit';
}

interface NsfwToggleEvent extends BaseBeatmapsetEvent {
  comment: {
    new: boolean;
    old: boolean;
  };
  type: 'nsfw_toggle';
}

interface BeatmapOwnerChangeEvent extends BaseBeatmapsetEvent {
  comment: {
    beatmap_id: number;
    beatmap_version: string;
    new_user_id: number;
    new_user_username: string;
  };
  type: 'beatmap_owner_change';
}

type BeatmapsetEventJson =
  | NominateEvent
  | LoveEvent
  | RemoveFromLovedEvent
  | QualifyEvent
  | DisqualifyEvent
  | ApproveEvent
  | RankEvent

  | KudosuAllowEvent
  | KudosuDenyEvent
  | KudosuGainEvent
  | KudosuLostEvent
  | KudosuRecalculateEvent

  | IssueResolveEvent
  | IssueReopenEvent

  | DiscussionLockEvent
  | DiscussionUnlockEvent

  | DiscussionDeleteEvent
  | DiscussionRestoreEvent

  | DiscussionPostDeleteEvent
  | DiscussionPostRestoreEvent

  | NominationResetEvent
  | NominationResetReceivedEvent

  | GenreEditEvent
  | LanguageEditEvent
  | NsfwToggleEvent

  | BeatmapOwnerChangeEvent;

export default BeatmapsetEventJson;
