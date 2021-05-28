// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { FormErrors } from 'form-errors';
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
  isSecretVisible: boolean;
  redirect: string;

  [key: string]: unknown;
}

@observer
export class ClientDetails extends React.Component<Props, State> {
  state: Readonly<State> = {
    isSecretVisible: false,
    redirect: this.props.client.redirect,
  };

  private errors = new FormErrors();

  @action
  handleClose = () => {
    uiState.account.client = null;
  };

  @action
  handleDelete = () => {
    if (this.props.client.isRevoking) return;
    if (!confirm(osu.trans('oauth.own_clients.confirm_delete'))) return;

    this.props.client.delete().then(() => {
      uiState.account.client = null;
    });
  };

  @action
  handleInputChange = (event: React.SyntheticEvent<HTMLInputElement>) => {
    const target = event.target as HTMLInputElement;
    const { name, value } = target;

    this.setState({
      [name]: value,
    });
  };

  @action
  handleReset = () => {
    if (!confirm(osu.trans('oauth.own_clients.confirm_reset'))) return;
    if (this.props.client.isResetting) return;

    this.props.client.resetSecret()
      .then(() => this.setState({ isSecretVisible: true }))
      .catch(osu.ajaxError);
  };

  @action
  handleToggleSecret = () => {
    this.setState({ isSecretVisible: !this.state.isSecretVisible });
  };

  @action
  handleUpdate = () => {
    if (this.props.client.isUpdating) return;
    this.props.client.updateWith(this.state).then(() => {
      this.errors.clear();
    }).catch(this.errors.handleResponse);
  };

  render() {
    return (
      <div className='oauth-client-details'>
        <div className='oauth-client-details__header'>
          {this.props.client.name}
        </div>

        <div className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>{osu.trans('oauth.client.id')}</div>
          <div>{this.props.client.id}</div>
        </div>
        <div className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>{osu.trans('oauth.client.secret')}</div>
          <div>
            {
              this.state.isSecretVisible
                ? this.props.client.secret
                : 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
            }
          </div>
          <div className='oauth-client-details__buttons'>
            <button
              className='btn-osu-big'
              onClick={this.handleToggleSecret}
              type='button'
            >
              {osu.trans(`oauth.client.secret_visible.${this.state.isSecretVisible}`)}
            </button>
            <button
              className='btn-osu-big btn-osu-big--danger'
              disabled={this.props.client.isResetting || this.props.client.revoked}
              onClick={this.handleReset}
              type='button'
            >
              {this.props.client.isResetting ? <Spinner /> : osu.trans('oauth.client.reset')}
            </button>
          </div>
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
            className='btn-osu-big'
            disabled={this.props.client.isUpdating || this.props.client.revoked}
            onClick={this.handleUpdate}
            type='button'
          >
            {this.props.client.isUpdating ? <Spinner /> : osu.trans('common.buttons.update')}
          </button>

          <button
            className='btn-osu-big btn-osu-big--danger'
            disabled={this.props.client.isRevoking || this.props.client.revoked}
            onClick={this.handleDelete}
            type='button'
          >
            {this.props.client.isRevoking ? <Spinner /> : osu.trans('common.buttons.delete')}
          </button>
        </div>

        <div className='oauth-client-details__buttons'>
          <button className='btn-osu-big' onClick={this.handleClose}>{osu.trans('common.buttons.close')}</button>
        </div>
      </div>
    );
  }
}
