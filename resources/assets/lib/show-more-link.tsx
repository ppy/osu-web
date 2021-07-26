// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as osu from 'osu-common';
import * as React from 'react';
import { Spinner } from 'spinner';
import { classWithModifiers, Modifiers } from 'utils/css';

const bn = 'show-more-link';

interface Props {
  callback?: () => void;
  data?: unknown;
  direction?: string;
  event?: string;
  hasMore: boolean;
  label?: string;
  loading: boolean;
  modifiers?: Modifiers;
  remaining?: number;
  url?: string;
}

export default class ShowMoreLink extends React.PureComponent<Props> {
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

    let onClick = this.props.callback;

    if (onClick == null && this.props.url == null && this.props.event != null) {
      const event = this.props.event;
      onClick = () => $.publish(event, this.props.data);
    }

    if (this.props.url == null) {
      return <button onClick={onClick} type='button' {...sharedProps} />;
    }

    return <a href={this.props.url} onClick={onClick} {...sharedProps} />;
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
}
