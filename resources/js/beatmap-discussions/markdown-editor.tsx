// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea/lib';
import { classWithModifiers } from 'utils/css';
import DiscussionMessage from './discussion-message';
import DiscussionMessageLengthCounter from './discussion-message-length-counter';

type Mode = 'preview' | 'write';

interface Props {
  disabled?: boolean;
  isTimeline: boolean;
  onChange?: React.FormEventHandler<HTMLTextAreaElement>;
  onKeyDown?: React.KeyboardEventHandler<HTMLTextAreaElement>;
  style?: React.CSSProperties;
  textareaClassName?: string;
  textareaRef?: React.RefObject<HTMLTextAreaElement>;
  value: string;
}

@observer
export default class MarkdownEditor extends React.Component<Props> {
  @observable private mode: Mode = 'write';

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    const { isTimeline, textareaClassName, textareaRef, ...otherProps } = this.props;

    return (
      <div className='markdown-editor'>
        <div className='page-tabs'>
          {['write', 'preview'].map((mode) => (
            <button
              key={mode}
              className={classWithModifiers('page-tabs__tab', { active: mode === this.mode })}
              data-mode={mode}
              onClick={this.handleClick}
            >
              {mode}
            </button>
          ))}
        </div>
        {this.mode === 'write' ? (
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

  @action
  private handleClick = (event: React.SyntheticEvent<HTMLButtonElement>) => {
    this.mode = event.currentTarget.dataset.mode ?? 'write';
  };
}
