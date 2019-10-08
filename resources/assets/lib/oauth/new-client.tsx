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

import { FormErrors } from 'form-errors';
import { OwnClientJSON } from 'interfaces/own-client-json';
import { route } from 'laroute';
import { action } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Spinner } from 'spinner';
import { StringWithComponent } from 'string-with-component';
import { ValidatingInput } from 'validating-input';

const store = core.dataStore.ownClientStore;
const uiState = core.dataStore.uiState;

@observer
export class NewClient extends React.Component {
  private static readonly inputFields = ['name', 'redirect'];

  private errors = new FormErrors();

  handleCancel = () => {
    uiState.account.newClientVisible = false;
    uiState.account.isCreatingNewClient = false;
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
    if (uiState.account.isCreatingNewClient) {
      return;
    }

    uiState.account.isCreatingNewClient = true;

    $.ajax({
      data: this.state,
      method: 'POST',
      url: route('oauth.clients.store'),
    }).then((data: OwnClientJSON) => {
      const client = store.updateWithJson(data);
      uiState.account.newClientVisible = false;
      uiState.account.client = client;
    }).catch(this.errors.handleResponse)
    .always(() => {
      uiState.account.isCreatingNewClient = false;
    });
  }

  render() {
    const link = (
      <a
        className='oauth-client-details__link'
        href={`${process.env.DOCS_URL}#terms-of-use`}
        key='link'
      >
        {osu.trans('oauth.new_client.terms_of_use.link')}
      </a>
    );

    return (
        <div className='oauth-client-details'>
          <div className='oauth-client-details__header'>
            {osu.trans('oauth.new_client.header')}
          </div>

          <form className='oauth-client-details__content' autoComplete='off'>
            {this.renderRemainingErrors()}

            {NewClient.inputFields.map((name) => {
              return (
                <div className='oauth-client-details__group' key={name}>
                  <div className='oauth-client-details__label'>{osu.trans(`oauth.client.${name}`)}</div>
                  <ValidatingInput
                    blockName='oauth-client-details'
                    errors={this.errors}
                    name={name}
                    onChange={this.handleInputChange}
                    type='text'
                  />
                </div>
              );
            })}

            <div>
              <StringWithComponent pattern={osu.trans('oauth.new_client.terms_of_use._')} mappings={{ ':link': link }} />
            </div>

            <div className='oauth-client-details__buttons'>
              <button className='btn-osu-big' type='button' onClick={this.handleSubmit}>
                {uiState.account.isCreatingNewClient ? <Spinner /> : osu.trans('oauth.new_client.register')}
              </button>
              <button className='btn-osu-big' type='button' onClick={this.handleCancel}>{osu.trans('common.buttons.cancel')}</button>
            </div>
          </form>
        </div>
    );
  }

  renderRemainingErrors() {
    return this.errors.except(NewClient.inputFields).map((error, index) => {
      return <div className='oauth-client-details__error' key={index}>{error}</div>;
    });
  }
}
