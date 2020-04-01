// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Children, PopupMenu } from 'popup-menu';
import * as React from 'react';
import { ContainerContext, KeyContext } from 'stateful-activation-context';

interface Props {
  children: Children;
  customRender?: (children: JSX.Element[], ref: React.RefObject<HTMLElement>, toggle: (event: React.MouseEvent<HTMLElement>) => void) => JSX.Element;
}

/**
 * Wrapper around PopupMenu that handles the persistent active state thing for it.
 * Also a functional component to be able to use useContext.
 */
export function PopupMenuPersistent({customRender, children, ...params }: Props) {
  const container = React.useContext(ContainerContext);
  const key = React.useContext(KeyContext);

  const onHide = () => container.activeKeyDidChange(null);
  const onShow = () => container.activeKeyDidChange(key);

  return (
    <PopupMenu onHide={onHide} onShow={onShow} customRender={customRender} {...params}>
      {children}
    </PopupMenu>
  );
}
