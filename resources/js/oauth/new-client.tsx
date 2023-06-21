// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import StringWithComponent from 'components/string-with-component';
import { ValidatingInput } from 'components/validating-input';
import { FormErrors } from 'form-errors';
import { OwnClientJson } from 'interfaces/own-client-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

const store = core.dataStore.ownClientStore;
const uiState = core.dataStore.uiState;

@observer
export class NewClient extends React.Component {
  private static readonly inputFields = ['name', 'redirect'] as const;

  private errors = new FormErrors();
  @observable private params = {
    name: '',
    redirect: '',
  };

  constructor(props: Record<string, never>) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='oauth-client-details'>
        <div className='oauth-client-details__header'>
          {trans('oauth.new_client.header')}
        </div>

        <form autoComplete='off' className='oauth-client-details__content'>
          {this.renderRemainingErrors()}

          <label className='oauth-client-details__group'>
            <div className='oauth-client-details__label'>
              {trans('oauth.client.name')}
            </div>
            <ValidatingInput
              blockName='oauth-client-details'
              errors={this.errors}
              name='name'
              onChange={this.handleOnChangeName}
              type='text'
              value={this.params.name}
            />
          </label>

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
              value={this.params.redirect}
            />
            {(this.errors.get('redirect') ?? []).map((message, index) => (
              <div key={index} className='oauth-client-details__error'>
                {message}
              </div>
            ))}
          </label>

          <div>
            <StringWithComponent
              mappings={{ link: (
                <a href={`${process.env.DOCS_URL}#terms-of-use`}>
                  {trans('oauth.new_client.terms_of_use.link')}
                </a>
              ) }}
              pattern={trans('oauth.new_client.terms_of_use._')}
            />
          </div>

          <div className='oauth-client-details__buttons'>
            <button className='btn-osu-big' onClick={this.handleSubmit} type='button'>
              {uiState.account.isCreatingNewClient ? <Spinner /> : trans('oauth.new_client.register')}
            </button>
            <button className='btn-osu-big' onClick={this.handleCancel} type='button'>{trans('common.buttons.cancel')}</button>
          </div>
        </form>
      </div>
    );
  }

  @action
  private readonly handleCancel = () => {
    uiState.account.newClientVisible = false;
    uiState.account.isCreatingNewClient = false;
  };

  @action
  private readonly handleOnChangeName = (event: React.ChangeEvent<HTMLInputElement>) => {
    this.params.name = event.currentTarget.value;
  };

  @action
  private readonly handleOnChangeRedirect = (event: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.params.redirect = event.currentTarget.value;
  };

  @action
  private readonly handleSubmit = () => {
    if (uiState.account.isCreatingNewClient) {
      return;
    }

    uiState.account.isCreatingNewClient = true;

    $.ajax({
      data: this.params,
      method: 'POST',
      url: route('oauth.clients.store'),
    }).then(action((data: OwnClientJson) => {
      const client = store.updateWithJson(data);
      uiState.account.newClientVisible = false;
      uiState.account.client = client;
    })).catch(this.errors.handleResponse)
      .always(action(() => {
        uiState.account.isCreatingNewClient = false;
      }));
  };

  private renderRemainingErrors() {
    return this.errors.except(NewClient.inputFields as readonly string[]).map((error, index) => (
      <div key={index} className='oauth-client-details__error'>{error}</div>
    ));
  }
}
