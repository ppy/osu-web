// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import core from 'osu-core-singleton';
import * as React from 'react';
import { unmountComponentAtNode } from 'react-dom';
import { renderToStaticMarkup } from 'react-dom/server';
import { activeKeyDidChange as contextActiveKeyDidChange, ContainerContext, KeyContext, State as ActiveKeyState } from 'stateful-activation-context';
import { TooltipContext } from 'tooltip-context';
import { presence } from 'utils/string';
import { UserCard } from './user-card';

interface Props {
  container: HTMLElement;
  lookup: string;
}

interface State extends ActiveKeyState {
  user?: UserJson;
}

const userCardTooltipClass = 'qtip--user-card';
let inCard = false;
let tooltipWithActiveMenu: any;

function createTooltipOptions(card: HTMLElement) {
  const at = card.dataset.tooltipPosition ?? 'right center';

  return {
    content: {
      text: card,
    },
    events: {
      render: core.reactTurbolinks.boot,
      show: shouldShow,
    },
    hide: {
      delay: 220,
      effect: hideEffect,
      fixed: true,
    },
    position: {
      adjust: { scroll: false },
      at,
      my: my(at),
      viewport: $(window),
    },
    show: {
      delay: 200,
      effect: showEffect,
      ready: true,
    },
    style: {
      classes: userCardTooltipClass,
      def: false,
      tip: false,
    },
  };
}

let blankCardCache: HTMLElement | undefined;
function blankCard() {
  if (blankCardCache == null) {
    const container = document.createElement('div');
    container.innerHTML = renderToStaticMarkup(<UserCard />);
    const card = container.children[0];
    if (!(card instanceof HTMLElement)) {
      throw new Error('expected render of UserCard to be HTMLElement but got something else');
    }
    blankCardCache = card;
  }

  return blankCardCache;
}

function createTooltip(element: HTMLElement) {
  const userId = element.dataset.userId;
  element._tooltip = userId;

  // React should override the existing content after mounting.
  // Casting because cloneNode returns Node by default.
  const card = blankCard().cloneNode(true) as HTMLElement;
  card.classList.remove('js-react--user-card');
  card.classList.add('js-react--user-card-tooltip');
  card.dataset.lookup = userId;
  if (element.dataset.tooltipPosition != null) {
    card.dataset.tooltipPosition = element.dataset.tooltipPosition;
  }

  $(element).qtip(createTooltipOptions(card));
}

function my(at: string) {
  switch (at) {
    case 'top center':
      return 'bottom center';
    case 'top right':
      return 'bottom left';
    case 'left center':
      return 'right center';
    case 'bottom center':
      return 'top center';
  }

  return 'left center';
}

function onBeforeCache() {
  inCard = false;
  tooltipWithActiveMenu = null;
}

function onMouseEnter() {
  inCard = true;
}

function onMouseLeave() {
  inCard = false;
}

function onMouseOver(event: JQuery.TriggeredEvent<Document, unknown, HTMLElement, HTMLElement>) {
  if (tooltipWithActiveMenu != null) return;
  if (core.windowSize.isMobile) return;

  const el = event.currentTarget;
  const userId = presence(el.dataset.userId);
  if (userId == null) return;
  // don't show cards for blocked users
  if (_.find(core.currentUser?.blocks ?? [], { target_id: parseInt(userId, 10) })) return;

  if (el._tooltip == null) {
    return createTooltip(el);
  }

  if (el._tooltip !== el.dataset.userId) {
    // wrong userId, destroy current tooltip
    const qtip = $(el).qtip('api');
    if (qtip != null) {
      const tooltipElement = qtip.tooltip;
      if (tooltipElement != null) {
        const container = tooltipElement.querySelector('.js-react--user-card-tooltip');
        if (container != null) {
          unmountComponentAtNode(container);
        }
      }

      qtip.destroy();
      delete el._tooltip;
    }
  }
}

function showEffect(this: JQuery<HTMLElement>) {
  $(this).fadeTo(110, 1);
}

function hideEffect(this: JQuery<HTMLElement>) {
  $(this).fadeTo(110, 0);
}

function onRemoveUserCard(_event: unknown, element: HTMLElement | null) {
  if (element == null) return;

  const qtipId = element.dataset.hasqtip;
  if (qtipId == null) return;

  const tooltipElement = document.getElementById(`qtip-${qtipId}`);
  if (tooltipElement == null) return;

  const qtip = $(tooltipElement).qtip('api');
  if (qtip != null) {
    const container = tooltipElement.querySelector('.js-react--user-card-tooltip');
    if (container != null) {
      unmountComponentAtNode(container);
    }

    // queue after React unmount.
    setTimeout(() => {
      // tooltip element doesn't get removed sometimes without immediate = true.
      qtip.destroy(true);
      delete element._tooltip;
    }, 0);
  }
}

function shouldShow(event: JQuery.Event, api: any) {
  if (tooltipWithActiveMenu != null || core.windowSize.isMobile) {
    return event.preventDefault();
  }

  // keyed React components can end up with reused DOM elements with a previously set tooltip.
  const target = api.target[0] as HTMLElement;
  if (target._tooltip !== target.dataset.userId) {
    event.preventDefault();
    $(target).trigger('mouseover');
  }
}

export function startListening() {
  $(document).on('mouseover', '.js-usercard', onMouseOver);
  $(document).on('mouseenter', '.js-react--user-card-tooltip', onMouseEnter);
  $(document).on('mouseleave', '.js-react--user-card-tooltip', onMouseLeave);
  $(document).on('turbolinks:before-cache', onBeforeCache);
  $.subscribe('user-card:remove.tooltip', onRemoveUserCard);
}

/**
 * This component's job is to get the data and bootstrap the actual UserCard component for tooltips.
 */
export class UserCardTooltip extends React.PureComponent<Props, State> {
  state: Readonly<State> = {};
  private readonly contextActiveKeyDidChange = contextActiveKeyDidChange.bind(this);

  componentDidMount() {
    this.getUser().then((user) => {
      this.setState({ user });
    });
  }

  getUser() {
    const url = route('users.card', { user: this.props.lookup });

    return $.ajax({
      dataType: 'json',
      type: 'GET',
      url,
    }) as JQuery.jqXHR<UserJson>;
  }

  render() {
    const activated = this.state.activeKey === this.props.lookup;

    return (
      <TooltipContext.Provider value={this.props.container}>
        <ContainerContext.Provider value={{ activeKeyDidChange: this.activeKeyDidChange }}>
          <KeyContext.Provider value={this.props.lookup}>
            <UserCard activated={activated} user={this.state.user} />
          </KeyContext.Provider>
        </ContainerContext.Provider>
      </TooltipContext.Provider>
    );
  }

  private readonly activeKeyDidChange = (key: any) => {
    tooltipWithActiveMenu = key;
    this.contextActiveKeyDidChange(key);
    // close the tooltip if cursor is known to be not within the card
    // when the menu closes.
    if (key == null && !inCard) {
      $(`.${userCardTooltipClass}`).qtip('hide');
    }
  };
}
