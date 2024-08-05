// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import InputContainer from 'components/input-container';
import TextareaAutosize from 'components/textarea-autosize';
import ContestEntryJson from 'interfaces/contest-entry-json';
import ContestScoringCategoryJson from 'interfaces/contest-scoring-category-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { ContestEntry } from 'models/contest-entry';
import * as React from 'react';
import ContestJudgeStore from 'stores/contest-judge-store';
import { onError } from 'utils/ajax';
import { trans } from 'utils/lang';
import { CurrentUserJudgeVote } from './current-user-judge-vote';

interface Props {
  entry: ContestEntry;
  store: ContestJudgeStore;
}

@observer
export default class Entry extends React.Component<Props> {
  @observable private readonly currentVote = new CurrentUserJudgeVote();
  @observable private readonly initialVote = new CurrentUserJudgeVote();
  @observable private posting = false;
  @observable private xhr?: JQuery.jqXHR;

  constructor(props: Props) {
    super(props);

    const voteFromJson = props.entry.current_user_judge_vote;
    if (voteFromJson != null) {
      this.currentVote.updateWithJson(voteFromJson);
      this.initialVote.updateWithJson(voteFromJson);
    }

    makeObservable(this);
  }

  @computed
  private get disabled() {
    const scoresHaveChanged = this.props.store.scoringCategories.some((category) => {
      const initialScore = this.initialVote.scores.get(category.id);
      const score = this.currentVote.scores.get(category.id);

      return initialScore?.value !== score?.value;
    });

    return !(
      this.currentVote.scores.size === this.props.store.scoringCategories.length
        && (scoresHaveChanged || this.currentVote.comment !== this.initialVote.comment)
    );
  }

  render() {
    return (
      <div className='contest-judge-entry'>
        <div className='contest-judge-entry__title'>
          {this.props.entry.current_user_judge_vote != null && (
            <span className="contest-judge-entry__voted-icon" title={trans('contest.judge.voted')}>
              <i className='fas fa-check' />
            </span>
          )}
          {this.props.entry.title}
        </div>

        <div className='contest-judge-entry__sliders'>
          {this.props.store.scoringCategories.map((category) => {
            const currentScore = this.currentVote.scores.get(category.id);

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
        </div>

        <InputContainer
          input={this.currentVote.comment}
          labelKey='comment'
          maxLength={1000}
          modifiers='judging'
        >
          <TextareaAutosize
            className='contest-judge-entry__textarea'
            maxRows={20}
            onChange={this.handleCommentChange}
            rows={6}
            value={this.currentVote.comment}
          />
        </InputContainer>

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

  @action
  private readonly handleCommentChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.currentVote.updateComment(e.currentTarget.value);
  };

  @action
  private readonly handleRangeInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const categoryId = Number(e.currentTarget.getAttribute('data-category-id'));
    const value = Number(e.currentTarget.value);

    const score = { contest_scoring_category_id: categoryId, value };
    this.currentVote.scores.set(categoryId, score);
  };

  private renderRangeInput(category: ContestScoringCategoryJson, initialValue: number) {
    return (
      <div className='contest-judge-entry-range-input'>
        <input
          data-category-id={category.id}
          max={category.max_value}
          onChange={this.handleRangeInputChange}
          type='range'
          value={initialValue}
        />
      </div>
    );
  }

  @action
  private readonly submitVote = () => {
    if (this.xhr != null) return;

    this.posting = true;

    this.xhr = $.ajax(route('contest-entries.judge-vote', { contest_entry: this.props.entry.id }), {
      data: {
        comment: this.currentVote.comment,
        scores: [...this.currentVote.scores.values()],
      },
      method: 'PUT',
    });

    this.xhr
      .fail(onError)
      .done((json: ContestEntryJson) => runInAction(() => {
        this.props.store.updateEntry(json);

        if (json.current_user_judge_vote != null) {
          this.initialVote.updateWithJson(json.current_user_judge_vote);
        }
      })).always(action(() => {
        this.posting = false;
        this.xhr = undefined;
      }));
  };
}
