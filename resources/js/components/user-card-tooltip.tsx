// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Reportable from 'interfaces/reportable';
import UserJson from 'interfaces/user-json';
import * as _ from 'lodash';
import { autorun, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { userNotFoundJson } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import { unmountComponentAtNode } from 'react-dom';
import { renderToStaticMarkup } from 'react-dom/server';
import { ActiveKeyState, ContainerContext, KeyContext } from 'stateful-activation-context';
import { TooltipContext } from 'tooltip-context';
import { qtipPosition, PositionAt } from 'utils/qtip-helper';
import { presence } from 'utils/string';
import { apiLookupUsers } from 'utils/user';
import { UserCard } from './user-card';

interface Props {
  container: HTMLElement;
  lookup: string;
}

const userCardTooltipClass = 'qtip--user-card';
let inCard = false;
let tooltipWithActiveMenu: string | null = null;

function createTooltipOptions(card: HTMLElement) {
  const at = (card.dataset.tooltipPosition ?? 'right center') as PositionAt;

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
      ...qtipPosition(at),
      adjust: { scroll: false },
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
  card.classList.add('js-user-card-tooltip');
  card.classList.add('js-react');
  card.dataset.react = 'user-card-tooltip';
  card.dataset.lookup = userId;
  for (const [key, value] of Object.entries(element.dataset)) {
    card.dataset[key] = value;
  }

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
        const container = tooltipElement.find('.js-user-card-tooltip')[0];
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
    const container = tooltipElement.querySelector('.js-user-card-tooltip');
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
  $(document).on('mouseenter', '.js-user-card-tooltip', onMouseEnter);
  $(document).on('mouseleave', '.js-user-card-tooltip', onMouseLeave);
  $(document).on('turbo:before-cache', onBeforeCache);
  $.subscribe('user-card:remove.tooltip', onRemoveUserCard);
}

/**
 * This component's job is to get the data and bootstrap the actual UserCard component for tooltips.
 */
@observer
export class UserCardTooltip extends React.PureComponent<Props> {
  @observable private readonly activeKeyState = new ActiveKeyState<string>();
  private readonly disposer?: () => void;
  @observable private user?: UserJson;
  private xhr?;

  private get reportable() {
    const dataString = this.props.container.dataset.reportable;

    return dataString == null
      ? undefined
      : JSON.parse(dataString) as Reportable;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);

    const currentUser = core.currentUser;
    if (currentUser != null && this.props.lookup === currentUser.id.toString()) {
      this.user = currentUser;
    } else {
      this.xhr = apiLookupUsers([this.props.lookup])
        .done((response) => runInAction(() => {
          this.user = response.users[0] ?? userNotFoundJson;
        }))
        .always(() => {
          this.xhr = undefined;
        });
    }

    this.disposer = autorun(() => {
      tooltipWithActiveMenu = this.activeKeyState.value;
      if (this.activeKeyState.value == null && !inCard) {
        $(`.${userCardTooltipClass}`).qtip('hide');
      }
    });
  }

  componentWillUnmount() {
    this.xhr?.abort();
    this.disposer?.();
  }

  render() {
    const activated = this.activeKeyState.value === this.props.lookup;

    return (
      <TooltipContext.Provider value={this.props.container}>
        <ContainerContext.Provider value={this.activeKeyState}>
          <KeyContext.Provider value={this.props.lookup}>
            <UserCard
              activated={activated}
              reportable={this.reportable}
              user={this.user}
            />
          </KeyContext.Provider>
        </ContainerContext.Provider>
      </TooltipContext.Provider>
    );
  }
}
