/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

interface IconsMap {
  [key: string]: string[];
}

export const categoryToIcons: IconsMap = {
  beatmapset_discussion: ['fas fa-drafting-compass', 'fas fa-comment'],
  beatmapset_problem: ['fas fa-drafting-compass', 'fas fa-exclamation-circle'],
  beatmapset_state: ['fas fa-drafting-compass'],
  channel: ['fas fa-comments'],
  comment: ['fas fa-comment'],
  forum_topic_reply: ['fas fa-comment-medical'],
  legacy_pm: ['fas fa-envelope'],
};

export const nameToIcons: IconsMap = {
  beatmapset_discussion_lock: ['fas fa-drafting-compass', 'fas fa-lock'],
  beatmapset_discussion_post_new: ['fas fa-drafting-compass', 'fas fa-comment-medical'],
  beatmapset_discussion_qualified_problem: ['fas fa-drafting-compass', 'fas fa-exclamation-circle'],
  beatmapset_discussion_unlock: ['fas fa-drafting-compass', 'fas fa-unlock'],
  beatmapset_disqualify: ['fas fa-drafting-compass', 'far fa-times-circle'],
  beatmapset_love: ['fas fa-drafting-compass', 'fas fa-heart'],
  beatmapset_nominate: ['fas fa-drafting-compass', 'fas fa-vote-yea'],
  beatmapset_qualify: ['fas fa-drafting-compass', 'fas fa-check'],
  beatmapset_rank: ['fas fa-drafting-compass', 'fas fa-check-double'],
  beatmapset_reset_nominations: ['fas fa-drafting-compass', 'fas fa-undo'],
  channel_message: ['fas fa-comments'],
  comment_new: ['fas fa-comment'],
  forum_topic_reply: ['fas fa-comment-medical'],
  legacy_pm: ['fas fa-envelope'],
  user_achievement_unlock: ['fas fa-trophy'],
};

export const nameToIconsCompact: IconsMap = {
  beatmapset_discussion_lock: ['fas fa-lock'],
  beatmapset_discussion_post_new: ['fas fa-comment-medical'],
  beatmapset_discussion_qualified_problem: ['fas fa-exclamation-circle'],
  beatmapset_discussion_unlock: ['fas fa-unlock'],
  beatmapset_disqualify: ['far fa-times-circle'],
  beatmapset_love: ['fas fa-heart'],
  beatmapset_nominate: ['fas fa-vote-yea'],
  beatmapset_qualify: ['fas fa-check'],
  beatmapset_rank: ['fas fa-check-double'],
  beatmapset_reset_nominations: ['fas fa-undo'],
  channel_message: ['fas fa-comments'],
  comment_new: ['fas fa-comment'],
  forum_topic_reply: ['fas fa-comment-medical'],
  legacy_pm: ['fas fa-envelope'],
};
