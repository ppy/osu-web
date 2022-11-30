// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PureComponent, ReactNode } from 'react';
import { createPortal } from 'react-dom';
import { nextVal } from 'utils/seq';

interface Props {
  children: ReactNode;
}

export default class Portal extends PureComponent<Props> {
  private readonly container = document.createElement('div');
  private readonly eventId = `portal-${nextVal()}`;

  addPortal = () => document.body.appendChild(this.container);

  componentDidMount() {
    this.addPortal();

    $(document).on(`turbolinks:before-cache.${this.eventId}`, this.removePortal);
  }

  componentWillUnmount = () => {
    this.removePortal();

    $(document).off(`turbolinks:before-cache.${this.eventId}`);
  };

  removePortal = () => {
    if (this.container.parentElement === document.body) {
      document.body.removeChild(this.container);
    }
  };

  render = () => createPortal(this.props.children, this.container);
}
