import Dispatcher from 'dispatcher';
import core from 'osu-core-singleton';
import { Component } from 'react';
import RootDataStore from 'stores/root-data-store';

interface CoreProps {
  dataStore: RootDataStore;
  dispatcher: Dispatcher;
}

// defaults for the injected props.
// but then do we need to even inject them?
const dispatcher = core.dispatcher;
const dataStore = core.dataStore;

export class CoreComponent<T> extends Component<JSX.LibraryManagedAttributes<T, T & CoreProps>> {
  static defaultProps: CoreProps = { dataStore, dispatcher };

  // This just so every constructor doesn't have to be declared with
  // JSX.LibraryManagedAttributes<T, T & CoreProps>
  constructor(props: T) {
    super(props as JSX.LibraryManagedAttributes<T, T & CoreProps>);
  }
}
