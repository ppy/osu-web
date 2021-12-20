// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';
import core from 'osu-core-singleton';

export function canBeReported(score: ScoreJson) {
  return score.best_id != null
    && !score.user.is_deleted
    && core.currentUser != null
    && score.user_id !== core.currentUser.id;
}

// TODO: move to application state repository thingy later
export function hasMenu(score: ScoreJson) {
  return canBeReported(score) || hasReplay(score) || hasShow(score);
}

export function hasReplay(score: ScoreJson) {
  return score.replay;
}

export function hasShow(score: ScoreJson): score is ScoreJson & { best_id: number } {
  return score.best_id != null;
}
