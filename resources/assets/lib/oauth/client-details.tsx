/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { action } from 'mobx';
import { observer } from 'mobx-react';
import { OwnClient as Client } from 'models/oauth/own-client';
import core from 'osu-core-singleton';
import * as React from 'react';

const uiState = core.dataStore.uiState;

interface Props {
  client: Client;
}

interface State {
  redirect: string;
  [key: string]: string;
}

@observer
export class ClientDetails extends React.Component<Props, State> {
  readonly state: State = {
    redirect: this.props.client.redirect,
  };

  @action
  handleCloseClick = () => {
    uiState.account.client = null;
  }

  @action
  handleDeleteClick = () => {
    if (!confirm(osu.trans('oauth.clients.confirm_delete'))) { return; }

    this.props.client.delete().then(() => {
      uiState.account.client = null;
    });
  }

  @action
  handleInputChange = (event: React.SyntheticEvent<HTMLInputElement>) => {
    const target = event.target as HTMLInputElement;
    const { name, value } = target;

    this.setState({
      [name]: value,
    });
  }

  @action
  handleRevokeAllTokens = () => {
    if (!confirm(osu.trans('oauth.clients.confirm_revoke_tokens'))) { return; }

    console.log('revoke all');
  }

  @action
  handleSubmit = () => {
    // TODO: handle errors
    this.props.client.redirect = this.state.redirect;
    this.props.client.update();
  }

  render() {
    return (
      <div className='oauth-client-details'>
        <div className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>Application Name</div>
          <div className='oauth-client-details__value'>{this.props.client.name}</div>
        </div>
        <div className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>Client ID</div>
          <div className='oauth-client-details__value'>{this.props.client.id}</div>
        </div>
        <div>
          <div className='oauth-client-details__label'>Client Secret</div>
          <div className='oauth-client-details__value'>{this.props.client.secret}</div>
        </div>
        <button className='btn-osu-big btn-osu-big--danger' onClick={this.handleRevokeAllTokens}>Revoke all user tokens</button>

        <div className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>Application Callback URL</div>
          <input className='account-edit-entry__input' name='redirect' type='text' onChange={this.handleInputChange} value={this.state.redirect} />
        </div>

        <button className='btn-osu-big' type='button' onClick={this.handleSubmit}>Update Application</button>
        <button className='btn-osu-big btn-osu-big--danger' onClick={this.handleDeleteClick}>Delete Application</button>
        <button className='btn-osu-big' onClick={this.handleCloseClick}>Close</button>
      </div>
    );
  }
}
