// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BbcodeEditor from 'bbcode-editor';
import { OnChangeProps } from 'bbcode-editor';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';
import { onErrorWithClick } from 'utils/ajax';
import { showLoadingOverlay, hideLoadingOverlay } from 'utils/loading-overlay';
import { UserPageData } from './user-page';

interface Props {
  user: UserJson;
  userPage: UserPageData;
}

export default class UserPageEditor extends React.PureComponent<Props> {
  render() {
    return (
      <BbcodeEditor
        modifiers='profile-page'
        onChange={this.onChange}
        placeholder={osu.trans('users.show.page.placeholder')}
        rawValue={this.props.userPage.raw}
      />
    );
  }

  private readonly cancel = () => {
    $.publish('user:page:update', { editing: false });
  };

  private readonly onChange = ({ event, type, value }: OnChangeProps) => {
    switch (type) {
      case 'cancel':
        this.cancel();
        break;
      case 'save':
        this.save({event, value});
        break;
    }
  };

  private readonly save = ({ event, value }: { event: React.SyntheticEvent | undefined; value: string | undefined }) => {
    if (value === this.props.userPage.raw) {
      return this.cancel();
    }

    showLoadingOverlay();

    $.ajax(route('users.page', { user: this.props.user.id }), {
      data: {
        body: value,
      },
      dataType: 'json',
      method: 'PUT',
    }).done((data: { html: string }) => {
      $.publish('user:page:update', {
        editing: false,
        html: data.html,
        initialRaw: value,
        raw: value,
      });
    }).fail(onErrorWithClick(event?.target))
      .always(hideLoadingOverlay);
  };
}
