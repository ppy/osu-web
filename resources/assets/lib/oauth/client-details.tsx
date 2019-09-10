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

import { FormErrors, HandlesErrors } from 'form-errors';
import { action } from 'mobx';
import { observer } from 'mobx-react';
import { OwnClient as Client } from 'models/oauth/own-client';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Spinner } from 'spinner';
import { ValidatingInput } from 'validating-input';

const uiState = core.dataStore.uiState;

interface Props {
  client: Client;
}

interface State {
  redirect: string;
  [key: string]: string;
}

@observer
export class ClientDetails extends React.Component<Props, State> implements HandlesErrors {
  errors = new FormErrors();

  readonly state: State = {
    redirect: this.props.client.redirect,
  };

  @action
  handleClose = () => {
    uiState.account.client = null;
  }

  @action
  handleDelete = () => {
    if (this.props.client.isRevoking) { return; }
    if (!confirm(osu.trans('oauth.own_clients.confirm_delete'))) { return; }

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
  handleSubmit = () => {
    if (this.props.client.isUpdating) { return; }
    // FIXME: per-field error.
    this.props.client.updateWith(this.state).then(() => {
      uiState.account.client = null;
    }).catch(this.errors.loadErrors);
  }

  render() {
    return (
      <div className='oauth-client-details'>
        <div className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>{osu.trans('oauth.client.name')}</div>
          <div>{this.props.client.name}</div>
        </div>
        <div className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>{osu.trans('oauth.client.id')}</div>
          <div>{this.props.client.id}</div>
        </div>
        <div>
          <div className='oauth-client-details__label'>{osu.trans('oauth.client.secret')}</div>
          <div>{this.props.client.secret}</div>
        </div>

        <div className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>{osu.trans('oauth.client.redirect')}</div>
          <ValidatingInput
            blockName='oauth-client-details'
            errors={this.errors}
            name='redirect'
            onChange={this.handleInputChange}
            type='text'
            value={this.state.redirect}
          />
        </div>

        <div className='oauth-client-details__buttons'>
          <button
            className='btn-osu-big btn-osu-big--settings-oauth'
            disabled={this.props.client.isUpdating || this.props.client.revoked}
            onClick={this.handleSubmit}
            type='button'
          >
            {this.props.client.isUpdating ? <Spinner /> : osu.trans('common.buttons.update')}
          </button>

          <button
            className='btn-osu-big btn-osu-big--danger btn-osu-big--settings-oauth'
            disabled={this.props.client.isRevoking || this.props.client.revoked}
            onClick={this.handleDelete}
            type='button'
          >
            {this.props.client.isRevoking ? <Spinner /> : osu.trans('common.buttons.delete')}
          </button>
        </div>

        <div className='oauth-client-details__buttons'>
          <button className='btn-osu-big btn-osu-big--settings-oauth' onClick={this.handleClose}>{osu.trans('common.buttons.close')}</button>
        </div>
      </div>
    );
  }
}
