/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import DispatcherAction from 'actions/dispatcher-action';
import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';
import RootDataStore from 'stores/root-data-store';

export default abstract class Store implements DispatchListener {
  constructor(protected root: RootDataStore, protected dispatcher: Dispatcher) {
    dispatcher.register(this);
  }

  handleDispatchAction(action: DispatcherAction) { /* do nothing */ }
}
