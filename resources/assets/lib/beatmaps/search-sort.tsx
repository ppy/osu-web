// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { isEmpty } from 'lodash';
import { computed } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

type Props = Record<string, never>;

@observer
export class SearchSort extends React.Component<Props> {
  @computed
  get filters() {
    return core.beatmapsetSearchController.filters;
  }

  @computed
  get fields() {
    const visible = {
      /* eslint-disable sort-keys */
      title: true,
      artist: true,
      difficulty: true,
      updated: false,
      ranked: false,
      rating: true,
      plays: true,
      favourites: true,
      relevance: false,
      nominations: false,
      /* eslint-enable sort-keys */
    };

    if (isEmpty(this.filters.query)) {
      visible.relevance = true;
    }

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

    if (this.filters.status === 'pending') {
      visible.nominations = true;
    }

    const list = [];
    for (const key of Object.keys(visible)) {
      if (visible[key]) {
        list.push(key);
      }
    }

    return list;
  }

  render() {
    return (
      <div className='sort sort--beatmapsets'>
        <div className='sort__items'>
          <span className='sort__item sort__item--title'>{osu.trans('sort._')}</span>
          {this.fields.map(this.renderField)}
        </div>
      </div>
    );
  }

  private readonly renderField = (field: string) => {
    const active = this.filters.searchSort.field === field;

    return (
      <a
        key={field}
        className={classWithModifiers('sort__item', 'button', { active })}
        data-field={field}
        href='#'
        onClick={this.select}
      >
        {osu.trans(`beatmaps.listing.search.sorting.${field}`)}
        <span className='sort__item-arrow'>
          <i className={`fas fa-caret-${this.filters.searchSort.order === 'asc' ? 'up' : 'down'}`} />
        </span>
      </a>
    );
  };

  private readonly select = (e: React.SyntheticEvent<HTMLAnchorElement>) => {
    e.preventDefault();
    const field = e.currentTarget.dataset.field;
    let order = this.filters.searchSort.order;

    order = this.filters.searchSort.field === field && order === 'desc'
      ? 'asc'
      : 'desc';

    core.beatmapsetSearchController.updateFilters({ sort: `${field}_${order}` });
  };
}
