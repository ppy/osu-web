// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { isModalShowing } from 'modal-helper';
import * as React from 'react';
import { createPortal } from 'react-dom';
import { TooltipContext } from 'tooltip-context';
import { nextVal } from 'utils/seq';

type Children = (dismiss: () => void) => React.ReactNode;

export interface Props {
  children: Children;
  customRender?: (children: React.ReactNode, ref: React.RefObject<HTMLElement>, toggle: (event: React.MouseEvent<HTMLElement>) => void) => React.ReactNode;
  direction?: 'left' | 'right';
  onHide?: () => void;
  onShow?: () => void;
}

type DefaultProps = Required<Pick<Props, 'children' | 'direction'>>;
type PropsWithDefaults = Props & DefaultProps;

interface State {
  active: boolean;
}

export default class PopupMenu extends React.PureComponent<PropsWithDefaults, State> {
  static readonly contextType = TooltipContext;
  static readonly defaultProps: DefaultProps = {
    children: () => null,
    direction: 'left',
  };

  declare context: React.ContextType<typeof TooltipContext>;
  readonly state = { active: false };

  private readonly buttonRef = React.createRef<HTMLButtonElement>();
  private readonly eventId = `popup-menu-${nextVal()}`;
  private readonly menuRef = React.createRef<HTMLDivElement>();
  private readonly portal = document.createElement('div');
  private tooltipHideEvent: unknown;

  private get $tooltipElement() {
    if (this.context != null) {
      return $(this.context).closest('.qtip');
    }
  }

  componentDidMount() {
    this.tooltipHideEvent = this.$tooltipElement?.qtip('option', 'hide.event');
    $(window).on(`resize.${this.eventId}`, this.resize);
    $(document).on(`turbolinks:before-cache.${this.eventId}`, this.removePortal);
  }

  componentDidUpdate(_prevProps: PropsWithDefaults, prevState: State) {
    if (prevState.active === this.state.active) return;

    if (this.state.active) {
      this.addPortal();
      this.resize();
      const $tooltipElement = this.$tooltipElement;

      if ($tooltipElement != null) {
        this.tooltipHideEvent = $tooltipElement.qtip('option', 'hide.event');
        $tooltipElement.qtip('option', 'hide.event', false);
      }

      $(document).on(`click.${this.eventId} keydown.${this.eventId}`, this.hide);
      this.props.onShow?.();
    } else {
      this.removePortal();
      this.$tooltipElement?.qtip('option', 'hide.event', this.tooltipHideEvent);

      $(document).off(`click.${this.eventId} keydown.${this.eventId}`, this.hide);
      this.props.onHide?.();
    }
  }

  componentWillUnmount() {
    $(document).off(`.${this.eventId}`);
    $(window).off(`.${this.eventId}`);
  }

  render() {
    if (this.props.customRender) {
      return this.props.customRender(createPortal(this.renderMenu(), this.portal), this.buttonRef, this.toggle);
    }

    return (
      <>
        <button
          ref={this.buttonRef}
          className='popup-menu'
          onClick={this.toggle}
          type='button'
        >
          <span className='fas fa-ellipsis-v' />
        </button>

        {createPortal(this.renderMenu(), this.portal)}
      </>
    );
  }

  private readonly addPortal = () => {
    if (this.portal.parentElement == null) {
      document.body.appendChild(this.portal);
    }
  };

  private readonly dismiss = () => {
    this.setState({ active: false });
  };

  private readonly hide = (e: JQuery.ClickEvent | JQuery.KeyDownEvent) => {
    if (!this.state.active || isModalShowing()) return;

    const event = e.originalEvent;

    // originalEvent gets eaten by error popup?
    if (event == null) return;

    if (('key' in event && event.key === 'Escape') || ('button' in event && event.button === 0 && !this.isMenuInPath(event.composedPath()))) {
      this.setState({ active: false });
    }
  };

  private isMenuInPath(path: EventTarget[]) {
    return path.includes(this.portal) || (this.buttonRef.current != null && path.includes(this.buttonRef.current));
  }

  private readonly removePortal = () => {
    this.portal.remove();
  };

  private renderMenu() {
    // using fadeIn causes rendering glitches from the stacking context due to will-change
    if (!this.state.active) return null;

    return (
      <div ref={this.menuRef} className='popup-menu-float'>
        {this.props.children(this.dismiss)}
      </div>
    );
  }

  private readonly resize = () => {
    if (!this.state.active) return;

    if (this.buttonRef.current == null || this.menuRef.current == null) {
      throw new Error('missing button and/or menu element');
    }

    // disappear if the tree the menu is in is no longer displayed
    if (this.buttonRef.current.offsetParent == null) {
      this.portal.style.display = 'none';
      return;
    }

    const buttonRect = this.buttonRef.current.getBoundingClientRect();
    const menuRect = this.menuRef.current.getBoundingClientRect();
    const { scrollX, scrollY } = window;

    let left = scrollX + buttonRect.right;
    // shift the menu right if it clips out of the window;
    // menuRect.x doesn't update until after layout is finished so the known position of buttonRect is used instead.
    if (this.props.direction === 'right' || buttonRect.x - menuRect.width < 0) {
      left += menuRect.width - buttonRect.width;
    }

    this.portal.style.display = 'block';
    this.portal.style.position = 'absolute';
    this.portal.style.top = `${Math.floor(scrollY + buttonRect.bottom + 5)}px`;
    this.portal.style.left = `${Math.floor(left)}px`;

    // keeps the menu showing above the tooltip;
    // portal should be after the tooltip in the document body.
    const tooltipElement = this.$tooltipElement?.[0];
    if (tooltipElement != null) {
      this.portal.style.zIndex = getComputedStyle(tooltipElement).zIndex;
    }
  };

  private readonly toggle = () => {
    this.setState({ active: !this.state.active });
  };
}
