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

import { observer } from 'mobx-react';
import { Client } from 'oauth/client';
import * as React from 'react';
import { Spinner } from 'spinner';

interface Props {
  client: Client;
}

@observer
export class OwnClient extends React.Component<Props> {
  deleteClicked = (event: React.MouseEvent<HTMLElement>) => {
    if (!confirm('Deleting the application cannot be undone!')) { return; }

    this.props.client.delete().catch(osu.ajaxError);
  }

  render() {
    const client = this.props.client;

    return (
      <div className='authorized-client'>
        <div className='authorized-client__details'>
          <div className='authorized-client__name'>
            {client.name}
          </div>
          <div>
            {client.redirect}
          </div>
          <div>
            {client.revoked ? 'revoked' : 'active'}
          </div>
        </div>

        <div className='authorized-client__actions'>
          <button
            className={osu.classWithModifiers('authorized-client__button', client.revoked ? ['revoked'] : [])}
            onClick={this.deleteClicked}
            disabled={client.isRevoking || client.revoked}
          >
            {
              client.isRevoking ? <Spinner /> : 'Delete'
            }
          </button>
        </div>
      </div>
    );
  }
}
