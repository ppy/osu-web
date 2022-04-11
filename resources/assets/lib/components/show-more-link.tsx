// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { Spinner } from './spinner';

const bn = 'show-more-link';

interface Props<T> {
  callback?: (data?: T) => void;
  data?: T;
  direction?: string;
  event?: string;
  hasMore: boolean;
  label?: string;
  loading: boolean;
  modifiers?: Modifiers;
  remaining?: number;
  url?: string;
}

export default class ShowMoreLink<T> extends React.PureComponent<Props<T>> {
  static defaultProps = {
    hasMore: false,
    loading: false,
  };

  render() {
    if (!this.props.hasMore && !this.props.loading) {
      return null;
    }

    const sharedProps = {
      children: this.children(),
      className: classWithModifiers(bn, this.props.modifiers),
    };

    if (this.props.loading) {
      return <span data-disabled='1' {...sharedProps} />;
    }

    if (this.props.url == null) {
      return <button onClick={this.onClick} type='button' {...sharedProps} />;
    }

    return <a href={this.props.url} onClick={this.onClick} {...sharedProps} />;
  }

  private children() {
    const icon = <span className={`fas fa-angle-${this.props.direction ?? 'down'}`} />;

    return (
      <>
        <span className={`${bn}__spinner`}>
          <Spinner />
        </span>
        <span className={`${bn}__label`}>
          <span className={`${bn}__label-icon ${bn}__label-icon--left`}>
            {icon}
          </span>

          <span className={`${bn}__label-text`}>
            {this.props.label ?? osu.trans('common.buttons.show_more')}
            {this.props.remaining != null && ` (${this.props.remaining})`}
          </span>

          <span className={`${bn}__label-icon ${bn}__label-icon--right`}>
            {icon}
          </span>
        </span>
      </>
    );
  }

  private readonly onClick = () => {
    if (this.props.callback == null) {
      if (this.props.url == null && this.props.event != null) {
        $.publish(this.props.event, this.props.data);
      }
    } else {
      this.props.callback(this.props.data);
    }
  };
}
