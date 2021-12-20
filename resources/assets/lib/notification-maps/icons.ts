// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

interface IconsMap {
  [key: string]: string[];
}

export const categoryToIcons: IconsMap = {
  beatmap_owner_change: ['fas fa-drafting-compass', 'fas fa-user-friends'],
  beatmapset_discussion: ['fas fa-drafting-compass', 'fas fa-comment'],
  beatmapset_problem: ['fas fa-drafting-compass', 'fas fa-exclamation-circle'],
  beatmapset_state: ['fas fa-drafting-compass'],
  channel: ['fas fa-comments'],
  comment: ['fas fa-comment'],
  forum_topic_reply: ['fas fa-comment-medical'],
  legacy_pm: ['fas fa-envelope'],
  user_achievement_unlock: ['fas fa-medal'],
  user_beatmapset_new: ['fas fa-music'],
};

export const nameToIcons: IconsMap = {
  beatmap_owner_change: ['fas fa-drafting-compass', 'fas fa-user-friends'],
  beatmapset_discussion_lock: ['fas fa-drafting-compass', 'fas fa-lock'],
  beatmapset_discussion_post_new: ['fas fa-drafting-compass', 'fas fa-comment-medical'],
  beatmapset_discussion_qualified_problem: ['fas fa-drafting-compass', 'fas fa-exclamation-circle'],
  beatmapset_discussion_unlock: ['fas fa-drafting-compass', 'fas fa-unlock'],
  beatmapset_disqualify: ['fas fa-drafting-compass', 'far fa-times-circle'],
  beatmapset_love: ['fas fa-drafting-compass', 'fas fa-heart'],
  beatmapset_nominate: ['fas fa-drafting-compass', 'fas fa-vote-yea'],
  beatmapset_qualify: ['fas fa-drafting-compass', 'fas fa-check'],
  beatmapset_rank: ['fas fa-drafting-compass', 'fas fa-check-double'],
  beatmapset_remove_from_loved: ['fas fa-drafting-compass', 'fas fa-heart-broken'],
  beatmapset_reset_nominations: ['fas fa-drafting-compass', 'fas fa-undo'],
  channel_message: ['fas fa-comments'],
  comment_new: ['fas fa-comment'],
  comment_reply: ['fas fa-reply'],
  forum_topic_reply: ['fas fa-comment-medical'],
  legacy_pm: ['fas fa-envelope'],
  user_achievement_unlock: ['fas fa-trophy'],
  user_beatmapset_new: ['fas fa-music'],
  user_beatmapset_revive: ['fas fa-drum'],
};

export const nameToIconsCompact: IconsMap = {
  beatmap_owner_change: ['fas fa-user-edit'],
  beatmapset_discussion_lock: ['fas fa-lock'],
  beatmapset_discussion_post_new: ['fas fa-comment-medical'],
  beatmapset_discussion_qualified_problem: ['fas fa-exclamation-circle'],
  beatmapset_discussion_unlock: ['fas fa-unlock'],
  beatmapset_disqualify: ['far fa-times-circle'],
  beatmapset_love: ['fas fa-heart'],
  beatmapset_nominate: ['fas fa-vote-yea'],
  beatmapset_qualify: ['fas fa-check'],
  beatmapset_rank: ['fas fa-check-double'],
  beatmapset_remove_from_loved: ['fas fa-heart-broken'],
  beatmapset_reset_nominations: ['fas fa-undo'],
  channel_message: ['fas fa-comments'],
  comment_new: ['fas fa-comment'],
  comment_reply: ['fas fa-reply'],
  forum_topic_reply: ['fas fa-comment-medical'],
  legacy_pm: ['fas fa-envelope'],
  user_beatmapset_new: ['fas fa-music'],
  user_beatmapset_revive: ['fas fa-drum'],
};
