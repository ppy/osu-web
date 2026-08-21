// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupJson from 'interfaces/user-group-json';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { ActiveKeyState, ContainerContext, KeyContext } from 'stateful-activation-context';
import { TooltipContext } from 'tooltip-context';
import { classWithModifiers, groupColour, Modifiers } from 'utils/css';
import { qtipPosition } from 'utils/qtip-helper';
import UserGroupBadge from './user-group-badge';

interface Props {
  groups: UserGroupJson[];
  modifiers?: Modifiers;
}

interface InnerProps extends Props {
  activationKey: React.Key | null;
  container: ActiveKeyState;
}

class UserGroupBadgesCombinedInner extends React.PureComponent<InnerProps> {
  static readonly contextType = TooltipContext;
  declare context: React.ContextType<typeof TooltipContext>;

  private tooltipHideEvent: unknown;
  private readonly valueRef = React.createRef<HTMLDivElement>();

  private get $tooltipElement() {
    const el = this.context?.closest('.qtip');

    return el == null ? null : $(el);
  }

  componentWillUnmount() {
    this.props.container.setValue(null);
    this.$tooltipElement?.qtip('option', 'hide.event', this.tooltipHideEvent);
    if (this.valueRef.current != null) {
      $(this.valueRef.current).qtip('destroy', true);
    }
  }

  render() {
    return (
      <div
        ref={this.valueRef}
        className={classWithModifiers('user-group-badge', 'combined', this.props.modifiers)}
        onMouseOver={this.onMouseOver}
      >
        {this.props.groups.map((group) => (
          <span
            key={group.identifier}
            className={classWithModifiers('user-group-badge__colour', {
              probationary: group.is_probationary,
            })}
            style={groupColour(group)}
          />
        ))}
      </div>
    );
  }

  private readonly onMouseOver = (event: React.MouseEvent<HTMLDivElement>) => {
    const el = event.currentTarget;
    if (el._tooltip != null) return;
    el._tooltip = '1';

    $(el).qtip({
      content: {
        text: renderToStaticMarkup(
          <div className='user-group-badge__popup'>
            {this.props.groups.map((group) => (
              <UserGroupBadge key={group.identifier} group={group} modifiers={this.props.modifiers} />
            ))}
          </div>,
        ),
      },
      events: {
        hide: this.onTooltipHide,
        show: this.onTooltipShow,
      },
      hide: {
        delay: 200,
        fixed: true,
      },
      overwrite: false,
      position: {
        ...qtipPosition('top center'),
        adjust: { scroll: false },
      },
      show: {
        delay: 200,
        event: event.type,
        ready: true,
      },
      style: {
        classes: 'qtip qtip--user-list',
        def: false,
        tip: false,
      },
    }, event);
  };

  private readonly onTooltipHide = () => {
    this.$tooltipElement?.qtip('option', 'hide.event', this.tooltipHideEvent);
    this.props.container.setValue(null);
  };

  // Otherwise the parent user-card tooltip closes.
  private readonly onTooltipShow = () => {
    this.props.container.setValue(this.props.activationKey);

    const $tooltipElement = this.$tooltipElement;
    if ($tooltipElement != null) {
      this.tooltipHideEvent = $tooltipElement.qtip('option', 'hide.event');
      $tooltipElement.qtip('option', 'hide.event', false);
    }
  };
}

/**
 * Reads ContainerContext and KeyContext so a parent user-card tooltip stays open.
 * Is a functional component to be able to use useContext.
 */
export default function UserGroupBadgesCombined(props: Props) {
  return (
    <UserGroupBadgesCombinedInner
      {...props}
      activationKey={React.useContext(KeyContext)}
      container={React.useContext(ContainerContext)}
    />
  );
}
