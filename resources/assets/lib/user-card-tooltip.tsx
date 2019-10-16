/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { route } from 'laroute';
import * as _ from 'lodash';
import * as React from 'react';
import { unmountComponentAtNode } from 'react-dom';
import { activeKeyDidChange as contextActiveKeyDidChange, ContainerContext, KeyContext, State as ActiveKeyState } from 'stateful-activation-context';
import { TooltipContext } from 'tooltip-context';
import { UserCard } from 'user-card';

declare global {
  interface HTMLElement {
    _tooltip?: string;
  }

  interface JQuery {
    qtip(...args: any): any;
  }
}

interface Props {
  container: HTMLElement;
  lookup: string;
}

interface State extends ActiveKeyState {
  user?: User;
}

const userCardTooltipClass = 'qtip--user-card';
let inCard = false;
let tooltipWithActiveMenu: any;

function createTooltipOptions(card: HTMLElement) {
  return {
    content: {
      text: card,
    },
    events: {
      render: reactTurbolinks.boot,
      show: shouldShow,
    },
    hide: {
      delay: 220,
      effect: hideEffect,
      fixed: true,
    },
    position: {
      adjust: { scroll: false },
      at: 'right center',
      my: 'left center',
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

function createTooltip(element: HTMLElement) {
  const userId = element.dataset.userId;
  element._tooltip = userId;

  // react should override the existing content after mounting
  const card = $('#js-usercard__loading-template').children().clone()[0];
  card.classList.remove('js-react--user-card');
  card.classList.add('js-react--user-card-tooltip');
  delete card.dataset.reactTurbolinksLoaded;
  card.dataset.lookup = userId;

  $(element).qtip(createTooltipOptions(card));
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

function onMouseOver(event: JQueryEventObject) {
  if (tooltipWithActiveMenu != null) { return; }
  if (osu.isMobile()) { return; }

  const el = event.currentTarget as HTMLElement;
  const userId = osu.presence(el.dataset.userId);
  if (userId == null) { return; }
  // don't show cards for blocked users
  if (_.find(currentUser.blocks, { target_id: parseInt(userId, 10)})) { return; }

  if (el._tooltip == null) {
    return createTooltip(el);
  }

  if (el._tooltip !== el.dataset.userId) {
    // wrong userId, destroy current tooltip
    const qtip = $(el).qtip('api');
    if (qtip != null) {
      if (qtip.tooltip != null) {
        unmountComponentAtNode(qtip.tooltip.find('.js-react--user-card-tooltip')[0]);
      }

      qtip.destroy();
      delete el._tooltip;
    }
  }
}

function showEffect() {
  $(this).fadeTo(110, 1);
}

function hideEffect() {
  $(this).fadeTo(110, 0);
}

function shouldShow(event: JQueryEventObject, api: any) {
  if (tooltipWithActiveMenu != null || osu.isMobile()) {
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
}

/**
 * This component's job is to get the data and bootstrap the actual UserCard component for tooltips.
 */
export class UserCardTooltip extends React.PureComponent<Props, State> {
  readonly contextActiveKeyDidChange = contextActiveKeyDidChange.bind(this);
  readonly state: State = {};
  readonly activeKeyDidChange = (key: any) => {
    tooltipWithActiveMenu = key;
    this.contextActiveKeyDidChange(key);
    // close the tooltip if cursor is known to be not within the card
    // when the menu closes.
    if (key == null && !inCard) {
      $(`.${userCardTooltipClass}`).qtip('hide');
    }
  }

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
    });
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
}
