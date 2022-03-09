// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea/lib';

type Props = Record<string, never>;

@observer
export default class CreateChannel extends React.Component<Props> {
  @observable private name = '';
  @observable private usersText = '';

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='chat-create-channel'>
        <div className='chat-create-channel__title'>Create New Announcement</div>
        <div className='chat-create-channel__container'>
          room name
          <input
            className='chat-create-channel__input'
            onChange={this.handleNameInput}
            value={this.name}
          />
        </div>
        <div className='chat-create-channel__container'>
          players to invite
          <input
            className='chat-create-channel__input'
            onChange={this.handleUsersTestInput}
            value={this.usersText}
          />
        </div>
        <div className='chat-create-channel__container'>
          <TextareaAutosize
            autoComplete='off'
            className='chat-create-channel__box'
            maxRows={10}
            name='textbox'
            placeholder={osu.trans('chat.input.placeholder')}
          />
        </div>
        <div className='chat-create-channel__button-bar'>
          <BigButton
            modifiers='chat-send'
            props={{ onClick: this.handleButtonClick }}
            text='Create'
          />
        </div>
      </div>
    );
  }

  private handleButtonClick = () => {
    // TODO
  };

  @action
  private handleNameInput = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.name = e.currentTarget.value;
  };

  @action
  private handleUsersTestInput = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.usersText = e.currentTarget.value;
  };

  private lookupUsers() {
    // TODO
  }
}
