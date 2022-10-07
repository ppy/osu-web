// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  onLoad: () => PromiseLike<unknown>;
}

@observer
export default class LazyLoad extends React.Component<React.PropsWithChildren<Props>> {
  // saved positions before lazy loaded element is rendered.
  private beforeRenderedBounds?: DOMRect;
  private beforeRenderedScrollY = 0;

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

    // Math.floor the scroll values because the value types aren't consistent between browsers...or themselves.
    const bounds = element.getBoundingClientRect();
    const scrollShift = Math.floor(window.scrollY - this.beforeRenderedScrollY);

    // FIXME: account for sticky headers reducing the visible portion
    // Adjust scroll position if scrolled past loaded element.
    if (this.beforeRenderedBounds.bottom < 0) {
      const offset = Math.max(0, Math.floor(bounds.height - this.beforeRenderedBounds.height));
      // May have already been adjusted by the browser.
      if (scrollShift !== offset) {
        window.scrollTo(window.scrollX, window.scrollY + offset);
      }
    }

    this.hasUpdated = true;
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
    this.beforeRenderedScrollY = window.scrollY;
    this.beforeRenderedBounds = this.ref.current?.getBoundingClientRect();

    return this.props.children;
  }

  @action
  private load() {
    this.observer.disconnect();
    // TODO: wait until scrolling stops to have a predictable position.
    this.props.onLoad().then(action(() => this.loaded = true));
  }
}
