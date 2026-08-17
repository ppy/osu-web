// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupJson from 'interfaces/user-group-json';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { ContainerContext, KeyContext } from 'stateful-activation-context';
import { TooltipContext } from 'tooltip-context';
import { classWithModifiers, groupColour, Modifiers } from 'utils/css';
import { qtipPosition } from 'utils/qtip-helper';
import UserGroupBadge from './user-group-badge';

interface Props {
  groups: UserGroupJson[];
  modifiers?: Modifiers;
}

export default function UserGroupBadgesCombined({ groups, modifiers }: Props) {
  const container = React.useContext(ContainerContext);
  const key = React.useContext(KeyContext);
  const tooltipContext = React.useContext(TooltipContext);
  const valueRef = React.useRef<HTMLDivElement>(null);
  const tooltipHideEventRef = React.useRef<unknown>(null);

  const parentQtip = () => {
    const el = tooltipContext?.closest('.qtip');
    return el == null ? null : $(el);
  };

  React.useEffect(() => () => {
    container.setValue(null);
    parentQtip()?.qtip('option', 'hide.event', tooltipHideEventRef.current);
    if (valueRef.current != null) {
      $(valueRef.current).qtip('destroy', true);
    }
  }, [container, tooltipContext]);

  const onMouseOver = (event: React.MouseEvent<HTMLDivElement>) => {
    const el = event.currentTarget;
    if (el._tooltip != null) return;
    el._tooltip = '1';

    $(el).qtip({
      content: {
        text: renderToStaticMarkup(
          <div className='user-group-badge__popup'>
            {groups.map((group) => (
              <UserGroupBadge key={group.identifier} group={group} modifiers={modifiers} />
            ))}
          </div>,
        ),
      },
      events: {
        hide() {
          parentQtip()?.qtip('option', 'hide.event', tooltipHideEventRef.current);
          container.setValue(null);
        },
        show() {
          container.setValue(key);
          const $parent = parentQtip();
          if ($parent != null) {
            tooltipHideEventRef.current = $parent.qtip('option', 'hide.event');
            $parent.qtip('option', 'hide.event', false);
          }
        },
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

  return (
    <div
      ref={valueRef}
      className={classWithModifiers('user-group-badge', 'combined', modifiers)}
      onMouseOver={onMouseOver}
    >
      {groups.map((group) => (
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
