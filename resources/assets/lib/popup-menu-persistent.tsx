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

import { Children, PopupMenu } from 'popup-menu';
import * as React from 'react';
import { ContainerContext, KeyContext } from 'stateful-activation-context';

interface Props {
  children: Children;
}

/**
 * Wrapper around PopupMenu that handles the persistent active state thing for it.
 * Also a functional component to be able to use useContext.
 */
export function PopupMenuPersistent({ children, ...params }: Props) {
  const container = React.useContext(ContainerContext);
  const key = React.useContext(KeyContext);

  const onHide = () => container.activeKeyDidChange(null);
  const onShow = () => container.activeKeyDidChange(key);

  return (
    <PopupMenu onHide={onHide} onShow={onShow} {...params}>
      {children}
    </PopupMenu>
  );
}
