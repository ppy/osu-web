// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AchievementJson from 'interfaces/achievement-json';
import CurrentUserJson from 'interfaces/current-user-json';
import GameMode from 'interfaces/game-mode';
import ExtrasJson from 'interfaces/profile-page/extras-json';
import ScoreJson, { ScoreCurrentUserPinJson } from 'interfaces/score-json';
import UserCoverJson from 'interfaces/user-cover-json';
import { ProfileExtraPage, profileExtraPages } from 'interfaces/user-extended-json';
import { route } from 'laroute';
import { debounce, keyBy, pullAt } from 'lodash';
import { action, makeObservable, observable } from 'mobx';
import core from 'osu-core-singleton';
import { error, onErrorWithCallback } from 'utils/ajax';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
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
  scoresPinned: 'pinned',
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

interface ScorePinReorderParams {
  order1_score_id?: ScoreCurrentUserPinJson['score_id'];
  order3_score_id?: ScoreCurrentUserPinJson['score_id'];
  score_id: ScoreCurrentUserPinJson['score_id'];
  score_type: ScoreCurrentUserPinJson['score_type'];
}

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
          scoresPinned: {},
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

    $.subscribe('score:pin', this.onScorePinUpdate);

    makeObservable(this);
  }

  @action
  apiReorderScorePin(currentIndex: number, newIndex: number) {
    const origItems = this.state.extras.scoresPinned.slice();
    const items = this.state.extras.scoresPinned;
    const adjacentScoreId = items[newIndex]?.id;
    if (adjacentScoreId == null) {
      throw new Error('invalid newIndex specified');
    }

    // fetch item to be moved and update internal state
    const target = items.splice(currentIndex, 1)[0];

    if (target == null) {
      throw new Error('invalid currentIndex specified');
    }
    if (target.current_user_attributes.pin == null) {
      throw new Error('score is missing current user pin attribute');
    }
    items.splice(newIndex, 0, target);
    this.saveState();

    const params: ScorePinReorderParams = {
      score_id: target.current_user_attributes.pin.score_id,
      score_type: target.current_user_attributes.pin.score_type,
    };
    if (currentIndex > newIndex) {
      // target will be above existing item at index
      params.order3_score_id = adjacentScoreId;
    } else {
      // target will be below existing item at index
      params.order1_score_id = adjacentScoreId;
    }

    showLoadingOverlay();
    $.ajax(route('score-pins.reorder'), {
      data: params,
      dataType: 'json',
      method: 'PUT',
    }).fail(action((xhr: JQuery.jqXHR, status: string) => {
      error(xhr, status);
      this.state.extras.scoresPinned = origItems;
    })).always(hideLoadingOverlay);
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
        this.xhr[section] = apiShowMore(
          this.paginatorJson(section),
          'users.beatmapsets',
          { ...baseParams, type: 'most_played' },
        );
        break;

      case 'favouriteBeatmapsets':
      case 'graveyardBeatmapsets':
      case 'lovedBeatmapsets':
      case 'pendingBeatmapsets':
      case 'rankedBeatmapsets':
        this.xhr[section] = apiShowMore(
          this.paginatorJson(section),
          'users.beatmapsets',
          { ...baseParams, type: sectionToUrlType[section] },
        );
        break;

      case 'recentActivity':
        this.xhr[section] = apiShowMore(
          this.paginatorJson(section),
          'users.recent-activity',
          baseParams,
        );
        break;

      case 'recentlyReceivedKudosu':
        this.xhr[section] = apiShowMoreRecentlyReceivedKudosu(
          this.paginatorJson(section),
          baseParams.user,
        );
        break;

      case 'scoresBest':
      case 'scoresFirsts':
      case 'scoresPinned':
      case 'scoresRecent':
        this.xhr[section] = apiShowMore(
          this.paginatorJson(section),
          'users.scores',
          { ...baseParams, mode: this.currentMode, type: sectionToUrlType[section] },
        );
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
    $.unsubscribe('score:pin', this.onScorePinUpdate);
  }

  paginatorJson<T extends ProfilePageSection>(section: T) {
    return {
      items: this.state.extras[section],
      pagination: this.state.pagination[section],
    };
  }

  @action
  setCover(cover: UserCoverJson) {
    core.currentUserOrFail.cover = this.state.user.cover = cover;
    this.setDisplayCoverUrl(null);
  }

  @action
  setDisplayCoverUrl(url: string | null) {
    this.displayCoverUrl = url ?? this.state.user.cover.url;
  }

  private readonly onScorePinUpdate = (event: unknown, isPinned: boolean, score: ScoreJson) => {
    const arrayIndex = this.state.extras.scoresPinned.findIndex((s) => s.id === score.id);
    this.state.user.scores_pinned_count += isPinned ? 1 : -1;

    if (isPinned) {
      if (arrayIndex === -1) {
        this.state.extras.scoresPinned.unshift(score);
      }
    } else {
      if (arrayIndex !== -1) {
        pullAt(this.state.extras.scoresPinned, arrayIndex);
      }
    }

    this.saveState();
  };

  private readonly saveState = () => {
    this.container.dataset.savedState = JSON.stringify(this.state);
  };
}
