// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PureComponent, ReactNode } from 'react';
import { createPortal } from 'react-dom';

interface Props {
  children: ReactNode;
}

export default class Portal extends PureComponent<Props> {
  private readonly container = document.createElement('div');

  componentDidMount() {
    this.addPortal();

    $(document).on('turbolinks:before-cache', this.removePortal);
  }

  componentWillUnmount() {
    this.removePortal();

    $(document).off('turbolinks:before-cache', this.removePortal);
  }

  render() {
    return createPortal(this.props.children, this.container);
  }

  private readonly addPortal = () => (window.newBody ?? document.body).appendChild(this.container);

  private readonly removePortal = () => {
    this.container.remove();
  };
}
