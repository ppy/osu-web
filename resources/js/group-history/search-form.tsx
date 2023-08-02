// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import InputContainer from 'components/input-container';
import { isEqual } from 'lodash';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import groupStore from './group-store';
import { emptyQuery, GroupHistoryQuery } from './query';

const bn = 'group-history-search-form';

interface Props {
  currentQuery: GroupHistoryQuery;
  loading: boolean;
  newQuery: GroupHistoryQuery;
  onSearch: () => void;
}

@observer
export default class SearchForm extends React.Component<Props> {
  @computed
  private get newQueryIsEmpty() {
    return isEqual(this.props.newQuery, emptyQuery);
  }

  @computed
  private get newQueryIsSame() {
    return isEqual(this.props.newQuery, this.props.currentQuery);
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <form className={bn} data-loading-overlay='0' onSubmit={this.onSubmit}>
        <div className={`${bn}__content ${bn}__content--inputs`}>
          <InputContainer for='group' labelKey='group_history.form.group'>
            <div className={`${bn}__select-container`}>
              <select
                className={`${bn}__input`}
                name='group'
                onChange={this.onGroupChange}
                value={this.props.newQuery.group ?? ''}
              >
                <option value=''>
                  {trans('group_history.form.group_all')}
                </option>
                {groupStore.groups.map((group) => (
                  <option key={group.id} value={group.identifier}>
                    {group.name}
                  </option>
                ))}
              </select>
            </div>
          </InputContainer>
          <InputContainer for='user' labelKey='group_history.form.user'>
            <input
              className={`${bn}__input`}
              name='user'
              onChange={this.onUserChange}
              placeholder={trans('group_history.form.user_prompt')}
              value={this.props.newQuery.user ?? ''}
            />
          </InputContainer>
          <InputContainer for='after' labelKey='group_history.form.after'>
            <input
              className={`${bn}__input`}
              name='after'
              onChange={this.onDateChange}
              type='date'
              value={this.props.newQuery.after ?? ''}
            />
          </InputContainer>
          <InputContainer for='before' labelKey='group_history.form.before'>
            <input
              className={`${bn}__input`}
              name='before'
              onChange={this.onDateChange}
              type='date'
              value={this.props.newQuery.before ?? ''}
            />
          </InputContainer>
        </div>
        <div className={`${bn}__content ${bn}__content--buttons`}>
          <BigButton
            disabled={this.newQueryIsEmpty}
            icon='fas fa-times'
            modifiers={['artist-track-search', 'rounded-thin']}
            props={{ onClick: this.onReset }}
            text={trans('common.buttons.reset')}
          />
          <BigButton
            disabled={this.newQueryIsSame || this.props.loading}
            icon='fas fa-search'
            isBusy={this.props.loading}
            isSubmit
            modifiers={['artist-track-search', 'rounded-thin-wide']}
            text={trans('common.buttons.search')}
          />
        </div>
      </form>
    );
  }

  @action
  private readonly onDateChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    event.preventDefault();

    this.props.newQuery[event.currentTarget.name as 'after' | 'before'] =
      event.currentTarget.value || undefined;
  };

  @action
  private readonly onGroupChange = (event: React.ChangeEvent<HTMLSelectElement>) => {
    event.preventDefault();

    this.props.newQuery.group = event.currentTarget.value || undefined;
  };

  @action
  private readonly onReset = (event: React.MouseEvent<HTMLButtonElement>) => {
    event.preventDefault();

    Object.assign(this.props.newQuery, emptyQuery);
  };

  private readonly onSubmit = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();

    if (!this.newQueryIsSame) {
      this.props.onSearch();
    }
  };

  @action
  private readonly onUserChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    event.preventDefault();

    this.props.newQuery.user = event.currentTarget.value || undefined;
  };
}
