// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestEntryJson from 'interfaces/contest-entry-json';
import ContestJudgeVoteJson from 'interfaces/contest-judge-vote-json';
import { action, computed, makeObservable, observable } from 'mobx';

export class ContestEntry {
  @observable contest_id: number;
  @observable current_user_judge_vote?: ContestJudgeVoteJson;
  @observable id: number;
  @observable title: string;

  constructor(json: ContestEntryJson) {
    this.contest_id = json.contest_id;
    this.current_user_judge_vote = json.current_user_judge_vote;
    this.id = json.id;
    this.title = json.title;

    makeObservable(this);
  }

  @action
  updateWithJson(json: ContestEntryJson) {
    this.contest_id = json.contest_id;
    this.current_user_judge_vote = json.current_user_judge_vote;
    this.id = json.id;
    this.title = json.title;
  }
}
