// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';

export const canBeReported = (score: ScoreJson) => {
  return score.best_id != null
    && currentUser.id != null
    && score.user_id !== currentUser.id;
};

// TODO: move to application state repository thingy later
export const hasMenu = (score: ScoreJson) => {
  return hasReplay(score) || canBeReported(score);
};

export const hasReplay = (score: ScoreJson) => {
  return score.replay;
};
