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

import { OwnClientJSON } from 'interfaces/own-client-json';
import { action } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';

const store = core.dataStore.ownClientStore;
const uiState = core.dataStore.uiState;

@observer
export class NewClient extends React.Component {
  handleCancel = () => {
    uiState.account.newClientVisible = false;
  }

  handleInputChange = (event: React.SyntheticEvent<HTMLInputElement>) => {
    const target = event.target as HTMLInputElement;
    const { name, value } = target;

    this.setState({
      [name]: value,
    });
  }

  @action
  handleSubmit = () => {
    $.ajax({
      data: this.state,
      method: 'POST',
      url: laroute.route('oauth.clients.store'),
    }).then((data: OwnClientJSON) => {
      const client = store.updateWithJson(data);
      uiState.account.newClientVisible = false;
      uiState.account.client = client;
    }).catch(osu.ajaxError);
  }

  render() {
    return (
        <form className='oauth-client-details' autoComplete='off'>
          <div className='oauth-client-details__group'>
            <div className='oauth-client-details__label'>Application Name</div>
            <input className='oauth-client-details__input' name='name' onChange={this.handleInputChange} type='text' />
          </div>

          <div className='oauth-client-details__group'>
            <div className='oauth-client-details__label'>Authorization callback URL</div>
            <input className='oauth-client-details__input' name='redirect' onChange={this.handleInputChange} type='text' />
          </div>

          <button className='btn-osu-big' type='button' onClick={this.handleSubmit}>Register application</button>
          <button className='btn-osu-big' type='button' onClick={this.handleCancel}>Cancel</button>
        </form>
    );
  }
}
