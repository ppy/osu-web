// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as clipboard from 'clipboard-polyfill';
import * as React from 'react';

interface Props {
  label?: string;
  showIcon: boolean;
  value: string;
  valueAsUrl: boolean;
}

const bn = 'click-to-copy';

export default class ClickToCopy extends React.Component<Props> {
  static defaultProps = {
    showIcon: false,
    valueAsUrl: false,
  };

  private readonly linkRef = React.createRef<HTMLAnchorElement>();
  private timer?: number;
  private readonly titles = {
    default: osu.trans('common.buttons.click_to_copy'),
    onClick: osu.trans('common.buttons.click_to_copy_copied'),
  } as const;

  private get api() {
    if (this.linkRef.current != null) {
      return $(this.linkRef.current).qtip('api');
    }
  }

  componentWillUnmount() {
    window.clearTimeout(this.timer);
  }

  render() {
    if (!this.props.value) {
      return <span />;
    }

    return (
      <a
        ref={this.linkRef}
        className={bn}
        data-tooltip-hide-events='mouseleave'
        data-tooltip-pin-position
        data-tooltip-position='bottom center'
        href={this.props.valueAsUrl ? this.props.value : '#'}
        onClick={this.onClick}
        onMouseLeave={this.onMouseLeave}
        title={this.titles.default}
      >
        {this.props.label || this.props.value}
        {this.props.showIcon && <i className={`fas fa-paste ${bn}__icon`} />}
      </a>
    );
  }

  private readonly onClick = (e: React.MouseEvent) => {
    e.preventDefault();

    // copy url to clipboard
    clipboard.writeText(this.props.value);

    const api = this.api;

    if (api == null) return;

    // change tooltip text to provide feedback
    api.set('content.text', this.titles.onClick);

    // set timer to reset tooltip text
    window.clearTimeout(this.timer);
    this.timer = window.setTimeout(this.resetTooltip, 1000);
  };

  private readonly onMouseLeave = () => {
    window.clearTimeout(this.timer);
    this.resetTooltip();
  };

  private readonly resetTooltip = () => {
    const api = this.api;

    if (api == null) return;

    api.hide();
    // add delay for reverting title content otherwise it'll flash when fading out.
    this.timer = window.setTimeout(() => {
      api.set('content.text', this.titles.default);
    }, 100);
  };
}
