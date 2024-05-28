// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import InputContainer from 'components/input-container';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import groupStore from './group-store';
import GroupHistoryJson from './json';

const bn = 'group-history-search-form';
const formParamKeys = ['group', 'max_date', 'min_date', 'user'] as const;

interface Props {
  currentParams: GroupHistoryJson['params'];
  loading: boolean;
  newParams: GroupHistoryJson['params'];
  onSearch: () => void;
}

@observer
export default class SearchForm extends React.Component<Props> {
  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    const newParamsEmpty = formParamKeys.every(
      (key) => this.props.newParams[key] == null,
    );
    const newParamsSame = formParamKeys.every(
      (key) => this.props.newParams[key] === this.props.currentParams[key],
    );

    return (
      <form className={bn} data-loading-overlay='0' onSubmit={this.onSubmit}>
        <div className={`${bn}__content ${bn}__content--inputs`}>
          <InputContainer for={`${bn}-group`} labelKey='group_history.form.group'>
            <div className='form-select form-select--group-history'>
              <select
                className='form-select__input'
                id={`${bn}-group`}
                name='group'
                onChange={this.onChange}
                value={this.props.newParams.group ?? ''}
              >
                <option value=''>
                  {trans('group_history.form.group_all')}
                </option>
                {groupStore.all.map((group) => (
                  <option key={group.id} value={group.identifier}>
                    {group.name}
                  </option>
                ))}
              </select>
            </div>
          </InputContainer>
          <InputContainer for={`${bn}-user`} labelKey='group_history.form.user'>
            <input
              className={`${bn}__input`}
              id={`${bn}-user`}
              name='user'
              onChange={this.onChange}
              placeholder={trans('group_history.form.user_prompt')}
              value={this.props.newParams.user ?? ''}
            />
          </InputContainer>
          <InputContainer for={`${bn}-min_date`} labelKey='group_history.form.min_date'>
            <input
              className={`${bn}__input`}
              id={`${bn}-min_date`}
              name='min_date'
              onChange={this.onChange}
              type='date'
              value={this.props.newParams.min_date ?? ''}
            />
          </InputContainer>
          <InputContainer for={`${bn}-max_date`} labelKey='group_history.form.max_date'>
            <input
              className={`${bn}__input`}
              id={`${bn}-max_date`}
              name='max_date'
              onChange={this.onChange}
              type='date'
              value={this.props.newParams.max_date ?? ''}
            />
          </InputContainer>
        </div>
        <div className={`${bn}__content ${bn}__content--buttons`}>
          <BigButton
            disabled={newParamsEmpty}
            icon='fas fa-times'
            modifiers={['artist-track-search', 'rounded-thin']}
            props={{ onClick: this.onReset }}
            text={trans('common.buttons.reset')}
          />
          <BigButton
            disabled={newParamsSame || this.props.loading}
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
  private readonly onChange = (event: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    event.preventDefault();

    this.props.newParams[event.currentTarget.name as (typeof formParamKeys)[number]] =
      event.currentTarget.value || null;
  };

  @action
  private readonly onReset = (event: React.MouseEvent<HTMLButtonElement>) => {
    event.preventDefault();

    for (const key of formParamKeys) {
      this.props.newParams[key] = null;
    }
  };

  private readonly onSubmit = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();

    this.props.onSearch();
  };
}
