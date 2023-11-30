// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import autosize from 'autosize';
import React from 'react';

interface Props extends React.TextareaHTMLAttributes<HTMLTextAreaElement> {
  async: boolean;
  innerRef?: React.RefObject<HTMLTextAreaElement>;
  maxRows?: number;
}

interface State {
  lineHeight?: number;
}

export default class TextareaAutosize extends React.PureComponent<Props, State> {
  static readonly defaultProps = {
    async: false,
    rows: 1,
  };

  private readonly ref = this.props.innerRef ?? React.createRef<HTMLTextAreaElement>();
  private shouldUpdate = true;

  private get maxHeight() {
    return this.props.maxRows != null && this.state.lineHeight != null
      ? this.state.lineHeight * (this.props.maxRows + 1) // additional row to fit maxRows + slight leeway for scrollbar
      : null;
  }

  constructor(props: Props) {
    super(props);
    this.state = {};
  }

  componentDidMount() {
    if (this.ref.current == null) return;

    if (this.props.maxRows != null || this.props.async) {
      window.setTimeout(() => {
        if (this.ref.current != null) {
          if (this.props.maxRows != null) {
            // getting line-height should be delayed until after turbolinks navigation, otherwise it returns NaN.
            const lineHeight = Math.ceil(parseFloat(window.getComputedStyle(this.ref.current).getPropertyValue('line-height')));
            this.setState({ lineHeight });
          }

          autosize(this.ref.current);
        }
      }, 0);
    } else {
      autosize(this.ref.current);
    }
  }

  componentDidUpdate() {
    if (this.ref.current == null) return;

    // autosize sets overflowX to 'scroll' on update unless the existing style is 'hidden'.
    // It doesn't work if the style is set on class, component or didMount.
    if (this.ref.current.style.overflowX !== 'hidden') {
      this.ref.current.style.overflowX = 'hidden';
    }

    // Avoid double updating since autosize automatically triggers update on input.
    if (this.shouldUpdate) {
      autosize.update(this.ref.current);
    } else {
      this.shouldUpdate = true;
    }
  }

  componentWillUnmount() {
    if (this.ref.current == null) return;
    autosize.destroy(this.ref.current);
  }

  render() {
    const { async, innerRef, onInput, maxRows, style, ...otherProps } = this.props;

    const maxHeight = this.maxHeight;

    return (
      <textarea
        ref={this.ref}
        onInput={this.handleInput}
        style={maxHeight != null ? { ...style, maxHeight } : style}
        {...otherProps}
      />
    );
  }

  private readonly handleInput = (event: React.SyntheticEvent<HTMLTextAreaElement>) => {
    this.shouldUpdate = false;
    this.props.onInput?.(event);
  };
}
