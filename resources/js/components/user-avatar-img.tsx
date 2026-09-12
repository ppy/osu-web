// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { presence } from 'utils/string';
import { Spinner } from './spinner';

interface Props {
  modifiers?: Modifiers;
  user: Pick<UserJson, 'avatar_url'>;
}

@observer
export default class UserAvatarImg extends React.PureComponent<Props> {
  @observable private avatarLoaded = false;

  private get url() {
    return presence(this.props.user.avatar_url); // assumes loading user has empty avatar_url.
  }

  constructor(props: Props) {
    super(props);

    // Check if image is already loaded from cache to avoid showing the spinner and transitions, especially in back/forward navigation.
    const url = this.url;
    if (url != null) {
      const image = new Image();
      image.loading = 'lazy';
      image.src = url;
      if (image.complete && image.naturalWidth > 0) {
        this.avatarLoaded = true;
      }
    }

    makeObservable(this);
  }

  render() {
    const extraModifiers = this.avatarLoaded ? 'loaded' : null;
    const url = this.url;

    return (
      <div className={classWithModifiers('user-avatar', this.props.modifiers)}>
        <div className={classWithModifiers('user-avatar__spinner', this.props.modifiers, extraModifiers)}>
          {url != null && <Spinner modifiers={extraModifiers} />}
        </div>
        {url != null && (
          <img
            className={classWithModifiers('user-avatar__image', this.props.modifiers, extraModifiers)}
            loading='lazy'
            onError={this.onAvatarLoad} // remove spinner if error
            onLoad={this.onAvatarLoad}
            src={url}
          />
        )}
      </div>
    );
  }

  @action
  private readonly onAvatarLoad = () => {
    this.avatarLoaded = true;
  };
}
