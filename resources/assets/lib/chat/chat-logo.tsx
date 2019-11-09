/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import * as React from 'react';

export default class ChatLogo extends React.Component<any, any> {
  render(): React.ReactNode {
    return (
      <div className='chat-logo'>
        <div className='chat-logo__icon'/>
        <div className='chat-logo__title'>{osu.trans('chat.title')}</div>
      </div>
    );
  }
}
