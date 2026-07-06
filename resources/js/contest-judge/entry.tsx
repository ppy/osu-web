// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import InputContainer from 'components/input-container';
import TextareaAutosize from 'components/textarea-autosize';
import ContestEntryJson from 'interfaces/contest-entry-json';
import ContestScoringCategoryJson from 'interfaces/contest-scoring-category-json';
import { route } from 'laroute';
import { clamp } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { ContestEntry } from 'models/contest-entry';
import * as React from 'react';
import ContestJudgeStore from 'stores/contest-judge-store';
import { onError } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import CurrentUserJudgeVote from './current-user-judge-vote';

interface Props {
  entry: ContestEntry;
  store: ContestJudgeStore;
}

const commentsMaxLength = 3000;

@observer
export default class Entry extends React.Component<Props> {
  @observable private readonly currentVote;
  @observable private readonly initialVote;
  @observable private readonly store;
  @observable private timeout?: number;
  @observable private xhr?: JQuery.jqXHR<ContestEntryJson>;

  constructor(props: Props) {
    super(props);

    this.store = this.props.store;

    const json = props.entry.current_user_judge_vote;
    this.currentVote = new CurrentUserJudgeVote(json);
    this.initialVote = new CurrentUserJudgeVote(json);

    makeObservable(this);
  }

  @computed
  private get canSubmit() {
    return this.store.canJudge
      && !this.commentTooLong
      && this.currentVote.scores.size === this.store.scoringCategories.length
      && this.hasUnsavedChanges;
  }

  @computed
  private get hasUnsavedChanges() {
    return this.currentVote.comment !== this.initialVote.comment
      || this.store.scoringCategories.some((category) => (
        this.initialVote.scores.get(category.id)?.value !== this.currentVote.scores.get(category.id)?.value
      ));
  }

  private get commentTooLong() {
    return this.currentVote.comment.length > commentsMaxLength;
  }

  @computed
  private get statusText() {
    return this.hasUnsavedChanges
      ? trans('contest.judge.unsaved_changes')
      : this.timeout != null
        ? trans('common.saved')
        : null;
  }

  @computed
  private get statusVisible() {
    return this.hasUnsavedChanges || this.timeout != null;
  }

  componentWillUnmount() {
    window.clearTimeout(this.timeout);
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

        <div className='contest-judge-entry__categories'>
          {this.store.scoringCategories.map(this.renderCategory)}
        </div>

        <InputContainer
          hasError={this.commentTooLong}
          input={this.currentVote.comment}
          labelKey='contest.judge.comments'
          maxLength={commentsMaxLength}
          modifiers='judging'
          showError
        >
          <TextareaAutosize
            className='input-text'
            disabled={!this.store.canJudge}
            maxRows={20}
            onChange={this.handleCommentChange}
            rows={6}
            value={this.currentVote.comment}
          />
        </InputContainer>

        <div className='contest-judge-entry__button'>
          {this.statusVisible && (
            <div className={classWithModifiers('contest-judge-entry__status', { saved: !this.hasUnsavedChanges })}>
              {this.statusText}
            </div>
          )}
          <BigButton
            disabled={!this.canSubmit}
            icon='fas fa-check'
            isBusy={this.xhr != null}
            props={{ onClick: this.submitVote }}
            text={trans('contest.judge.update')}
          />
        </div>
      </div>
    );
  }

  @action
  private readonly handleCommentChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.currentVote.comment = e.currentTarget.value;
  };

  @action
  private readonly handleScoreInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const categoryId = Number(e.currentTarget.getAttribute('data-category-id'));

    let value = Number(e.currentTarget.value);
    if (!Number.isInteger(value)) return;
    value = clamp(value, 0, Number(e.currentTarget.max));

    const score = { contest_scoring_category_id: categoryId, value };
    this.currentVote.scores.set(categoryId, score);
  };

  private readonly renderCategory = (category: ContestScoringCategoryJson) => {
    const currentScore = this.currentVote.scores.get(category.id);
    const inputId = `contest-judge-score-${this.props.entry.id}-${category.id}`;

    return (
      <InputContainer
        key={category.id}
        for={inputId}
        label={(
          <span className='contest-judge-entry__category-label'>
            <i
              className='fas fa-question-circle'
              title={category.description}
            />
            <span>{category.name}</span>
          </span>
        )}
        modifiers='judging-score'
      >
        <div className='input-text input-text--contest-judge-score'>
          <input
            className='contest-judge-entry__input'
            data-category-id={category.id}
            disabled={!this.store.canJudge}
            id={inputId}
            inputMode='numeric'
            max={category.max_value}
            onChange={this.handleScoreInputChange}
            value={currentScore?.value ?? ''}
          />
          <span className='contest-judge-entry__input-suffix'>/ {category.max_value}</span>
        </div>
      </InputContainer>
    );
  };

  @action
  private readonly submitVote = () => {
    if (this.xhr != null || !this.canSubmit) return;

    this.xhr = $.ajax(route('contests.entries.judge-vote', { contest: this.props.entry.contest_id, contest_entry: this.props.entry.id }), {
      data: {
        comment: this.currentVote.comment,
        scores: [...this.currentVote.scores.values()],
      },
      method: 'PUT',
    });

    this.xhr
      .fail(onError)
      .done((json) => runInAction(() => {
        this.store.updateEntry(json);

        if (json.current_user_judge_vote != null) {
          this.initialVote.updateWithJson(json.current_user_judge_vote);
        }

        window.clearTimeout(this.timeout);
        this.timeout = window.setTimeout(action(() => {
          window.clearTimeout(this.timeout);
          this.timeout = undefined;
        }), 3000);
      })).always(action(() => {
        this.xhr = undefined;
      }));
  };
}
