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

import * as _ from 'lodash';
import { observer } from 'mobx-react';
import * as React from 'react';
import Notification from 'models/notification';
import Item from './item';
import Worker from './worker';

interface Props {
  items: Notification[];
  worker: Worker;
}

interface State {
  expanded: boolean;
}

const bn = 'notification-category-group';

@observer
export default class CategoryGroup extends React.Component<Props, State> {
  state = {
    expanded: false,
  };

  render() {
    if (this.props.items.length === 0) {
      return null;
    }

    let items: Notification[][];
    let expandButton: React.ReactNode = null;
    let blockClass = bn;
    const hasToggle = this.props.items.length > 1;

    if (this.props.items.length === 1) {
      blockClass += ` ${bn}--single`;
      items = [this.props.items];
    } else {
      let buttonText: string;
      let buttonDirection: string;

      if (this.state.expanded) {
        items = this.props.items.map((item) => [item]);
        buttonText = osu.trans('common.buttons.collapse');
        buttonDirection = 'up';
      } else {
        items = [this.props.items];
        buttonText = osu.formatNumber(this.props.items.length);
        buttonDirection = 'down';
      }

      expandButton = <div className={`${bn}__expand-button`}>
        <ShowMoreLink
          hasMore={true}
          label={buttonText}
          direction={buttonDirection}
          callback={this.toggleExpand}
          modifiers={['t-graysky']}
        />
      </div>;
    }

    return <div className={blockClass}>
      {items.map((item) => {
        return <div key={item[0].id} className='notification-category-group__item'>
          <Item items={item} worker={this.props.worker} />
        </div>;
      })}
      {expandButton}
    </div>;
  }

  toggleExpand = () => {
    this.setState({ expanded: !this.state.expanded });
  }
}
