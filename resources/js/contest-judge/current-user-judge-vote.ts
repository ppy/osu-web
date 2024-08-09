// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestJudgeScoreJson from 'interfaces/contest-judge-score-json';
import ContestJudgeVoteJson from 'interfaces/contest-judge-vote-json';
import { action, makeObservable, observable } from 'mobx';

export default class CurrentUserJudgeVote {
  @observable comment = '';
  @observable scores = new Map<number, ContestJudgeScoreJson>();

  constructor(json?: ContestJudgeVoteJson) {
    if (json != null) {
      this.updateWithJson(json);
    }

    makeObservable(this);
  }

  @action
  updateWithJson(json: ContestJudgeVoteJson) {
    this.comment = json.comment ?? '';

    json.scores?.forEach((score) => {
      this.scores.set(score.contest_scoring_category_id, score);
    });
  }
}
