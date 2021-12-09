// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';

interface State {
  hasError: boolean;
}

@observer
export default class MessageErrorBoundary extends React.Component<unknown, State> {
  state: Readonly<State> = { hasError: false };

  static getDerivedStateFromError(_error: Error) {
    return { hasError: true };
  }

  render() {
    if (this.state.hasError) {
      return (
        <div className='chat-message-item'>
          <span className='chat-message-item__error'>{osu.trans('chat.message.render_failed')}</span>
        </div>
      );
    }

    return this.props.children;
  }
}
