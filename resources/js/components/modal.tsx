// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { blackoutToggle } from 'utils/blackout';
import Portal from './portal';

export const isModalOpen = () => modals.size !==  0;

interface Props {
  children: React.ReactNode;
  onClose?: () => void;
}

const modals = new Set<Modal>();

export default class Modal extends React.PureComponent<Props> {
  private clickEndTarget: undefined | EventTarget;
  private clickStartTarget: undefined | EventTarget;
  private readonly ref = React.createRef<HTMLDivElement>();

  componentDidMount() {
    document.addEventListener('keydown', this.handleEsc);
    $(document).on('turbolinks:before-cache', this.handleBeforeCache);

    this.open();
  }

  componentWillUnmount() {
    this.close();
    document.removeEventListener('keydown', this.handleEsc);
    $(document).off('turbolinks:before-cache', this.handleBeforeCache);
  }

  render() {
    return (
      <Portal>
        <div
          ref={this.ref}
          className='js-react-modal'
          onClick={this.hideModal}
          onMouseDown={this.handleMouseDown}
          onMouseUp={this.handleMouseUp}
        >
          {this.props.children}
        </div>
      </Portal>
    );
  }

  private readonly close = () => {
    modals.delete(this);
    if (modals.size === 0) {
      blackoutToggle(false);
    }
  };

  private readonly handleBeforeCache = () => {
    // componentWillUnmount runs too late depending on how the top level component was registered
    this.close();
  };

  private readonly handleEsc = (e: KeyboardEvent) => {
    if (this.props.onClose != null && e.key === 'Escape') {
      this.props.onClose();
    }
  };

  private readonly handleMouseDown = (e: React.MouseEvent) => {
    this.clickStartTarget = e.target;
  };

  private readonly handleMouseUp = (e: React.MouseEvent) => {
    this.clickEndTarget = e.target;
  };

  /**
   * onclick's event does not include where a click started.
   * onclick's target is the outermost element that is involved in a click;
   * starting a click on the outer element and ending on an inner element will have the outer element as the event target,
   * likewise, starting on an inner element end ending on the outer element will still use the outer element as the event target.
   */
  private readonly hideModal = (e: React.MouseEvent) => {
    if (this.props.onClose != null
      && e.button === 0
      && e.target === this.ref.current
      && this.clickEndTarget === this.clickStartTarget
    ) {
      this.props.onClose();
    }
  };

  private readonly open = () => {
    modals.add(this);
    blackoutToggle(true, 0.5);
  };
}
