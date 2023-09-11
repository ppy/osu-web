// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import autosize from 'autosize';
import React from 'react';

interface Props extends React.TextareaHTMLAttributes<HTMLTextAreaElement> {
  async: boolean;
  innerRef?: React.RefObject<HTMLTextAreaElement>;
  maxRows?: number;
}

export default class TextareaAutosize extends React.Component<Props> {
  static readonly defaultProps = {
    async: false,
    rows: 1,
  };

  private lineHeight?: number;
  private ref = this.props.innerRef ?? React.createRef<HTMLTextAreaElement>();

  private get maxHeight() {
    return this.props.maxRows != null && this.lineHeight
      ? Math.ceil(this.lineHeight * this.props.maxRows)
      : null;
  }

  componentDidMount() {
    if (this.ref.current == null) return;

    if (this.props.maxRows != null) {
      this.lineHeight = parseFloat(window.getComputedStyle(this.ref.current).getPropertyValue('line-height'));
    }

    if (this.props.maxRows != null || this.props.async) {
      window.setTimeout(() => {
        if (this.ref.current != null) {
          autosize(this.ref.current);
        }
      }, 0);
    } else {
      autosize(this.ref.current);
    }
  }

  componentDidUpdate() {
    if (this.ref.current == null) return;
    autosize.update(this.ref.current);
  }

  componentWillUnmount() {
    if (this.ref.current == null) return;
    autosize.destroy(this.ref.current);
  }

  render() {
    const { async, innerRef, maxRows, style, ...otherProps } = this.props;

    const maxHeight = this.maxHeight;

    return (
      <textarea
        ref={this.ref}
        style={maxHeight != null ? { ...style, maxHeight } : style}
        {...otherProps}
      />
    );
  }
}
