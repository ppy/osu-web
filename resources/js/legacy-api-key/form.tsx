// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import StringWithComponent from 'components/string-with-component';
import { ValidatingInput } from 'components/validating-input';
import { FormErrors } from 'form-errors';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import Controller from './controller';

interface Props {
  controller: Controller;
}

@observer
export default class Form extends React.Component<Props> {
  @observable private appName = '';
  @observable private appUrl = '';
  private errors = new FormErrors();

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  @action
  readonly onCancelClick = () => {
    if (this.appUrl !== '' || this.appName !== '') {
      if (!confirm(trans('common.confirmation'))) return;
    }

    this.props.controller.state.showing_form = false;
  };

  render() {
    return (
      <div className='oauth-client-details'>
        <div className='oauth-client-details__header'>
          {trans('legacy_api_key.new')}
        </div>

        <form className='oauth-client-details__content'>
          <label className='oauth-client-details__group'>
            <div className='oauth-client-details__label'>{trans('model_validation.legacy_api_key.attributes.app_name')}</div>
            <ValidatingInput
              blockName='oauth-client-details'
              errors={this.errors}
              name='legacy_api_key[app_name]'
              onInput={this.onAppNameInput}
              required
              value={this.appName}
            />
          </label>

          <label className='oauth-client-details__group'>
            <div className='oauth-client-details__label'>{trans('model_validation.legacy_api_key.attributes.app_url')}</div>
            <ValidatingInput
              blockName='oauth-client-details'
              errors={this.errors}
              name='legacy_api_key[app_url]'
              onInput={this.onAppUrlInput}
              required
              type='url'
              value={this.appUrl}
            />
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
            <button className='btn-osu-big' onClick={this.onSubmit}>
              {this.props.controller.isCreating ? <Spinner /> : trans('legacy_api_key.form.create')}
            </button>
            <button className='btn-osu-big' onClick={this.onCancelClick} type='button'>{trans('common.buttons.cancel')}</button>
          </div>
        </form>
      </div>
    );
  }

  @action
  private readonly onAppNameInput = (e: React.KeyboardEvent<HTMLInputElement>) => {
    this.appName = e.currentTarget.value;
  };

  @action
  private readonly onAppUrlInput = (e: React.KeyboardEvent<HTMLInputElement>) => {
    this.appUrl = e.currentTarget.value;
  };

  @action
  private readonly onSubmit = (e: React.SyntheticEvent) => {
    e.preventDefault();

    if (this.props.controller.isCreating) {
      return;
    }

    this.props.controller.createKey(this.appName, this.appUrl)
      .fail(this.errors.handleResponse)
      .done(action(() => {
        this.props.controller.state.showing_form = false;
      }));
  };
}
