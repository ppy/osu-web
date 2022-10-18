// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
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

  @computed
  private get ready() {
    return this.hasUpdated || this.hasData && !core.scrolling;
  }

  constructor(props: React.PropsWithChildren<Props>) {
    super(props);

    if (!this.hasData) {
      this.observer = new IntersectionObserver((entries) => {
        if (entries.some((entry) => entry.isIntersecting)) {
          this.load();
        }
      }, {
        rootMargin: '400px 0px 400px 0px',
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

    if (this.context == null) {
      throw new Error('LazyLoadContext is required.');
    }

    const element = this.context.ref.current;
    if (element == null || this.beforeRenderedBounds == null) {
      return;
    }

    this.hasUpdated = true;

    // below the visible bounds, ignore.
    if (this.beforeRenderedBounds.top > window.innerHeight) return;

    // for containers that need extra magic to handle scrolling and offsets;
    // multiple scrolls in the same callback / update turns out to be not so great.
    const options = this.context.getOptions(this.context.name);

    let maxScrollY = document.body.scrollHeight - window.innerHeight;

    if (options.unbottom) {
      maxScrollY -= 1;
    }

    let scrollTo = window.scrollY;
    const bounds = element.getBoundingClientRect();

    if (options.focus) {
      scrollTo = window.scrollY + bounds.top - this.context.offsetTop;
    } else if (this.beforeRenderedBounds.bottom < this.context.offsetTop // above the visible area
      || this.beforeRenderedBounds.bottom > this.context.offsetTop // bottom visible but top not
        && this.beforeRenderedBounds.top < this.context.offsetTop) {
      scrollTo = maxScrollY - this.distanceFromBottom;
    } else if (this.beforeRenderedBounds.top > this.context.offsetTop // new size goes off the top of visible area, happens at the bottom of page.
      && bounds.top < this.context.offsetTop) {
      scrollTo = window.scrollY + bounds.top - this.context.offsetTop;
    }

    window.scrollTo({ top: Math.floor(Math.min(maxScrollY, scrollTo)) });
  }

  componentWillUnmount() {
    this.observer?.disconnect();
  }

  render() {
    return (
      <div ref={this.ref} className={classWithModifiers('lazy-load', { loading: !this.ready })}>
        {this.ready ? this.renderLoaded() : <Spinner />}
      </div>
    );
  }

  renderLoaded() {
    if (this.context == null) {
      throw new Error('LazyLoadContext is required.');
    }
    // use the dimensions from before child nodes are rendered because Chrome performs a layout shift
    // after render and before componentDidUpdate(); Safari doesn't
    this.beforeRenderedBounds = this.context.ref.current?.getBoundingClientRect();
    this.distanceFromBottom = bottomPageDistance();

    return this.props.children;
  }

  @action
  private load() {
    this.observer?.disconnect();
    this.props.onLoad().then(action(() => this.hasData = true));
  }
}
