// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';

interface Props {
  onLoad: () => PromiseLike<unknown>;
  placeholder?: React.ReactNode;
}

@observer
export default class LazyLoad extends React.Component<React.PropsWithChildren<Props>> {
  @observable loaded = false;

  private observer: IntersectionObserver;
  private ref = React.createRef<HTMLDivElement>();

  constructor(props: React.PropsWithChildren<Props>) {
    super(props);

    this.observer = new IntersectionObserver((entries) => {
      if (entries.some((entry) => entry.isIntersecting)) {
        this.load();
      }
    });

    makeObservable(this);
  }

  componentDidMount() {
    if (this.ref.current == null) return;

    this.observer.observe(this.ref.current);
  }

  componentWillUnmount() {
    this.observer.disconnect();
  }


  render() {
    if (!this.loaded) {
      return <div ref={this.ref} className='lazy-load'><Spinner /></div>;
    }

    return this.props.children;
  }

  @action
  private load() {
    this.observer.disconnect();
    this.props.onLoad().then(action(() => this.loaded = true));
  }
}
