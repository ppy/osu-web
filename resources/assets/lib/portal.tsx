// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PureComponent, ReactNode } from 'react';
import { createPortal } from 'react-dom';

interface Props {
  children: ReactNode;
}

export class Portal extends PureComponent<Props> {
  private readonly container: HTMLElement;
  private readonly uuid: string;

  constructor(props: Props) {
    super(props);

    this.uuid = osu.uuid();
    this.container = document.createElement('div');
  }

  addPortal = () => document.body.appendChild(this.container);

  componentDidMount() {
    this.addPortal();

    $(document).on(`turbolinks:before-cache.${this.uuid}`, this.removePortal);
  }

  componentWillUnmount = () => {
    this.removePortal();

    $(document).off(`turbolinks:before-cache.${this.uuid}`);
  };

  removePortal = () => {
    if (this.container.parentElement === document.body) {
      document.body.removeChild(this.container);
    }
  };

  render = () => createPortal(this.props.children, this.container);
}
