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

  // TODO: figure out if possible to use the qtip typescript types
  api: any;
  timer?: number;
  title: string|null = null;

  click = (e: React.MouseEvent) => {
    e.preventDefault();

    const el = e.currentTarget as HTMLElement;

    if (this.api == null) {
      this.api = $(el).qtip('api');
    }

    // copy url to clipboard
    clipboard.writeText(this.props.value);

    // change tooltip text to provide feedback
    this.api.set('content.text', osu.trans('common.buttons.click_to_copy_copied'));

    // set timer to reset tooltip text
    window.clearTimeout(this.timer);
    this.timer = window.setTimeout(this.restoreTooltipText, 1000);

    if (this.title == null) {
      this.title = el.getAttribute('title') || el.dataset.origTitle || null;
    }
  };

  componentWillMount() {
    this.restoreTooltipText();
  }

  render() {
    if (!this.props.value) {
      return <span/>;
    }

    return (
      <a
        className={bn}
        data-tooltip-hide-events='mouseleave'
        data-tooltip-pin-position
        data-tooltip-position='bottom center'
        href={this.props.valueAsUrl ? this.props.value : '#'}
        onClick={this.click}
        title={osu.trans('common.buttons.click_to_copy')}
      >
        {this.props.label || this.props.value}
        {this.props.showIcon && <i className={`fas fa-paste ${bn}__icon`}/>}
      </a>
    );
  }

  restoreTooltipText = () => {
    if (this.title != null) {
      this.api.hide();

      window.setTimeout(() => {
        this.api.set('content.text', this.title);
      }, 100);
    }
  };
}
