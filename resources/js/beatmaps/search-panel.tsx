// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { FilterKey } from 'beatmapset-search-filters';
import BeatmapsetCover from 'components/beatmapset-cover';
import Portal from 'components/portal';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import AvailableFilters, { FilterOption } from './available-filters';
import { SearchFilter } from './search-filter';

interface Props {
  availableFilters: AvailableFilters;
  firstBeatmapset?: BeatmapsetJson;
  innerRef: React.RefObject<HTMLDivElement>;
}

interface FilterProps {
  multiselect?: boolean;
  name: FilterKey;
  options: FilterOption[];
  showTitle?: boolean;
}

const Filter = observer(({ multiselect = false, name, options, showTitle = true }: FilterProps) => {
  const title = showTitle ? trans(`beatmaps.listing.search.filters.${name}`) : undefined;

  return (
    <SearchFilter
      multiselect={multiselect}
      name={name}
      options={options}
      title={title}
    />
  );
});

// props don't change anymore when selecting a new filter
@observer
export class SearchPanel extends React.Component<Props> {
  private readonly inputRef = React.createRef<HTMLInputElement>();
  private readonly pinnedInputRef = React.createRef<HTMLInputElement>();
  @observable private query = this.controller.filters.query ?? '';

  @computed
  private get controller() {
    return core.beatmapsetSearchController;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    $(document).on('sticky-header:sticking', this.setHeaderPinned);
  }

  componentWillUnmount() {
    $(document).off('sticky-header:sticking', this.setHeaderPinned);
  }

  render() {
    const breadcrumbsElement = core.stickyHeader.breadcrumbsElement;
    const contentElement = core.stickyHeader.contentElement;

    return (
      <>
        {breadcrumbsElement != null && (
          <Portal root={breadcrumbsElement}>
            {this.renderBreadcrumbs()}
          </Portal>
        )}
        {contentElement != null && (
          <Portal root={contentElement}>
            {this.renderStickyContent()}
          </Portal>
        )}
        <div className='osu-page osu-page--beatmapsets-search-header'>
          {this.controller.advancedSearch ? this.renderUser() : this.renderGuest()}
        </div>
      </>
    );
  }

  @action
  private readonly expand = (e: React.MouseEvent<HTMLAnchorElement>) => {
    e.preventDefault();
    this.controller.isExpanded = true;
  };

  @action
  private readonly onChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    this.query = event.currentTarget.value;
    this.controller.filters.update('query', this.query);
  };

  private renderBreadcrumbs() {
    if (!this.controller.advancedSearch) return null;

    // TODO: replace with component that takes an array of {name, link}.
    return (
      <ol className='sticky-header-breadcrumbs'>
        <li className='sticky-header-breadcrumbs__item'>
          <span className='sticky-header-breadcrumbs__link'>
            {trans('beatmapsets.index.guest_title')}
          </span>
        </li>
        <li className='sticky-header-breadcrumbs__item'>
          <span className='sticky-header-breadcrumbs__link'>
            {trans('home.search.title')}
          </span>
        </li>
      </ol>
    );
  }

  private renderGuest() {
    return (
      <div ref={this.props.innerRef} className='beatmapsets-search'>
        <div className='beatmapsets-search__cover'>
          <BeatmapsetCover beatmapset={this.props.firstBeatmapset} modifiers='full' size='cover' />
        </div>
        <div className='beatmapsets-search__input-container js-user-link'>
          <input
            className='beatmapsets-search__input'
            disabled
            placeholder={trans('beatmaps.listing.search.login_required')}
          />
          <div className='beatmapsets-search__icon'>
            <i className='fas fa-search' />
          </div>
        </div>
      </div>
    );
  }

  private renderStickyContent() {
    if (!this.controller.advancedSearch) return null;

    return (
      <div className='beatmapsets-search beatmapsets-search--sticky'>
        <div className='beatmapsets-search__input-container'>
          <input
            ref={this.pinnedInputRef}
            className='beatmapsets-search__input js-beatmapsets-search-input'
            name='search'
            onChange={this.onChange}
            placeholder={trans('beatmaps.listing.search.prompt')}
            value={this.query}
          />
          <div className='beatmapsets-search__icon'>
            <i className='fas fa-search' />
          </div>
        </div>
        <div className='beatmapsets-search__filters'>
          <Filter name='status' options={this.props.availableFilters.statuses} showTitle={false} />
          <Filter name='mode' options={this.props.availableFilters.modes} showTitle={false} />
        </div>
      </div>
    );
  }

  private renderUser() {
    const filters = this.props.availableFilters;
    const cssClasses = classWithModifiers('beatmapsets-search', { expanded: this.controller.isExpanded });

    return (
      <div ref={this.props.innerRef} className={cssClasses}>
        <div className='beatmapsets-search__cover'>
          <BeatmapsetCover beatmapset={this.props.firstBeatmapset} modifiers='full' size='cover' />
        </div>
        <div className='beatmapsets-search__input-container'>
          <input
            ref={this.inputRef}
            className='beatmapsets-search__input js-beatmapsets-search-input'
            name='search'
            onChange={this.onChange}
            placeholder={trans('beatmaps.listing.search.prompt')}
            value={this.query}
          />
          <div className='beatmapsets-search__icon'>
            <i className='fas fa-search' />
          </div>
        </div>
        <Filter multiselect name='general' options={filters.general} />
        <Filter name='mode' options={filters.modes} />
        <Filter name='status' options={filters.statuses} />
        <Filter name='nsfw' options={filters.nsfw} />
        <a className='beatmapsets-search__expand-link' href='#' onClick={this.expand}>
          <div>{trans('beatmaps.listing.search.options')}</div>
          <div><i className='fas fa-angle-down' /></div>
        </a>
        <div className='beatmapsets-search__advanced'>
          <Filter name='genre' options={filters.genres} />
          <Filter name='language' options={filters.languages} />
          <Filter multiselect name='extra' options={filters.extras} />
          <Filter multiselect name='rank' options={filters.ranks} />
          <Filter name='played' options={filters.played} />
        </div>
      </div>
    );
  }

  private readonly setHeaderPinned = (_event: unknown, pinned: boolean) => {
    const focusOptions = { preventScroll: true };

    if (pinned && document.activeElement === this.inputRef.current) {
      this.pinnedInputRef.current?.focus(focusOptions);
    } else if (!pinned && document.activeElement === this.pinnedInputRef.current) {
      this.inputRef.current?.focus(focusOptions);
    }
  };
}
