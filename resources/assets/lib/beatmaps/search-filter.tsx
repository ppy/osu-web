// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearchParams, FilterKey } from 'beatmapset-search-filters';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { updateQueryString } from 'utils/url';

interface FilterOption {
  id: string | number | null;
  name: string;
}

interface Props {
  multiselect: boolean;
  name: FilterKey;
  options: FilterOption[];
  recommendedDifficulty?: number;
  title?: string;
}

@observer
export class SearchFilter extends React.PureComponent<Props> {
  get controller() {
    return core.beatmapsetSearchController;
  }

  @computed
  get currentSelection() {
    if (this.props.multiselect) {
      // multiselects don't have nulls
      const selected = this.controller.filters.selectedValue(this.props.name) ?? '';
      return selected.split('.').filter((s) => this.optionKeys.includes(s));
    } else {
      return [this.controller.filters.selectedValue(this.props.name)];
    }
  }

  @computed
  get options() {
    // normalize option keys
    return this.props.options.map((option) => ({
      id: typeof option.id === 'number' ? String(option.id) : option.id,
      name: option.name,
    }));
  }

  @computed
  get optionKeys() {
    return this.options.map((option) => option.id);
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <div className='beatmapsets-search-filter'>
        {this.props.title != null && <span className='beatmapsets-search-filter__header'>{this.props.title}</span>}
        <div className='beatmapsets-search-filter__items'>
          {this.options.map(this.renderOption)}
        </div>

      </div>
    );
  }

  private href(id: string | null) {
    const filters = Object.assign({}, this.controller.filters);
    filters[this.props.name] = this.newSelection(id);

    return updateQueryString(null, BeatmapsetFilter.queryParamsFromFilters(filters));
  }

  private isSelected(key: string | null) {
    return this.currentSelection.includes(key);
  }

  // TODO: rename
  private newSelection(key: string | null) {
    if (this.props.multiselect) {
      if (this.isSelected(key)) {
        return this.currentSelection.filter((x) => x !== key).join('.');
      } else {
        return this.currentSelection.concat(key).join('.');
      }
    } else {
      if (this.isSelected(key)) {
        return BeatmapsetFilter.defaults[key ?? ''];
      } else {
        return key;
      }
    }
  }

  private readonly renderOption = (option: { id: string | null; name: string }) => {
    const cssClasses = classWithModifiers('beatmapsets-search-filter__item', {
      active: this.isSelected(option.id),
      'featured-artists': option.id === 'featured_artists',
    });

    let text = option.name;
    if (this.props.name === 'general' && option.id === 'recommended' && this.props.recommendedDifficulty != null) {
      text += ` (${formatNumber(this.props.recommendedDifficulty, 2)})`;
    }
    // FIXME: do an actual navigation
    return (
      <a
        key={option.id}
        className={cssClasses}
        data-filter-value={option.id}
        href={this.href(option.id)}
        onClick={this.select}
      >
        {text}
      </a>
    );
  };

  private readonly select = (e: React.MouseEvent<HTMLAnchorElement>) => {
    e.preventDefault();
    const params: Partial<BeatmapsetSearchParams> = {};
    params[this.props.name] = this.newSelection(e.currentTarget.dataset.filterValue ?? null);

    this.controller.updateFilters(params);
  };
}
