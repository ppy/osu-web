// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import ContestEntryJson from 'interfaces/contest-entry-json';
import ContestJudgeCategory from 'interfaces/contest-judge-category-json';
import ContestJudgeCategoryVoteJson from 'interfaces/contest-judge-category-vote-json';
import { route } from 'laroute';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { ContestEntry } from 'models/contest-entry';
import * as React from 'react';
import ContestEntryStore from 'stores/contest-entry-store';
import { onError } from 'utils/ajax';
import { trans } from 'utils/lang';

interface Props {
  entry: ContestEntry;
  judgeCategories: ContestJudgeCategory[];
  store: ContestEntryStore;
}

@observer
export default class Entry extends React.Component<Props> {
  @observable private categoryVotes: ContestJudgeCategoryVoteJson[];
  @observable private comment: string;
  @observable private posting = false;
  @observable private xhr?: JQuery.jqXHR;

  constructor(props: Props) {
    super(props);

    this.categoryVotes = props.entry.current_user_judge_vote?.category_votes ?? [];
    this.comment = props.entry.current_user_judge_vote?.comment ?? '';

    makeObservable(this);
  }

  categoryVote(categoryId: number) {
    return this.categoryVotes.find((x) => x.contest_judge_category_id === categoryId);
  }

  disabled() {
    for (const x of this.props.judgeCategories) {
      if (this.categoryVote(x.id) == null) return true;
    }

    return false;
  }

  render() {
    return (
      <div className='contest-judge-entry'>
        <h2 className='contest-judge-entry__title'>
          {this.props.entry.title}
        </h2>

        {this.props.judgeCategories.map((category) => {
          const currentVote = this.categoryVote(category.id);

          return (
            <div key={category.id}>
              <div className='contest-judge-entry__label'>
                {category.name}
              </div>

              {this.renderRangeInput(category)}

              <div className='contest-judge-entry__range-value'>
                {
                  currentVote != null
                    ? `${currentVote.value}/${category.max_value}`
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
            disabled={this.disabled()}
            icon='fas fa-check'
            isBusy={this.posting}
            props={{ onClick: this.submitVote }}
            text={trans('contest.judge.update')}
          />
        </div>
      </div>
    );
  }

  renderRangeInput(category: ContestJudgeCategory) {
    return (
      <div className='contest-judge-entry__range'>
        <input
          data-category-id={category.id}
          max={category.max_value}
          onChange={this.handleRangeInputChange}
          type='range'
          value={this.categoryVote(category.id)?.value}
        />
      </div>
    );
  }

  @action
  private handleCommentChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.comment = e.currentTarget.value;
  };

  @action
  private handleRangeInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const categoryId = Number(e.currentTarget.getAttribute('data-category-id'));
    const value = Number(e.currentTarget.value);

    const vote = { contest_judge_category_id: categoryId, value };
    const { categoryVotes } = this;

    if (this.categoryVote(categoryId) == null) {
      categoryVotes?.push(vote);
    } else {
      const index = categoryVotes?.findIndex((x) => x.contest_judge_category_id === categoryId);
      if (index == null) return;

      categoryVotes?.splice(index, 1, vote);
    }
  };

  @action
  private submitVote = () => {
    if (this.xhr != null) return;

    this.posting = true;

    this.xhr = $.ajax(route('contest-entries.judge-vote', { contest_entry: this.props.entry.id }), {
      data: {
        category_votes: this.categoryVotes,
        comment: this.comment,
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
}
