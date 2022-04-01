// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import ConversationView from './conversation-view';
import InputBox from './input-box';

type Props = Record<string, never>;

@observer
export default class ConversationPanel extends React.Component<Props> {
  @computed
  private get currentChannel() {
    return core.dataStore.chatState.selectedChannel;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    if (this.currentChannel == null) {
      return (
        <div className='chat__not-active'>
          <Img2x alt='Art by Badou_Rammsteiner' src='/images/layout/chat/none-yet.png' title='Art by Badou_Rammsteiner' />
          <div className='chat__title'>{osu.trans('chat.not_found')}</div>
        </div>
      );
    }

    return (
      <>
        <ConversationView />
        <InputBox />
      </>
    );
  }
}
