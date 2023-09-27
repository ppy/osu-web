// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as moment from 'moment';
import * as React from 'react';
import { trans } from 'utils/lang';

const bn = 'countdown-timer';
const secondsPerDay = 60 * 60 * 24;
const secondsPerHour = 60 * 60;

interface Props {
  deadline: string;
}

@observer
export default class CountdownTimer extends React.Component<Props> {
  private timer?: number;

  @computed
  private get deadline() {
    return moment(this.props.deadline).valueOf();
  }

  private get diff() {
    return Math.max(this.deadline - (new Date()).valueOf(), 0) / 1000;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    window.clearTimeout(this.timer);
  }

  render() {
    const diff = this.diff;
    const fields = {
      days: Math.floor(diff / (secondsPerDay)),
      hours: Math.floor((diff / (secondsPerHour)) % 24),
      minutes: Math.floor((diff / 60) % 60),
      seconds: Math.floor(diff % 60),
    };
    if (diff !== 0) {
      this.setTimeout();
    }

    return (
      <div className={bn}>
        <div className={`${bn}__header`}>{`${trans('common.time.remaining')}:`}</div>
        {Object.entries(fields).map(([field, value]) => (
          <div key={field} className={`${bn}__field`}>
            <div className={`${bn}__digit`}>
              {value < 10 ? `0${value}` : value}
            </div>
            <div className={`${bn}__label`}>{trans(`common.countdown.${field}`)}</div>
          </div>
        ))}
      </div>
    );
  }

  private setTimeout() {
    this.timer = window.setTimeout(() => this.forceUpdate(), 1000);
  }
}
