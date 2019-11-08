/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import * as clipboard from 'clipboard-polyfill';
import * as React from 'react';

interface Props {
  label?: string;
  showIcon: boolean;
  value: string;
  valueAsUrl: boolean;
}

const bn = 'click-to-copy';

export default class ClickToCopy extends React.Component<Props, {}> {
  static defaultProps = {
    showIcon: false,
    valueAsUrl: false,
  };

  // TODO: figure out if possible to use the qtip typescript types
  api: any;
  timer: number|null = null;
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
    Timeout.clear(this.timer);
    this.timer = Timeout.set(1000, this.restoreTooltipText);

    if (this.title == null) {
      this.title = el.getAttribute('title') || el.dataset.origTitle || null;
    }
   }

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
        data-tooltip-pin-position={true}
        data-tooltip-position='bottom center'
        data-tooltip-hide-events='mouseleave'
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

      Timeout.set(100, () => {
        this.api.set('content.text', this.title);
      });
    }
  }
}
