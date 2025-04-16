// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { TagJsonWithCount } from 'interfaces/tag-json';
import { route } from 'laroute';
import * as React from 'react';
import { makeSearchQueryOption } from 'utils/beatmapset-helper';

interface Props {
  tag: TagJsonWithCount;
}

export default class UserTag extends React.PureComponent<Props> {
  private readonly category;
  private readonly name;

  private get url() {
    return route('beatmapsets.index', { q: makeSearchQueryOption('tag', this.props.tag.name) });
  }

  constructor(props: Props) {
    super(props);

    const split = props.tag.name.split('/');
    this.category = split[0];
    this.name = split[1];
  }

  render() {
    return (
      <a
        className='user-tag'
        href={this.url}
        title={this.props.tag.description}
      >
        <span className='user-tag__item user-tag__item--category'>{this.category}</span>
        <span className='user-tag__item user-tag__item--name'>{this.name}</span>
        <span className='user-tag__item user-tag__item--count'>{this.props.tag.count}</span>
      </a>
    );
  }
}


