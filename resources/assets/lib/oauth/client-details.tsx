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

@observer
export class ClientDetails extends React.Component<Props> {
  @action
  handleCloseClick = () => {
    uiState.account.client = null;
  }

  handleDeleteClick = () => {

  }

  handleRevokeAllTokens = () => {

  }

  handleUpdateClick = () => {
    this.props.client.redirect = 'http://derp';
    this.props.client.update();
  }

  render() {
    return (
      <div className='oauth-client-details'>
        <div className='oauth-client-details__name'>{this.props.client.name}</div>

        <div>{this.props.client.redirect}</div>
        Client ID
        <div>{this.props.client.id}</div>
        Client Secret
        <div>{this.props.client.secret}</div>
        <button className='btn-osu-big btn-osu-big--danger' onClick={this.handleRevokeAllTokens}>Revoke all user tokens</button>

        <form autoComplete='off'>
          <div className='account-edit-entry'>
            <div className='account-edit-entry__label'>Authorization callback URL</div>

            <input className='account-edit-entry__input' type='text' defaultValue={this.props.client.redirect} />
          </div>

          <button className='btn-osu-big' type='button'>Update Application</button>
          <button className='btn-osu-big btn-osu-big--danger' onClick={this.handleDeleteClick}>Delete Application</button>
          <button className='btn-osu-big' onClick={this.handleCloseClick}>Close</button>
        </form>
      </div>
    );
  }
}
