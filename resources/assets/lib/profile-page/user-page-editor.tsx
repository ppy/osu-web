// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BbcodeEditor from 'components/bbcode-editor';
import { OnChangeProps } from 'components/bbcode-editor';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { showLoadingOverlay, hideLoadingOverlay } from 'utils/loading-overlay';
import Controller from './controller';

interface Props {
  controller: Controller;
}

@observer
export default class UserPageEditor extends React.Component<Props> {
  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <BbcodeEditor
        modifiers='profile-page'
        onChange={this.onChange}
        placeholder={osu.trans('users.show.page.placeholder')}
        rawValue={this.props.controller.state.user.page.raw}
      />
    );
  }

  @action
  private readonly cancel = () => {
    this.props.controller.state.editingUserPage = false;
  };

  private readonly onChange = ({ type, value }: OnChangeProps) => {
    switch (type) {
      case 'cancel':
        this.cancel();
        break;
      case 'save':
        this.save({ value });
        break;
    }
  };

  private readonly save = ({ value }: { value: string | undefined }) => {
    if (value === this.props.controller.state.user.page.raw) {
      return this.cancel();
    }

    showLoadingOverlay();

    this.props.controller.apiSetUserPage(value ?? '')
      .done(action(() => {
        this.props.controller.state.editingUserPage = false;
      })).fail(onErrorWithCallback(() => this.save({ value })))
      .always(hideLoadingOverlay);
  };
}
