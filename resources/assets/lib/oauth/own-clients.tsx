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
import { Modal } from 'modal';
import { OwnClient } from 'oauth/own-client';
import core from 'osu-core-singleton';
import * as React from 'react';
import { ClientDetails } from './client-details';
import { NewClient } from './new-client';

const store = core.dataStore.ownClientStore;
const uiState = core.dataStore.uiState;

@observer
export class OwnClients extends React.Component {
  @action
  handleModalClose = () => {
    uiState.account.client = null;
    uiState.account.newClientVisible = false;
  }

  @action
  handleNewClientClicked = () => {
    uiState.account.newClientVisible = true;
  }

  render() {
    return (
      <>
        <div className='oauth-clients'>
          {store.clients.size > 0 ? this.renderClients() : this.renderEmpty()}
        </div>
        <button className='btn-osu-big btn-osu-big--settings-oauth' onClick={this.handleNewClientClicked}>New OAuth Application</button>

        {this.renderModaledComponents()}
      </>
    );
  }

  renderClients() {
    return [...store.clients.values()].map((client) => {
      return <OwnClient client={client} key={client.id} />;
    });
  }
  renderEmpty() {
    return osu.trans('oauth.own-clients.none');
  }

  renderModaledComponents() {
    let component: React.ReactElement;
    if (uiState.account.newClientVisible) {
      component = <NewClient />;
    } else if (uiState.account.client != null) {
      component = <ClientDetails client={uiState.account.client!} />;
    } else {
      return null;
    }

    return (
      <Modal visible={true} onClose={this.handleModalClose}>
        {component}
      </Modal>
    );
  }
}
