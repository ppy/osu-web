// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { makeObservable, action, reaction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { TooltipContext } from 'tooltip-context';
import { classWithModifiers } from 'utils/css';
import { isModalShowing } from 'utils/modal-helper';
import { nextVal } from 'utils/seq';
import PopupMenuState from './popup-menu-state';
import Portal from './portal';

export interface Props {
  children: (state: PopupMenuState) => React.ReactNode;
  direction?: 'left' | 'right';
  onHide?: () => void;
  onShow?: () => void;
  skipButton?: boolean;
  state?: PopupMenuState;
}

type DefaultProps = Required<Pick<Props, 'direction' | 'skipButton'>>;
type PropsWithDefaults = Props & DefaultProps;

@observer
export default class PopupMenu extends React.PureComponent<PropsWithDefaults> {
  static readonly contextType = TooltipContext;
  static readonly defaultProps: DefaultProps = {
    direction: 'left',
    skipButton: false,
  };

  declare context: React.ContextType<typeof TooltipContext>;

  private activeStateUpdated = false;
  private readonly disposeActiveStateMonitor;
  private readonly eventId = `popup-menu-${nextVal()}`;
  private readonly internalMobxState;
  private readonly menuRef = React.createRef<HTMLDivElement>();
  private readonly menuRootRef = React.createRef<HTMLDivElement>();
  private tooltipHideEvent: unknown;

  private get $tooltipElement() {
    const el = this.tooltipElement;

    return el == null ? null : $(el);
  }

  private get mobxState() {
    return this.props.state ?? this.internalMobxState;
  }

  private get tooltipElement() {
    return this.context?.closest('.qtip');
  }

  constructor(props: PropsWithDefaults) {
    super(props);
    makeObservable(this);
    // the property won't actually be used if the props contains a state
    this.internalMobxState = this.props.state ?? new PopupMenuState();

    this.disposeActiveStateMonitor = reaction(() => this.mobxState.active, () => {
      // delay handling of the state update until react finishes updating
      this.activeStateUpdated = true;
    });
  }

  componentDidMount() {
    this.tooltipHideEvent = this.$tooltipElement?.qtip('option', 'hide.event');
    $(window).on(`resize.${this.eventId}`, this.resize);
  }

  componentDidUpdate() {
    if (this.activeStateUpdated) {
      this.activeStateUpdated = false;
      if (this.mobxState.active) {
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
  }

  componentWillUnmount() {
    $(document).off(`.${this.eventId}`);
    $(window).off(`.${this.eventId}`);
    this.disposeActiveStateMonitor();
  }

  render() {
    return this.props.skipButton
      ? this.renderMenu()
      : (
        <>
          <button
            ref={this.mobxState.setButtonRef}
            className='popup-menu'
            onClick={this.mobxState.toggle}
            type='button'
          >
            <span className='fas fa-ellipsis-v' />
          </button>

          {this.renderMenu()}
        </>
      );
  }

  @action
  private readonly hide = (e: JQuery.ClickEvent | JQuery.KeyDownEvent) => {
    if (!this.mobxState.active || isModalShowing()) return;

    const event = e.originalEvent;

    // originalEvent gets eaten by error popup?
    if (event == null) return;

    if (('key' in event && event.key === 'Escape') || ('button' in event && event.button === 0 && !this.isMenuInPath(event.composedPath()))) {
      this.mobxState.dismiss();
    }
  };

  private isMenuInPath(path: EventTarget[]) {
    for (const el of [this.menuRootRef.current, this.mobxState.buttonRefCurrent] as const) {
      if (el != null && path.includes(el)) {
        return true;
      }
    }

    return false;
  }

  private renderMenu() {
    // using fadeIn causes rendering glitches from the stacking context due to will-change
    if (!this.mobxState.active) return null;

    return (
      <Portal>
        <div ref={this.menuRootRef}>
          <div ref={this.menuRef} className={classWithModifiers('popup-menu-float', this.props.direction)}>
            {this.props.children(this.mobxState)}
          </div>
        </div>
      </Portal>
    );
  }

  private readonly resize = () => {
    if (!this.mobxState.active) return;

    const buttonEl = this.mobxState.buttonRefCurrent;
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
    const viewportWidth = document.body.scrollWidth;
    const { scrollX, scrollY } = window;

    const left = this.props.direction === 'left'
      ? Math.min(
        viewportWidth,
        buttonRect.right + Math.max(0, menuRect.width - buttonRect.right),
      ) : Math.max(
        0,
        buttonRect.x - Math.max(0, buttonRect.x + menuRect.width - viewportWidth),
      );

    menuRootEl.style.display = 'block';
    menuRootEl.style.position = 'absolute';
    menuRootEl.style.top = `${Math.floor(scrollY + buttonRect.bottom + 5)}px`;
    menuRootEl.style.left = `${Math.floor(scrollX + left)}px`;

    // keeps the menu showing above the tooltip;
    // portal should be after the tooltip in the document body.
    const tooltipElement = this.tooltipElement;
    if (tooltipElement != null) {
      menuRootEl.style.zIndex = getComputedStyle(tooltipElement).zIndex;
    }
  };
}
