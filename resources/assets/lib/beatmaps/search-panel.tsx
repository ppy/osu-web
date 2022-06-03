// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { FilterKey } from 'beatmapset-search-filters';
import BeatmapsetCover from 'components/beatmapset-cover';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { createPortal } from 'react-dom';
import { classWithModifiers } from 'utils/css';
import AvailableFilters, { FilterOption } from './available-filters';
import { SearchFilter } from './search-filter';

interface Props {
  availableFilters: AvailableFilters;
  firstBeatmapset: BeatmapsetJson;
  innerRef: React.RefObject<HTMLDivElement>;
}

function mountPortal(portal: HTMLElement, root?: Element | null) {
  // clean up any existing element when navigating backwards.
  const existingElement = window.newBody?.querySelector(`#${portal.id}`);
  existingElement?.remove();

  root?.appendChild(portal);
}

function unmountPortal(portal: HTMLElement, root?: Element | null) {
  if (portal.offsetParent != null) {
    root?.removeChild(portal);
  }
}

interface FilterProps {
  multiselect?: boolean;
  name: FilterKey;
  options: FilterOption[];
  showTitle?: boolean;
}

const Filter = observer(({ multiselect = false, name, options, showTitle = true }: FilterProps) => {
  const title = showTitle ? osu.trans(`beatmaps.listing.search.filters.${name}`) : undefined;

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
  private readonly breadcrumbsElement = core.stickyHeader.breadcrumbsElement;
  private readonly breadcrumbsPortal = document.createElement('div');
  private readonly contentElement = core.stickyHeader.contentElement;
  private readonly contentPortal = document.createElement('div');
  private readonly inputRef = React.createRef<HTMLInputElement>();
  private readonly pinnedInputRef = React.createRef<HTMLInputElement>();

  @computed
  private get controller() {
    return core.beatmapsetSearchController;
  }

  constructor(props: Props) {
    super(props);

    // id is to trigger warnings if duplicate portals get added.
    this.breadcrumbsPortal.id = 'search-panel-breadcrumbs-portal';
    this.contentPortal.id = 'search-panel-content-portal';

    makeObservable(this);
  }

  componentDidMount() {
    $(document).on('sticky-header:sticking', this.setHeaderPinned);
    mountPortal(this.breadcrumbsPortal, this.breadcrumbsElement);
    mountPortal(this.contentPortal, this.contentElement);
  }

  componentWillUnmount() {
    $(document).on('sticky-header:sticking', this.setHeaderPinned);
    unmountPortal(this.breadcrumbsPortal, this.breadcrumbsElement);
    unmountPortal(this.contentPortal, this.contentElement);
  }

  render() {
    return (
      <div>
        {this.breadcrumbsElement != null && createPortal(this.renderBreadcrumbs(), this.breadcrumbsPortal)}
        {this.contentElement != null && createPortal(this.renderStickyContent(), this.contentPortal)}
        <div className='osu-page osu-page--beatmapsets-search-header'>
          {this.controller.advancedSearch ? this.renderUser() : this.renderGuest()}
        </div>
      </div>
    );
  }

  @action
  private readonly expand = (e: React.MouseEvent<HTMLAnchorElement>) => {
    e.preventDefault();
    this.controller.isExpanded = true;
  };

  private readonly onChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const query = event.currentTarget.value;

    if (this.pinnedInputRef.current != null && this.pinnedInputRef.current.value !== query) {
      this.pinnedInputRef.current.value = query;
    }

    if (this.inputRef.current != null && this.inputRef.current.value !== query) {
      this.inputRef.current.value = query;
    }

    this.controller.filters.update('query', query);
  };

  private renderBreadcrumbs() {
    if (!this.controller.advancedSearch) return null;

    // TODO: replace with component that takes an array of {name, link}.
    return (
      <ol className='sticky-header-breadcrumbs'>
        <li className='sticky-header-breadcrumbs__item'>
          <span className='sticky-header-breadcrumbs__link'>
            {osu.trans('beatmapsets.index.guest_title')}
          </span>
        </li>
        <li className='sticky-header-breadcrumbs__item'>
          <span className='sticky-header-breadcrumbs__link'>
            {osu.trans('home.search.title')}
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
            placeholder={osu.trans('beatmaps.listing.search.login_required')}
            type='textbox'
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
            defaultValue={this.controller.filters.query ?? ''}
            name='search'
            onChange={this.onChange}
            placeholder={osu.trans('beatmaps.listing.search.prompt')}
            type='textbox'
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
            defaultValue={this.controller.filters.query ?? ''}
            name='search'
            onChange={this.onChange}
            placeholder={osu.trans('beatmaps.listing.search.prompt')}
            type='textbox'
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
          <div>{osu.trans('beatmaps.listing.search.options')}</div>
          <div><i className='fas fa-angle-down'/></div>
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
