// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import MentionCompletionBoxEntry from './mention-completion-box-entry';
import MentionCompletionBoxState from './mention-completion-box-state';

interface Props {
  state: MentionCompletionBoxState;
}

@observer
export default class MentionCompletionBox extends React.Component<Props> {
  private readonly boxRef = React.createRef<HTMLDivElement>();

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentDidMount() {
    document.addEventListener('click', this.handleDocumentClick);
  }

  componentWillUnmount() {
    document.removeEventListener('click', this.handleDocumentClick);
  }

  render() {
    if (!this.props.state.visible) return null;

    const users = this.props.state.users;

    if (users?.length === 0) {
      return null;
    }

    return (
      <div ref={this.boxRef} className='chat-mention-completion-box'>
        {users == null ? (
          <span className='chat-mention-completion-box__searching'>
            <Spinner />
            {trans('chat.searching_users')}
          </span>
        ) : (
          users.map((user, i) => (
            <MentionCompletionBoxEntry
              key={`${user.id}-${i}`}
              active={i === this.props.state.selectedIndex}
              state={this.props.state}
              user={user}
            />
          ))
        )}
      </div>
    );
  }

  @action
  private readonly handleDocumentClick = (e: PointerEvent) => {
    const box = this.boxRef.current;
    const input = this.props.state.inputBoxRef.current;
    if (box == null || input == null) return;

    const target = e.target;
    if (target instanceof Node && !box.contains(target) && !input.contains(target)) {
      this.props.state.visible = false;
    }
  };
}
