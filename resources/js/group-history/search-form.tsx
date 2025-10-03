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
import { formParamKeys } from '.';

const bn = 'group-history-search-form';

interface Props {
  disabled: boolean;
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
    const newParamsEmpty = formParamKeys.every((key) => this.props.newParams[key] == null);

    return (
      <form className={bn} data-loading-overlay='0' onSubmit={this.onSubmit}>
        <div className={`${bn}__content ${bn}__content--inputs`}>
          <InputContainer labelKey='group_history.form.group' modifiers={['group-history-wide', 'select']}>
            <select
              className='input-text'
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
          </InputContainer>
          <InputContainer labelKey='group_history.form.user' modifiers='group-history-wide'>
            <input
              className='input-text'
              name='user'
              onChange={this.onChange}
              placeholder={trans('group_history.form.user_prompt')}
              value={this.props.newParams.user ?? ''}
            />
          </InputContainer>
          <InputContainer labelKey='group_history.form.min_date'>
            <input
              className='input-text'
              name='min_date'
              onChange={this.onChange}
              type='date'
              value={this.props.newParams.min_date ?? ''}
            />
          </InputContainer>
          <InputContainer labelKey='group_history.form.max_date'>
            <input
              className='input-text'
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
            disabled={this.props.disabled}
            icon='fas fa-search'
            isBusy={this.props.disabled && this.props.loading}
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
