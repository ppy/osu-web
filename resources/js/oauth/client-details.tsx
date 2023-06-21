// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { FormErrors } from 'form-errors';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import { OwnClient as Client } from 'models/oauth/own-client';
import core from 'osu-core-singleton';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea';
import { onError } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

const uiState = core.dataStore.uiState;

interface Props {
  client: Client;
}

interface State {
  [key: string]: unknown;

  isSecretVisible: boolean;
  redirect: string;
}

@observer
export class ClientDetails extends React.Component<Props, State> {
  private readonly errors = new FormErrors();
  @observable private isSecretVisible = false;
  @observable private redirect = this.props.client.redirect.replace(/,/g, '\r\n');

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='oauth-client-details'>
        <div className='oauth-client-details__header'>
          {this.props.client.name}
        </div>

        <div className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>{trans('oauth.client.id')}</div>
          <div>{this.props.client.id}</div>
        </div>
        <div className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>{trans('oauth.client.secret')}</div>
          <div>
            {
              this.isSecretVisible
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
              {trans(`oauth.client.secret_visible.${this.isSecretVisible}`)}
            </button>
            <button
              className='btn-osu-big btn-osu-big--danger'
              disabled={this.props.client.isResetting || this.props.client.revoked}
              onClick={this.handleReset}
              type='button'
            >
              {this.props.client.isResetting ? <Spinner /> : trans('oauth.client.reset')}
            </button>
          </div>
        </div>

        <label className='oauth-client-details__group'>
          <div className='oauth-client-details__label'>
            {trans('oauth.client.redirect')}
          </div>
          <TextareaAutosize
            async
            className={classWithModifiers(
              'oauth-client-details__input',
              'textarea',
              { 'has-error': (this.errors.get('redirect') ?? []).length > 0 },
            )}
            name='redirect'
            onChange={this.handleOnChangeRedirect}
            value={this.redirect}
          />
          {(this.errors.get('redirect') ?? []).map((message, index) => (
            <div key={index} className='oauth-client-details__error'>
              {message}
            </div>
          ))}
        </label>

        <div className='oauth-client-details__buttons'>
          <button
            className='btn-osu-big'
            disabled={this.props.client.isUpdating || this.props.client.revoked}
            onClick={this.handleUpdate}
            type='button'
          >
            {this.props.client.isUpdating ? <Spinner /> : trans('common.buttons.update')}
          </button>

          <button
            className='btn-osu-big btn-osu-big--danger'
            disabled={this.props.client.isRevoking || this.props.client.revoked}
            onClick={this.handleDelete}
            type='button'
          >
            {this.props.client.isRevoking ? <Spinner /> : trans('common.buttons.delete')}
          </button>
        </div>

        <div className='oauth-client-details__buttons'>
          <button className='btn-osu-big' onClick={this.handleClose}>{trans('common.buttons.close')}</button>
        </div>
      </div>
    );
  }

  @action
  private readonly handleClose = () => {
    uiState.account.client = null;
  };

  @action
  private readonly handleDelete = () => {
    if (this.props.client.isRevoking) return;
    if (!confirm(trans('oauth.own_clients.confirm_delete'))) return;

    this.props.client.delete().then(action(() => {
      uiState.account.client = null;
    }));
  };

  @action
  private readonly handleOnChangeRedirect = (event: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.redirect = event.currentTarget.value;
  };

  @action
  private readonly handleReset = () => {
    if (!confirm(trans('oauth.own_clients.confirm_reset'))) return;
    if (this.props.client.isResetting) return;

    this.props.client.resetSecret()
      .done(action(() => {
        this.isSecretVisible = true;
      }))
      .fail(onError);
  };

  @action
  private readonly handleToggleSecret = () => {
    this.isSecretVisible = !this.isSecretVisible;
  };

  @action
  private readonly handleUpdate = () => {
    if (this.props.client.isUpdating) return;
    this.props.client.updateWith({ redirect: this.redirect }).then(() => {
      this.errors.clear();
    }).catch(this.errors.handleResponse);
  };
}
