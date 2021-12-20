// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AchievementJson from 'interfaces/achievement-json';
import CurrentUserJson from 'interfaces/current-user-json';
import GameMode from 'interfaces/game-mode';
import ExtrasJson from 'interfaces/profile-page/extras-json';
import UserCoverJson from 'interfaces/user-cover-json';
import { ProfileExtraPage, profileExtraPages } from 'interfaces/user-extended-json';
import { route } from 'laroute';
import { debounce, keyBy } from 'lodash';
import { action, makeObservable, observable } from 'mobx';
import core from 'osu-core-singleton';
import { onErrorWithCallback } from 'utils/ajax';
import { apiShowMore, apiShowMoreRecentlyReceivedKudosu, hasMoreCheck, OffsetPaginationJson } from 'utils/offset-paginator';
import { switchNever } from 'utils/switch-never';
import { ProfilePageSection, profilePageSections, ProfilePageUserJson } from './extra-page-props';

const sectionToUrlType = {
  favouriteBeatmapsets: 'favourite',
  graveyardBeatmapsets: 'graveyard',
  lovedBeatmapsets: 'loved',
  pendingBeatmapsets: 'pending',
  rankedBeatmapsets: 'ranked',
  scoresBest: 'best',
  scoresFirsts: 'firsts',
  scoresRecent: 'recent',
};

export type PaginationData = Record<ProfilePageSection, OffsetPaginationJson>;

export function validPage(page: unknown) {
  if (typeof page === 'string' && (page === 'main' || profileExtraPages.includes(page as ProfileExtraPage))) {
    return page as Page;
  }

  return null;
}

interface InitialData {
  achievements: AchievementJson[];
  current_mode: GameMode;
  extras: ExtrasJson;
  per_page: Record<ProfilePageSection, number>;
  scores_notice: string | null;
  user: ProfilePageUserJson;
}

export type Page = ProfileExtraPage | 'main';

interface State {
  currentPage: Page;
  editingUserPage: boolean;
  extras: ExtrasJson;
  pagination: PaginationData;
  user: ProfilePageUserJson;
}

export default class Controller {
  readonly achievements: Partial<Record<string, AchievementJson>>;
  readonly currentMode: GameMode;
  @observable currentPage: Page = 'main';
  readonly debouncedSetDisplayCoverUrl = debounce((url: string | null) => this.setDisplayCoverUrl(url), 300);
  @observable displayCoverUrl: string | null;
  readonly hasSavedState: boolean;
  @observable isUpdatingCover = false;
  readonly scoresNotice: string | null;
  @observable readonly state: State;
  private xhr: Partial<Record<string, JQuery.jqXHR<unknown>>> = {};

  get canUploadCover() {
    return this.state.user.is_supporter;
  }

  get withEdit() {
    return core.currentUser?.id === this.state.user.id;
  }

  constructor(private container: HTMLElement) {
    const initialData = JSON.parse(this.container.dataset.initialData ?? 'null') as InitialData;

    const savedStateJson = container.dataset.savedState;
    this.hasSavedState = savedStateJson != null;

    if (savedStateJson == null) {
      this.state = {
        currentPage: 'main',
        editingUserPage: false,
        extras: initialData.extras,
        pagination: {
          beatmapPlaycounts: {},
          favouriteBeatmapsets: {},
          graveyardBeatmapsets: {},
          lovedBeatmapsets: {},
          pendingBeatmapsets: {},
          rankedBeatmapsets: {},
          recentActivity: {},
          recentlyReceivedKudosu: {},
          scoresBest: {},
          scoresFirsts: {},
          scoresRecent: {},
        },
        user: initialData.user,
      };

      for (const section of profilePageSections) {
        this.state.pagination[section].hasMore = hasMoreCheck(initialData.per_page[section], this.state.extras[section]);
      }
    } else {
      this.state = JSON.parse(savedStateJson) as State;
    }

    this.achievements = keyBy(initialData.achievements, 'id');
    this.currentMode = initialData.current_mode;
    this.scoresNotice = initialData.scores_notice;
    this.displayCoverUrl = this.state.user.cover.url;

    makeObservable(this);
  }

  @action
  apiSetCover(id: string) {
    this.isUpdatingCover = true;

    this.xhr.setCover?.abort();

    const xhr = $.ajax(route('account.cover'), {
      data: {
        cover_id: id,
      },
      dataType: 'json',
      method: 'POST',
    }).always(action(() => {
      this.isUpdatingCover = false;
    })).done(action((userData: CurrentUserJson) => {
      this.setCover(userData.cover);
      this.saveState();
    })).fail(onErrorWithCallback(() => {
      this.apiSetCover(id);
    })) as JQuery.jqXHR<CurrentUserJson>;

    this.xhr.setCover = xhr;

    return xhr;
  }

  @action
  apiSetDefaultGameMode() {
    this.xhr.setDefaultGameMode?.abort();

    const xhr = $.ajax(route('account.options'), {
      data: {
        user: {
          playmode: this.currentMode,
        },
      },
      method: 'PUT',
    }).done(action(() => {
      this.state.user.playmode = this.currentMode;
      this.saveState();
    })) as JQuery.jqXHR<CurrentUserJson>;

    this.xhr.setDefaultGameMode = xhr;

    return xhr;
  }

  @action
  apiSetExtraPageOrder(newOrder: ProfileExtraPage[]): JQuery.jqXHR<CurrentUserJson> {
    this.state.user.profile_order = newOrder;

    this.xhr.setExtraPageOrder?.abort();

    const xhr = $.ajax(route('account.options'), {
      data: {
        user_profile_customization: {
          extras_order: newOrder,
        },
      },
      dataType: 'json',
      method: 'PUT',
    }).done(this.saveState) as JQuery.jqXHR<CurrentUserJson>;

    this.xhr.setExtraPageOrder = xhr;

    return xhr;
  }

  apiSetUserPage(newRaw: string): JQuery.jqXHR<{ html: string }> {
    this.xhr.setUserPage?.abort();

    const xhr = $.ajax(route('users.page', { user: this.state.user.id }), {
      data: {
        body: newRaw,
      },
      dataType: 'json',
      method: 'PUT',
    }).done(action((data: { html: string }) => {
      this.state.user.page.html = data.html;
      this.state.user.page.raw = newRaw;
      this.saveState();
    })) as JQuery.jqXHR<{ html: string }>;

    this.xhr.setUserPage = xhr;

    return xhr;
  }

  @action
  apiShowMore(section: ProfilePageSection) {
    const baseParams = { user: this.state.user.id };

    switch (section) {
      case 'beatmapPlaycounts':
        this.xhr[section] = apiShowMore({
          items: this.state.extras[section],
          pagination: this.state.pagination[section],
        }, 'users.beatmapsets', { ...baseParams, type: 'most_played' });
        break;

      case 'favouriteBeatmapsets':
      case 'graveyardBeatmapsets':
      case 'lovedBeatmapsets':
      case 'pendingBeatmapsets':
      case 'rankedBeatmapsets':
        this.xhr[section] = apiShowMore({
          items: this.state.extras[section],
          pagination: this.state.pagination[section],
        }, 'users.beatmapsets', { ...baseParams, type: sectionToUrlType[section] });
        break;

      case 'recentActivity':
        this.xhr[section] = apiShowMore({
          items: this.state.extras[section],
          pagination: this.state.pagination[section],
        }, 'users.recent-activity', baseParams);
        break;

      case 'recentlyReceivedKudosu':
        this.xhr[section] = apiShowMoreRecentlyReceivedKudosu({
          items: this.state.extras[section],
          pagination: this.state.pagination[section],
        }, baseParams.user);
        break;

      case 'scoresBest':
      case 'scoresFirsts':
      case 'scoresRecent':
        this.xhr[section] = apiShowMore({
          items: this.state.extras[section],
          pagination: this.state.pagination[section],
        }, 'users.scores', { ...baseParams, mode: this.currentMode, type: sectionToUrlType[section] });
        break;

      default:
        switchNever(section);
        throw new Error('trying to show more unexpected section');
    }

    this.xhr[section]?.done(this.saveState);
  }

  destroy() {
    Object.values(this.xhr).forEach((xhr) => xhr?.abort());
    this.debouncedSetDisplayCoverUrl.cancel();
  }

  @action
  setCover(cover: UserCoverJson) {
    this.state.user.cover = cover;
    this.setDisplayCoverUrl(null);
  }

  @action
  setDisplayCoverUrl(url: string | null) {
    this.displayCoverUrl = url ?? this.state.user.cover.url;
  }

  private readonly saveState = () => {
    this.container.dataset.savedState = JSON.stringify(this.state);
  };
}
