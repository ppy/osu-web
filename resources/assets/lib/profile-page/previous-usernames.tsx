// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Transition, TransitionStatus } from 'react-transition-group';
import { classWithModifiers } from 'utils/css';

interface Props {
  usernames: string[];
}

const popupTransitionStyles: Record<TransitionStatus, React.CSSProperties> = {
  entered: { opacity: 1 },
  entering: { opacity: 0 },
  exited: {},
  exiting: {},
  unmounted: {},
};

const hoverFade = 120;
const hoverEndDelay = 300;

@observer
export default class PreviousUsernames extends React.Component<Props> {
  @observable private active = false;
  private hoverEndTimeout: number | undefined;
  @observable private hovering = false;
  private mainRef = React.createRef<HTMLDivElement>();
  private popupRef = React.createRef<HTMLDivElement>();

  private get showingPopup() {
    return this.hovering || this.active;
  }

  private get uniqueUsernames() {
    return [...(new Set(this.props.usernames))];
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    $(document).on('click', this.onClickGlobal);
    $(window).on('resize', this.repositionPopup);
  }

  componentDidUpdate() {
    this.repositionPopup();
  }

  componentWillUnmount() {
    $(document).off('click', this.onClickGlobal);
  }

  render() {
    if (this.props.usernames.length === 0) return null;

    return (
      <div ref={this.mainRef} className='profile-previous-usernames'>
        <button
          className={classWithModifiers('profile-previous-usernames__button', { active: this.showingPopup })}
          onClick={this.onClick}
          onMouseEnter={this.onMouseEnter}
          onMouseLeave={this.onMouseLeave}
          type='button'
        >
          <span className='fas fa-user' />
        </button>
        {this.renderPopup()}
      </div>
    );
  }

  @action
  private readonly onClick = () => {
    this.active = !this.active;
  };

  @action
  private readonly onClickGlobal = (e: JQuery.ClickEvent) => {
    if (!this.active) return;

    if (this.mainRef.current?.contains(e.target)) return;

    this.active = false;
  };

  @action
  private readonly onMouseEnter = () => {
    window.clearTimeout(this.hoverEndTimeout);
    this.hovering = true;
  };

  private readonly onMouseLeave = () => {
    this.hoverEndTimeout = window.setTimeout(action(() => this.hovering = false), hoverEndDelay);
  };

  private renderPopup() {
    return (
      <Transition
        in={this.showingPopup}
        mountOnEnter
        timeout={{
          enter: 0,
          exit: hoverFade,
        }}
        unmountOnExit
      >
        {(state) => (
          <div
            ref={this.popupRef}
            className='profile-previous-usernames__popup'
            onMouseEnter={this.onMouseEnter}
            onMouseLeave={this.onMouseLeave}
            style={{
              opacity: 0,
              transitionDuration: `${hoverFade}ms`,
              ...popupTransitionStyles[state],
            }}
          >
            <div className='profile-previous-usernames__title'>{osu.trans('users.show.previous_usernames')}</div>
            {this.uniqueUsernames.map((username) => (
              <div key={username} className='profile-previous-usernames__name'>
                {username}
              </div>
            ))}
          </div>
        )}
      </Transition>
    );
  }

  private readonly repositionPopup = () => {
    if (!this.showingPopup) return;

    const popup = this.popupRef.current;

    if (popup == null || this.mainRef.current == null) return;

    const popupRect = popup.getBoundingClientRect();
    const mainRect = this.mainRef.current.getBoundingClientRect();
    const maxWidth = document.body.clientWidth;
    const maxTop = core.windowSize.isDesktop
      ? window._styles.header.height
      : window._styles.header.heightMobile;

    // check vertical position: see if it fits above the icon and below the global menu
    const bottom = mainRect.top - popupRect.height > maxTop
      ? mainRect.height
      // add 5px margin when showing below the icon
      : -popupRect.height - 5;

    // move it to the left if there's long name and may extend the right side (Math.min)
    // prevent it from going too much to the left (Math.max)
    const left = Math.max(-mainRect.left, Math.min(0, maxWidth - (mainRect.left + popupRect.width)));

    popup.style.bottom = `${bottom}px`;
    popup.style.left = `${left}px`;
  };
}
