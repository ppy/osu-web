// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { TagJsonWithCount } from 'interfaces/tag-json';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import * as React from 'react';
import { makeSearchQueryOption } from 'utils/beatmapset-helper';

interface Props {
  tag: TagJsonWithCount;
}

@observer
export default class UserTag extends React.PureComponent<Props> {
  render() {
    return (
      <a
        className='beatmapset-info__link'
        href={route('beatmapsets.index', { q: makeSearchQueryOption('tag', this.props.tag.name) })}
      >
        {this.props.tag.name}
      </a>
    );
  }
}


