// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Score from 'interfaces/score';

export const canBeReported = (score: Score) => {
  return currentUser.id != null
    && score.user_id !== currentUser.id;
};

// TODO: move to application state repository thingy later
export const hasMenu = (score: Score) => {
  return hasReplay(score) || canBeReported(score);
};

export const hasReplay = (score: Score) => {
  return score.replay;
};
