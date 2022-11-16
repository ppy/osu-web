// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

type Props = Record<string, never>;

// order the sorters appear in.
const sortNames = ['title', 'artist', 'difficulty', 'updated', 'ranked', 'rating', 'plays', 'favourites', 'relevance', 'nominations'] as const;
type Sort = typeof sortNames[number];

@observer
export class SearchSort extends React.Component<Props> {
  private get filters() {
    return core.beatmapsetSearchController.filters;
  }

  @computed
  private get fields() {
    const visible = {
      artist: true,
      difficulty: true,
      favourites: true,
      nominations: this.filters.status === 'pending',
      plays: true,
      ranked: false,
      rating: true,
      relevance: this.filters.query != null,
      title: true,
      updated: false,
    };

    switch (this.filters.status) {
      case 'graveyard':
      case 'pending':
      case 'wip':
        visible.updated = true;
        break;
      case 'any':
      case 'favourites':
      case 'mine':
        visible.updated = true;
        visible.ranked = true;
        break;
      default:
        visible.ranked = true;
    }

    return sortNames.filter((key) => visible[key]);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='sort sort--beatmapsets'>
        <div className='sort__items'>
          <span className='sort__item sort__item--title'>{trans('sort._')}</span>
          {this.fields.map(this.renderField)}
        </div>
      </div>
    );
  }

  private readonly renderField = (field: Sort) => {
    const active = this.filters.searchSort.field === field;

    return (
      <a
        key={field}
        className={classWithModifiers('sort__item', 'button', { active })}
        data-field={field}
        href='#'
        onClick={this.select}
      >
        {trans(`beatmaps.listing.search.sorting.${field}`)}
        <span className='sort__item-arrow'>
          <i className={`fas fa-caret-${this.filters.searchSort.order === 'asc' ? 'up' : 'down'}`} />
        </span>
      </a>
    );
  };

  private readonly select = (e: React.SyntheticEvent<HTMLAnchorElement>) => {
    e.preventDefault();
    const field = e.currentTarget.dataset.field;
    const order = this.filters.searchSort.field === field && this.filters.searchSort.order === 'desc'
      ? 'asc'
      : 'desc';

    core.beatmapsetSearchController.filters.update('sort', `${field}_${order}`);
  };
}
