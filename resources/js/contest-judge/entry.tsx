// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import ContestEntryJson from 'interfaces/contest-entry-json';
import ContestJudgeCategory from 'interfaces/contest-judge-category-json';
import ContestJudgeScoreJson from 'interfaces/contest-judge-score-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable, runInAction, toJS } from 'mobx';
import { observer } from 'mobx-react';
import { ContestEntry } from 'models/contest-entry';
import * as React from 'react';
import ContestEntryStore from 'stores/contest-entry-store';
import { onError } from 'utils/ajax';
import { trans } from 'utils/lang';
import ContestJudgeVoteJson from 'interfaces/contest-judge-vote-json';
import ContestJudgeCategoryJson from 'interfaces/contest-judge-category-json';

interface Props {
  entry: ContestEntry;
  judgeCategories: ContestJudgeCategory[];
  store: ContestEntryStore;
}

@observer
export default class Entry extends React.Component<Props> {
  @observable private readonly scores: ContestJudgeScoreJson[];
  @observable private comment: string;
  @observable private posting = false;
  @observable private xhr?: JQuery.jqXHR;
  private readonly initialVote?: ContestJudgeVoteJson;

  constructor(props: Props) {
    super(props);

    this.comment = props.entry.current_user_judge_vote?.comment ?? '';
    this.initialVote = toJS(props.entry.current_user_judge_vote);
    this.scores = props.entry.current_user_judge_vote?.scores ?? [];

    makeObservable(this);
  }

  @computed
  private get disabled() {
    let scoresHaveChanged = false;

    for (const category of this.props.judgeCategories) {
      const score = this.score(category.id);
      if (score == null) return true;

      if (!scoresHaveChanged) {
        const initialScore = this.initialVote?.scores?.find(x => x.contest_judge_category_id === category.id);
        if (initialScore?.value != score.value) scoresHaveChanged = true;
      }
    }

    if (
      !scoresHaveChanged &&
      this.comment == (this.initialVote?.comment ?? '')
    ) return true;

    return false;
  }

  render() {
    return (
      <div className='contest-judge-entry'>
        <div className='contest-judge-entry__title'>
          {this.props.entry.title}
        </div>

        {this.props.judgeCategories.map((category) => {
          const currentScore = this.score(category.id);

          return (
            <div key={category.id}>
              <div className='contest-judge-entry__label'>
                <div className='contest-judge-entry__description-icon' title={category.description}>
                  <i className='fas fa-question-circle' />
                </div>

                {category.name}
              </div>

              {this.renderRangeInput(category, currentScore?.value ?? 0)}

              <div className='contest-judge-entry__value'>
                {
                  currentScore != null
                    ? `${currentScore.value}/${category.max_value}`
                    : trans('contest.judge.no_current_vote')
                }
              </div>
            </div>
          );
        })}

        <div className='contest-judge-entry__textarea-wrapper'>
          <textarea
            className='contest-judge-entry__textarea'
            onChange={this.handleCommentChange}
            rows={6}
            value={this.comment}
          />
        </div>

        <div className='contest-judge-entry__button'>
          <BigButton
            disabled={this.disabled}
            icon='fas fa-check'
            isBusy={this.posting}
            props={{ onClick: this.submitVote }}
            text={trans('contest.judge.update')}
          />
        </div>
      </div>
    );
  }

  private renderRangeInput(category: ContestJudgeCategoryJson, initialValue: number) {
      return (
        <div className='contest-judge-entry-range-input'>
          <input
            max={category.max_value}
            onChange={(e) => this.updateValue(e, category.id)}
            type='range'
            value={initialValue}
          />
        </div>
      );
  }

  private score(categoryId: number) {
    return this.scores.find(x => x.contest_judge_category_id === categoryId);
  }

  @action
  private readonly handleCommentChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.comment = e.currentTarget.value;
  };

  @action
  private readonly submitVote = () => {
    if (this.xhr != null) return;

    this.posting = true;

    this.xhr = $.ajax(route('contest-entries.judge-vote', { contest_entry: this.props.entry.id }), {
      data: {
        comment: this.comment,
        scores: this.scores,
      },
      method: 'PUT',
    });

    this.xhr
      .fail(onError)
      .done((json: ContestEntryJson) => runInAction(() => {
        this.props.store.update(json);
      })).always(action(() => {
        this.posting = false;
        this.xhr = undefined;
      }));
  };

  @action
  private readonly updateValue = (e: React.ChangeEvent<HTMLInputElement>, categoryId: number) => {
    const value = Number(e.currentTarget.value);
    const score = { contest_judge_category_id: categoryId, value };
    const { scores } = this;

    if (this.score(categoryId) == null) {
      scores?.push(score);
    } else {
      const index = scores?.findIndex((x) => x.contest_judge_category_id === categoryId);
      // that should never happen
      if (index == -1) return;

      scores?.splice(index, 1, score);
    }
  };
}
