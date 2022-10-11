// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { bottomPageDistance } from 'utils/html';
import LazyLoadContext from './lazy-load-context';

interface Props {
  onLoad: () => PromiseLike<unknown>;
}

@observer
export default class LazyLoad extends React.Component<React.PropsWithChildren<Props>> {
  static readonly contextType = LazyLoadContext;
  declare context: React.ContextType<typeof LazyLoadContext>;

  // saved positions before lazy loaded element is rendered.
  private beforeRenderedBounds?: DOMRect;
  private distanceFromBottom = 0;

  private hasUpdated = false;
  @observable private loaded = false;
  private readonly observer: IntersectionObserver;
  private readonly ref = React.createRef<HTMLDivElement>();


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

  componentDidUpdate() {
    if (this.hasUpdated || !this.loaded) return;

    const element = this.ref.current;
    if (element == null || this.beforeRenderedBounds == null) {
      return;
    }

    this.hasUpdated = true;

    // skip scroll update if context callback has handled it.
    if (this.context.name != null && this.context.onWillUpdateScroll?.(this.context.name)) {
      return;
    }

    // below the visible bounds, ignore.
    if (this.beforeRenderedBounds.top > window.innerHeight) return;

    const maxScrollY = document.body.scrollHeight - window.innerHeight;

    // if at bottom, try keep it at the bottom
    if (this.distanceFromBottom === 0) {
      window.scrollTo(window.scrollX, maxScrollY);
      return;
    // maintain distance from bottom
    // TODO: try and sync this to the "page" cutoff?
    } else if (this.beforeRenderedBounds.bottom < this.context.offsetTop) {
      window.scrollTo(window.scrollX, maxScrollY - this.distanceFromBottom);
    }
  }

  componentWillUnmount() {
    this.observer.disconnect();
  }

  render() {
    return (
      <div ref={this.ref} className={classWithModifiers('lazy-load', { loading: !this.loaded })}>
        {this.loaded ? this.renderLoaded() : <Spinner />}
      </div>
    );
  }

  renderLoaded() {
    this.beforeRenderedBounds = this.ref.current?.getBoundingClientRect();
    this.distanceFromBottom = bottomPageDistance();

    return this.props.children;
  }

  @action
  private load() {
    this.observer.disconnect();
    // TODO: wait until scrolling stops to have a predictable position.
    this.props.onLoad().then(action(() => this.loaded = true));
  }
}
