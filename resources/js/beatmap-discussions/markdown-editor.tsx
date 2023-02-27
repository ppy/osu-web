// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea/lib';
import { classWithModifiers } from 'utils/css';
import DiscussionMessage from './discussion-message';
import DiscussionMessageLengthCounter from './discussion-message-length-counter';

export type Mode = 'preview' | 'write';

interface Props {
  disabled?: boolean;
  isTimeline: boolean;
  mode: Mode;
  onChange?: React.FormEventHandler<HTMLTextAreaElement>;
  onKeyDown?: React.KeyboardEventHandler<HTMLTextAreaElement>;
  style?: React.CSSProperties;
  textareaClassName?: string;
  textareaRef?: React.RefObject<HTMLTextAreaElement>;
  value: string;
}

@observer
export default class MarkdownEditor extends React.Component<Props> {
  constructor(props: Props) {
    super(props);
  }

  render() {
    const { isTimeline, textareaClassName, textareaRef, ...otherProps } = this.props;

    return (
      <div className='markdown-editor'>
        {this.props.mode === 'write' ? (
          <>
            <TextareaAutosize
              ref={textareaRef}
              className={textareaClassName}
              {...otherProps}
            />
            <DiscussionMessageLengthCounter isTimeline={isTimeline} message={this.props.value} />
          </>
        ) : (
          <DiscussionMessage markdown={this.props.value} />
        )}
      </div>
    );
  }
}
