// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Spinner } from 'spinner';
import { classWithModifiers, Modifiers } from 'utils/css';

interface Props {
  disabled: boolean;
  extraClasses: string[];
  href?: string;
  icon?: string;
  isBusy: boolean;
  isSubmit: boolean;
  modifiers?: Modifiers;
  props: React.HTMLAttributes<HTMLElement> & Partial<Record<`data-${string}`, string | number>>;
  text?: {
    bottom?: string;
    top: React.ReactNode;
  } | string;
}

export default class BigButton extends React.PureComponent<Props> {
  static readonly defaultProps = {
    disabled: false,
    extraClasses: [],
    isBusy: false,
    isSubmit: false,
    props: {},
  };

  get text() {
    if (this.props.text == null) {
      return null;
    }

    if (typeof this.props.text === 'string') {
      return {
        top: this.props.text,
      };
    }

    return this.props.text;
  }

  render() {
    let blockClass = classWithModifiers('btn-osu-big', this.props.modifiers);
    if (this.props.extraClasses != null) {
      blockClass += ` ${this.props.extraClasses.join(' ')}`;
    }

    if (osu.present(this.props.href)) {
      if (this.props.disabled) {
        return (
          <span className={blockClass} {...this.props.props}>
            {this.renderChildren()}
          </span>
        );
      }

      return (
        <a
          className={blockClass}
          href={this.props.href}
          {...this.props.props}
        >
          {this.renderChildren()}
        </a>
      );
    }

    return (
      <button
        className={blockClass}
        disabled={this.props.disabled}
        type={this.props.isSubmit ? 'submit' : 'button'}
        {...this.props.props}
      >
        {this.renderChildren()}
      </button>
    );
  }

  private renderChildren() {
    const text = this.text;

    return (
      <span className={classWithModifiers('btn-osu-big__content', { center: text == null || this.props.icon == null })}>
        {text != null && (
          <span className='btn-osu-big__left'>
            <span className='btn-osu-big__text-top'>
              {text.top}
            </span>
            {'bottom' in text && text.bottom != null && (
              <span className='btn-osu-big__text-bottom'>{text.bottom}</span>
            )}
          </span>
        )}
        {this.props.icon != null && (
          <span className='btn-osu-big__icon'>
            {/* ensure no random width change when changing icon */}
            <span className='fa fa-fw'>
              {this.props.isBusy ? <Spinner modifiers='center-inline' /> : <span className={this.props.icon} />}
            </span>
          </span>
        )}
      </span>
    );
  }
}
