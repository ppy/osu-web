// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PopupMenu, Props } from 'popup-menu';
import * as React from 'react';
import { ContainerContext, KeyContext } from 'stateful-activation-context';

/**
 * Wrapper around PopupMenu that handles the persistent active state thing for it.
 * Also a functional component to be able to use useContext.
 */
export function PopupMenuPersistent(props: Props) {
  const container = React.useContext(ContainerContext);
  const key = React.useContext(KeyContext);

  const onHide = React.useCallback(() => container.activeKeyDidChange(null), [container]);
  const onShow = React.useCallback(() => container.activeKeyDidChange(key), [container, key]);
  React.useEffect(() => () => container.activeKeyDidChange(null), [container]);

  return <PopupMenu onHide={onHide} onShow={onShow} {...props} />;
}
