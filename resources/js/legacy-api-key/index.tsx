// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import Modal from 'components/modal';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import Controller from './controller';
import Details from './details';
import Form from './form';

interface Props {
  container: HTMLElement;
}

@observer
export default class LegacyApiKey extends React.Component<Props> {
  private controller;
  private readonly formRef = React.createRef<Form>();

  constructor(props: Props) {
    super(props);

    this.controller = new Controller(this.props.container);

    makeObservable(this);
  }

  componentWillUnmount() {
    this.controller.destroy();
  }

  render() {
    return this.controller.key == null ? this.renderEmpty() : this.renderDetails();
  }

  private readonly onModalClose = () => {
    this.formRef.current?.onCancelClick();
  };

  @action
  private readonly onNewKeyClick = () => {
    this.controller.state.showing_form = true;
  };

  private renderDetails() {
    return <Details controller={this.controller} />;
  }

  private renderEmpty() {
    return (
      <>
        <p>
          {trans('legacy_api_key.none')}
        </p>
        <div>
          <BigButton
            icon='fas fa-plus'
            props={{
              onClick: this.onNewKeyClick,
            }}
            text={trans('legacy_api_key.new')}
          />
        </div>
        {this.renderForm()}
      </>
    );
  }

  private renderForm() {
    if (!this.controller.state.showing_form) {
      return null;
    }

    return (
      <Modal onClose={this.onModalClose}>
        <Form ref={this.formRef} controller={this.controller} />
      </Modal>
    );
  }
}
