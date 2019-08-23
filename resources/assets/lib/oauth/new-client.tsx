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
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';

const store = core.dataStore.ownClientStore;

@observer
export class NewClient extends React.Component {
  handleInputChange = (event: React.SyntheticEvent<HTMLInputElement>) => {
    const target = event.target as HTMLInputElement;
    const value = target.value;
    const name = target.name;

    this.setState({
      [name]: value,
    });
  }

  handleSubmit = (event: React.SyntheticEvent) => {
    event.preventDefault();

    $.ajax({
      data: this.state,
      method: 'POST',
      url: laroute.route('oauth.clients.store'),
    }).then((data: OwnClientJSON) => {
      store.updateWithJson(data);
    }).catch(osu.ajaxError);
  }

  render() {
    return (
        <form className='oauth-client-details' autoComplete='off' onSubmit={this.handleSubmit} >
          <div className='account-edit-entry'>
            <input className='account-edit-entry__input' name='name' onChange={this.handleInputChange} type='text' />
            <div className='account-edit-entry__label'>Application Name</div>
          </div>

          <div className='account-edit-entry'>
            <input className='account-edit-entry__input' name='redirect' onChange={this.handleInputChange} type='text' />
            <div className='account-edit-entry__label'>Authorization callback URL</div>
          </div>

          <button className='oauth-client-details__button' type='submit'>Register application</button>
          <button className='oauth-client-details__button' type='button'>Cancel</button>
        </form>
    );
  }
}
