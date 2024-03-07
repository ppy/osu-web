// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PropsWithChildren, PureComponent } from 'react';
import { createPortal } from 'react-dom';

interface Props {
  root?: Element;
}

const containerClass = 'js-portal';

export function removeLeftoverPortalContainers() {
  for (const container of (window.newBody ?? document.body).querySelectorAll(`.${containerClass}`)) {
    container.remove();
  }
}

export default class Portal extends PureComponent<PropsWithChildren<Props>> {
  private readonly container: HTMLDivElement;

  constructor(props: Props) {
    super(props);

    this.container = document.createElement('div');
    this.container.className = containerClass;
  }

  componentDidMount() {
    (this.props.root ?? window.newBody ?? document.body).appendChild(this.container);
  }

  componentWillUnmount() {
    this.container.remove();
  }

  render() {
    return createPortal(this.props.children, this.container);
  }
}
