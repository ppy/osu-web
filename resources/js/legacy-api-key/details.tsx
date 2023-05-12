// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import StringWithComponent from 'components/string-with-component';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import Controller from './controller';

const docsUrl = 'https://github.com/ppy/osu-api/wiki';

interface Props {
  controller: Controller;
}

@observer
export default class Details extends React.Component<Props> {
  @observable private keyVisible = false;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    const key = this.props.controller.key;

    if (key == null) {
      throw new Error('rendering Key component with no key available');
    }

    return (
      <div className='legacy-api-details'>
        <div className='legacy-api-details__content'>
          <div className='legacy-api-details__entry'>
            <div className='legacy-api-details__label'>
              {trans('model_validation.legacy_api_key.attributes.app_name')}
            </div>
            <div className='legacy-api-details__value'>
              {key.app_name}
            </div>
          </div>
          <div className='legacy-api-details__entry'>
            <div className='legacy-api-details__label'>
              {trans('model_validation.legacy_api_key.attributes.app_url')}
            </div>
            <div className='legacy-api-details__value'>
              {key.app_url}
            </div>
          </div>
          <div className='legacy-api-details__entry'>
            <div className='legacy-api-details__label'>
              {trans('model_validation.legacy_api_key.attributes.api_key')}
            </div>
            <div className='legacy-api-details__value'>
              {this.keyVisible ? key.api_key : '***'}
            </div>
          </div>
          <div className='legacy-api-details__entry'>
            <div className='legacy-api-details__value'>
              <div>
                {trans('legacy_api_key.warning.line1')}<br />
                {trans('legacy_api_key.warning.line2')}<br />
                {trans('legacy_api_key.warning.line3')}
              </div>
            </div>
          </div>
          <div className='legacy-api-details__entry'>
            <div className='legacy-api-details__value'>
              <StringWithComponent
                mappings={{ github: (
                  <a href={docsUrl}>
                    {trans('legacy_api_key.docs.github')}
                  </a>
                ) }}
                pattern={trans('legacy_api_key.docs._')}
              />
            </div>
          </div>
        </div>
        <div className='legacy-api-details__actions'>
          <BigButton
            icon={this.keyVisible ? 'fas fa-eye-slash' : 'fas fa-eye'}
            modifiers={['account-edit', 'settings-oauth']}
            props={{
              onClick: this.onClickToggleKeyVisibility,
            }}
            text={trans(`legacy_api_key.view.${this.keyVisible ? 'hide' : 'show'}`)}
          />
          <BigButton
            disabled={this.props.controller.isDeleting}
            icon='fas fa-trash'
            isBusy={this.props.controller.isDeleting}
            modifiers={['account-edit', 'danger', 'settings-oauth']}
            props={{
              onClick: this.deleteClicked,
            }}
            text={trans('legacy_api_key.view.delete')}
          />
        </div>
      </div>
    );
  }

  private readonly deleteClicked = () => {
    if (!confirm(trans('common.confirmation'))) return;

    this.props.controller.deleteKey();
  };

  @action
  private readonly onClickToggleKeyVisibility = () => {
    this.keyVisible = !this.keyVisible;
  };
}
