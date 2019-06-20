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

import * as React from 'react';

interface ClientJSON {
  created_at: string;
  id: number;
  name: string;
  password_client: boolean;
  personal_access_client: boolean;
  redirect: string;
  revoked: boolean;
  secret: string;
  updated_at: string;
  user_id: number;
}

interface Props {
}

interface State {
  clients: ClientJSON[];
}

export class Clients extends React.Component<Props, State> {
  readonly state: State = {
    clients: [],
  };

  componentDidMount() {
    this.getClients();
  }

  async delete(id: string) {
    await $.ajax({
      method: 'DELETE',
      url: '/oauth/clients/' + id,
    });

    this.getClients();
  }

  deleteClicked(event: React.MouseEvent) {
    const clientId = (event.target as HTMLElement).dataset.clientId;
    if (clientId != null) {
      this.delete(clientId);
    }
  }

  async getClients() {
    const response: ClientJSON[] = await $.get('/oauth/clients');
    this.setState({ clients: response });
  }

  render() {
    const rows: JSX.Element[] = [];
    for (const client of this.state.clients) {
      rows.push((
        <tr key={client.id}>
          <td>{client.name}</td>
          <td>{client.revoked ? 'Yes' : 'No'}</td>
          <td>
            <button
              data-client-id={client.id}
              onClick={this.deleteClicked}
            >
              Delete
            </button>

          </td>
        </tr>
      ));
    }

    return (
      <table>
        <thead>
          <tr>
            <td>Name</td>
            <td>Revoked</td>
            <td />
          </tr>
        </thead>
        <tbody>
          {rows}
        </tbody>
      </table>
    );
  }
}
