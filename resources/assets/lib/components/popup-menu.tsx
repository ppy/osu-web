// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { TooltipContext } from 'tooltip-context';
import { isModalShowing } from 'utils/modal-helper';
import { nextVal } from 'utils/seq';
import Portal from './portal';

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
  state: Readonly<State> = { active: false };

  private readonly buttonRef = React.createRef<HTMLButtonElement>();
  private readonly eventId = `popup-menu-${nextVal()}`;
  private readonly menuRef = React.createRef<HTMLDivElement>();
  private readonly menuRootRef = React.createRef<HTMLDivElement>();
  private tooltipHideEvent: unknown;

  private get $tooltipElement() {
    const el = this.tooltipElement;

    return el == null ? null : $(el);
  }

  private get tooltipElement() {
    return this.context?.closest('.qtip');
  }

  componentDidMount() {
    this.tooltipHideEvent = this.$tooltipElement?.qtip('option', 'hide.event');
    $(window).on(`resize.${this.eventId}`, this.resize);
  }

  componentDidUpdate(_prevProps: PropsWithDefaults, prevState: State) {
    if (prevState.active === this.state.active) return;

    if (this.state.active) {
      this.resize();
      const $tooltipElement = this.$tooltipElement;

      if ($tooltipElement != null) {
        this.tooltipHideEvent = $tooltipElement.qtip('option', 'hide.event');
        $tooltipElement.qtip('option', 'hide.event', false);
      }

      $(document).on(`click.${this.eventId} keydown.${this.eventId}`, this.hide);
      this.props.onShow?.();
    } else {
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
      return this.props.customRender(this.renderMenu(), this.buttonRef, this.toggle);
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

        {this.renderMenu()}
      </>
    );
  }

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
    for (const ref of ['menuRootRef', 'buttonRef'] as const) {
      const el = this[ref].current;
      if (el != null && path.includes(el)) {
        return true;
      }
    }

    return false;
  }

  private renderMenu() {
    // using fadeIn causes rendering glitches from the stacking context due to will-change
    if (!this.state.active) return null;

    return (
      <Portal>
        <div ref={this.menuRootRef}>
          <div ref={this.menuRef} className='popup-menu-float'>
            {this.props.children(this.dismiss)}
          </div>
        </div>
      </Portal>
    );
  }

  private readonly resize = () => {
    if (!this.state.active) return;

    const buttonEl = this.buttonRef.current;
    const menuEl = this.menuRef.current;
    const menuRootEl = this.menuRootRef.current;
    if (buttonEl == null || menuEl == null || menuRootEl == null) {
      throw new Error('missing button and/or menu element');
    }

    // disappear if the tree the menu is in is no longer displayed
    if (buttonEl.offsetParent == null) {
      menuRootEl.style.display = 'none';
      return;
    }

    const buttonRect = buttonEl.getBoundingClientRect();
    const menuRect = menuEl.getBoundingClientRect();
    const { scrollX, scrollY } = window;

    let left = scrollX + buttonRect.right;
    // shift the menu right if it clips out of the window;
    // menuRect.x doesn't update until after layout is finished so the known position of buttonRect is used instead.
    if (this.props.direction === 'right' || buttonRect.x - menuRect.width < 0) {
      left += menuRect.width - buttonRect.width;
    }

    menuRootEl.style.display = 'block';
    menuRootEl.style.position = 'absolute';
    menuRootEl.style.top = `${Math.floor(scrollY + buttonRect.bottom + 5)}px`;
    menuRootEl.style.left = `${Math.floor(left)}px`;

    // keeps the menu showing above the tooltip;
    // portal should be after the tooltip in the document body.
    const tooltipElement = this.tooltipElement;
    if (tooltipElement != null) {
      menuRootEl.style.zIndex = getComputedStyle(tooltipElement).zIndex;
    }
  };

  private readonly toggle = () => {
    this.setState({ active: !this.state.active });
  };
}
