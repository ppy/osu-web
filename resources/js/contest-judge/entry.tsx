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
import RangeInput from './range-input';

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
                <div className='contest-judge-entry__description-icon' title={category.description}>
                  <i className='fas fa-question-circle' />
                </div>

                {category.name}
              </div>

              <RangeInput
                category={category}
                currentValue={currentVote?.value}
                updateValue={this.updateValue}
              />

              <div className='contest-judge-entry__value'>
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

  private categoryVote(categoryId: number) {
    return this.categoryVotes.find((x) => x.contest_judge_category_id === categoryId);
  }

  private disabled() {
    for (const x of this.props.judgeCategories) {
      if (this.categoryVote(x.id) == null) return true;
    }

    return false;
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

  @action
  private readonly updateValue = (id: number, value: number) => {
    const vote = { contest_judge_category_id: id, value };
    const { categoryVotes } = this;

    if (this.categoryVote(id) == null) {
      categoryVotes?.push(vote);
    } else {
      const index = categoryVotes?.findIndex((x) => x.contest_judge_category_id === id);
      // that should never happen
      if (index == null) return;

      categoryVotes?.splice(index, 1, vote);
    }
  };
}
