// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea/lib';
import { classWithModifiers, Modifiers } from 'utils/css';
import DiscussionMessage from './discussion-message';
import DiscussionMessageLengthCounter from './discussion-message-length-counter';

const modes = ['preview', 'write'] as const;
export type Mode = typeof modes[number];

const modeLookup = new Set<unknown>(modes);

export function isValidMode(value: unknown): value is Mode {
  return modeLookup.has(value);
}

// TODO: figure out inheriting TextareaAutosize props withtout long syntax.
interface Props {
  disabled?: boolean;
  isTimeline: boolean;
  mode?: Mode;
  modifiers?: Modifiers;
  onChange?: React.FormEventHandler<HTMLTextAreaElement>;
  onFocus?: React.FocusEventHandler<HTMLTextAreaElement>;
  onKeyDown?: React.KeyboardEventHandler<HTMLTextAreaElement>;
  placeholder?: string;
  textareaRef?: React.RefObject<HTMLTextAreaElement>;
  value: string;
}

@observer
export default class MarkdownEditor extends React.Component<Props> {
  render() {
    const { isTimeline, mode, textareaRef, ...otherProps } = this.props;

    return (
      <div className='markdown-editor'>
        {mode === 'preview' ? (
          <DiscussionMessage markdown={this.props.value} />
        ) : (
          <>
            <TextareaAutosize
              ref={textareaRef}
              className={classWithModifiers('markdown-editor__textarea', this.props.modifiers)}
              {...otherProps}
            />
            <DiscussionMessageLengthCounter isTimeline={isTimeline} message={this.props.value} />
          </>
        )}
      </div>
    );
  }
}
