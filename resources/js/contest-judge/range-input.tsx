// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestJudgeCategoryJson from 'interfaces/contest-judge-category-json';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';

interface Props {
  category: ContestJudgeCategoryJson;
  currentValue: number | undefined;
  updateValue: (id: number, value: number) => void;
}

@observer
export default class RangeInput extends React.Component<Props> {
  @observable private value: number;

  constructor(props: Props) {
    super(props);

    this.value = this.props.currentValue ?? 0;

    makeObservable(this);
  }

  render() {
    return (
      <div className='contest-judge-entry__range'>
        <input
          max={this.props.category.max_value}
          onChange={this.handleChange}
          type='range'
          value={this.value}
        />
      </div>
    );
  }

  @action
  private readonly handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const value = Number(e.currentTarget.value);
    this.value = value;

    this.props.updateValue(this.props.category.id, value);
  };
}
