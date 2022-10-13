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
  // For allowing lazy loading to be completely skipped if data is alrealy available.
  // Immediately resolving a Promise in onLoad still renders a spinner.
  hasData?: boolean;
  onLoad: () => JQuery.jqXHR<unknown>;
}

@observer
export default class LazyLoad extends React.Component<React.PropsWithChildren<Props>> {
  static readonly contextType = LazyLoadContext;
  declare context: React.ContextType<typeof LazyLoadContext>;

  // saved positions before lazy loaded element is rendered.
  private beforeRenderedBounds?: DOMRect;
  private distanceFromBottom = 0;

  @observable private hasData = this.props.hasData ?? false;
  private hasUpdated = false;
  private readonly observer?: IntersectionObserver;
  private readonly ref = React.createRef<HTMLDivElement>();


  constructor(props: React.PropsWithChildren<Props>) {
    super(props);

    if (!this.hasData) {
      this.observer = new IntersectionObserver((entries) => {
        if (entries.some((entry) => entry.isIntersecting)) {
          this.load();
        }
      });
    }

    makeObservable(this);
  }

  componentDidMount() {
    if (this.ref.current == null) return;

    this.observer?.observe(this.ref.current);
  }

  componentDidUpdate() {
    if (this.hasUpdated || !this.hasData) return;

    const element = this.ref.current;
    if (element == null || this.beforeRenderedBounds == null) {
      return;
    }

    this.hasUpdated = true;

    // below the visible bounds, ignore.
    if (this.beforeRenderedBounds.top > window.innerHeight) return;

    const maxScrollY = document.body.scrollHeight - window.innerHeight;

    // TODO: try and sync this to the "page" cutoff? (profile page active page changes before it reaches the tab)
    // Try to maintain distance from bottom or keep at bottom at already there.
    // This is simpler than working out size changes since we only care about the page getting taller.
    if (this.distanceFromBottom === 0) {
      window.scrollTo(window.scrollX, maxScrollY);
    } else if (this.beforeRenderedBounds.bottom < this.context.offsetTop) {
      window.scrollTo(window.scrollX, maxScrollY - this.distanceFromBottom);
    }

    // for containers that need to do extra updates.
    if (this.context.name != null) {
      this.context.onWillUpdateScroll?.(this.context.name, element.getBoundingClientRect());
    }
  }

  componentWillUnmount() {
    this.observer?.disconnect();
  }

  render() {
    return (
      <div ref={this.ref} className={classWithModifiers('lazy-load', { loading: !this.hasData })}>
        {this.hasData ? this.renderLoaded() : <Spinner />}
      </div>
    );
  }

  renderLoaded() {
    // use the dimensions from before child nodes are rendered because Chrome performs a layout shift
    // after render and before componentDidUpdate(); Safari doesn't
    this.beforeRenderedBounds = this.ref.current?.getBoundingClientRect();
    this.distanceFromBottom = bottomPageDistance();

    return this.props.children;
  }

  @action
  private load() {
    this.observer?.disconnect();
    this.props.onLoad().then(action(() => this.hasData = true));
  }
}
