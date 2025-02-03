// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';

interface Props {
  anchor?: React.RefObject<HTMLElement>;
}

@observer
export default class BackToTop extends React.Component<Props> {
  @observable private lastScrollY: number | null = null;
  private observer: IntersectionObserver | null = null;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    document.removeEventListener('scroll', this.onScroll);
    this.removeObserver();
  }

  render() {
    return (
      <button
        className='floating-toolbar-button'
        data-tooltip-float='fixed'
        onClick={this.onClick}
        title={trans(this.lastScrollY == null ? 'common.buttons.back_to_top' : 'common.buttons.back_to_previous')}
      >
        <span className={this.lastScrollY == null ? 'fas fa-angle-up' : 'fas fa-angle-down'} />
      </button>
    );
  }

  @action
  readonly reset = () => {
    this.lastScrollY = null;
  };

  // Workaround Firefox scrollTo and setTimeout(fn, 0) not being dispatched serially.
  private mountObserver() {
    // anchor to body if none specified; assumes body's top is 0.
    const target = this.props.anchor?.current ?? document.body;

    this.observer = new IntersectionObserver((entries) => {
      for (const entry of entries) {
        if (entry.target === target && entry.boundingClientRect.top === 0) {
          document.addEventListener('scroll', this.onScroll);
          break;
        }
      }
    });

    this.observer.observe(target);
  }

  @action
  private readonly onClick = () => {
    if (this.lastScrollY == null) {
      const scrollY = this.props.anchor?.current == null ? 0 : ($(this.props.anchor.current).offset()?.top ?? 0);
      if (window.pageYOffset > scrollY) {
        this.lastScrollY = window.pageYOffset;

        window.scrollTo(window.pageXOffset, scrollY);
        this.mountObserver();
      }
    } else {
      window.scrollTo(window.pageXOffset, this.lastScrollY);

      this.lastScrollY = null;
    }
  };

  @action
  private readonly onScroll = () => {
    this.lastScrollY = null;
    document.removeEventListener('scroll', this.onScroll);
    this.removeObserver();
  };

  private removeObserver() {
    if (this.observer == null) return;

    this.observer.disconnect();
    this.observer = null;
  }
}
