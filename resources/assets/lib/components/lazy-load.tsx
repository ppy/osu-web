// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import LazyLoadContext, { Snapshot } from './lazy-load-context';

interface Props {
  // For allowing lazy loading to be completely skipped if data is alrealy available.
  // Immediately resolving a Promise in onLoad still renders a spinner.
  hasData?: boolean;
  name: string;
  onLoad: () => JQuery.jqXHR<unknown>;
}

@observer
export default class LazyLoad extends React.Component<React.PropsWithChildren<Props>> {
  static readonly contextType = LazyLoadContext;
  declare context: React.ContextType<typeof LazyLoadContext>;

  @observable private error = false;
  private hasUpdated = false;
  @observable private loaded;
  private readonly observer?: IntersectionObserver;
  private readonly ref = React.createRef<HTMLDivElement>();
  @observable private skipLazyLoad = this.props.hasData ?? false;

  @computed
  private get ready() {
    return this.hasUpdated || this.skipLazyLoad || this.loaded && !(this.context?.scrolling ?? false);
  }

  constructor(props: React.PropsWithChildren<Props>) {
    super(props);

    this.loaded = this.skipLazyLoad;

    if (!this.skipLazyLoad) {
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
    if (this.skipLazyLoad || this.ref.current == null) return;

    this.observer?.observe(this.ref.current);
  }

  componentDidUpdate(_prevProps: unknown, _prevState: unknown, snapshot?: Snapshot) {
    if (this.hasUpdated || this.skipLazyLoad || !this.loaded || snapshot == null) return;

    if (this.context == null) {
      throw new Error('LazyLoadContext is missing.');
    }

    this.hasUpdated = true;
    this.context.done(this.props.name, snapshot);
  }

  componentWillUnmount() {
    this.observer?.disconnect();
  }

  // get the bounds and scroll position before update.
  getSnapshotBeforeUpdate() {
    return this.context?.getSnapshot(this.props.name);
  }

  render() {
    return (
      <div ref={this.ref} className={classWithModifiers('lazy-load', { loading: !this.ready })}>
        {this.ready ? this.renderLoaded() : this.renderNotLoaded()}
      </div>
    );
  }

  @action
  private readonly load = () => {
    this.error = false;
    this.observer?.disconnect();
    this.props.onLoad()
      .then(action(() => {
        this.loaded = true;
        this.error = false;
      }))
      .catch(action(() => this.error = true));
  };

  private renderLoaded() {
    if (!this.skipLazyLoad && this.context == null) {
      throw new Error('LazyLoadContext is missing.');
    }

    return this.props.children;
  }

  private renderNotLoaded() {
    return this.error ? (
      <div className='lazy-load__error'>
        <p>{trans('errors.load_failed')}</p>
        <div className='lazy-load__button'>
          <button className='btn-osu-big btn-osu-big--rounded-thin' onClick={this.load} type='button'>
            {trans('common.buttons.retry')}
          </button>
        </div>
      </div>
    ) : <Spinner />;
  }
}
