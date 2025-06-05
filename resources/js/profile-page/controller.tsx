// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AchievementJson from 'interfaces/achievement-json';
import BeatmapPlaycountJson from 'interfaces/beatmap-playcount-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import CurrentUserJson from 'interfaces/current-user-json';
import EventJson from 'interfaces/event-json';
import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import Ruleset from 'interfaces/ruleset';
import ScoreJson, { isScoreJsonForUser, ScoreJsonForUser } from 'interfaces/score-json';
import UserCoverJson from 'interfaces/user-cover-json';
import UserCoverPresetJson from 'interfaces/user-cover-preset-json';
import { ProfileExtraPage, profileExtraPages } from 'interfaces/user-extended-json';
import UserMonthlyPlaycountJson from 'interfaces/user-monthly-playcount-json';
import UserReplaysWatchedCountJson from 'interfaces/user-replays-watched-count-json';
import { route } from 'laroute';
import { debounce, pullAt } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import core from 'osu-core-singleton';
import { error, onErrorWithCallback } from 'utils/ajax';
import { jsonClone } from 'utils/json';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import { getInt } from 'utils/math';
import { apiShowMore } from 'utils/offset-paginator';
import { switchNever } from 'utils/switch-never';
import getPage, { PageSectionJson, PageSectionWithoutCountJson } from './extra-page';
import { ProfilePageSection, ProfilePageUserJson } from './extra-page-props';

const sectionToUrlType = {
  favouriteBeatmapsets: 'favourite',
  graveyardBeatmapsets: 'graveyard',
  guestBeatmapsets: 'guest',
  lovedBeatmapsets: 'loved',
  nominatedBeatmapsets: 'nominated',
  pendingBeatmapsets: 'pending',
  rankedBeatmapsets: 'ranked',
  scoresBest: 'best',
  scoresFirsts: 'firsts',
  scoresPinned: 'pinned',
  scoresRecent: 'recent',
} as const;

// #region lazy loaded extra pages
type BeatmapsetsExtraPageKeys = 'favourite' | 'graveyard' | 'guest' | 'loved' | 'nominated' | 'pending' | 'ranked';
type BeatmapsetsJson = Record<BeatmapsetsExtraPageKeys, PageSectionJson<BeatmapsetExtendedJson>>;

interface HistoricalJson {
  beatmap_playcounts: PageSectionJson<BeatmapPlaycountJson>;
  monthly_playcounts: UserMonthlyPlaycountJson[];
  recent: PageSectionJson<ScoreJsonForUser>;
  replays_watched_counts: UserReplaysWatchedCountJson[];
}

type TopScoresKeys = 'best' | 'firsts' | 'pinned';
type TopScoresJson = Record<TopScoresKeys, PageSectionJson<ScoreJsonForUser>>;
// #endregion

export function validPage(page: unknown) {
  if (typeof page === 'string' && (page === 'main' || profileExtraPages.includes(page as ProfileExtraPage))) {
    return page as Page;
  }

  return null;
}

interface InitialData {
  achievements: AchievementJson[];
  current_mode: Ruleset;
  scores_notice: string | null;
  user: ProfilePageUserJson;
  user_cover_presets: UserCoverPresetJson[];
}

interface LazyPages {
  beatmaps: BeatmapsetsJson;
  historical: HistoricalJson;
  kudosu: PageSectionWithoutCountJson<KudosuHistoryJson>;
  recent_activity: PageSectionWithoutCountJson<EventJson>;
  top_ranks: TopScoresJson;
}

export type Page = ProfileExtraPage | 'main';

interface State {
  currentPage: Page;
  editingUserPage: boolean;
  lazy: Partial<LazyPages>;
  user: ProfilePageUserJson;
}

export default class Controller {
  readonly achievements: Map<number, AchievementJson>;
  readonly currentMode: Ruleset;
  @observable currentPage: Page = 'main';
  readonly debouncedSetDisplayCoverUrl = debounce((url: string | null) => this.setDisplayCoverUrl(url), 300);
  @observable displayCoverUrl: string | null;
  readonly hasSavedState: boolean;
  @observable isUpdatingCover = false;
  readonly scoresNotice: string | null;
  @observable selectedHue: number | null;
  @observable readonly state: State;
  readonly userCoverPresets;
  private xhr: Partial<Record<string, JQuery.jqXHR<unknown>>> = {};

  get currentCoverPresetId() {
    return getInt(this.state.user.cover.id);
  }

  get canUploadCover() {
    return this.state.user.is_supporter;
  }

  @computed
  get holdoverCoverPreset(): UserCoverPresetJson | null {
    const id = getInt(this.state.user.cover.id);

    if (id == null) return null;

    const isActive = this.userCoverPresets.some((preset) => preset.id === id);

    return isActive
      ? null
      : {
        active: false,
        id,
        url: this.state.user.cover.url,
      };
  }

  get withEdit() {
    return core.currentUser?.id === this.state.user.id;
  }

  constructor(private readonly container: HTMLElement) {
    const initialData = JSON.parse(this.container.dataset.initialData ?? 'null') as InitialData;

    const savedStateJson = container.dataset.savedState;
    this.hasSavedState = savedStateJson != null;

    if (savedStateJson == null) {
      this.state = {
        currentPage: 'main',
        editingUserPage: false,
        lazy: {},
        user: initialData.user,
      };
    } else {
      this.state = JSON.parse(savedStateJson) as State;
    }

    this.achievements = new Map();
    for (const achievement of initialData.achievements) {
      this.achievements.set(achievement.id, achievement);
    }
    this.currentMode = initialData.current_mode;
    this.scoresNotice = initialData.scores_notice;
    this.displayCoverUrl = this.state.user.cover.url;
    this.selectedHue = this.state.user.profile_hue;
    this.userCoverPresets = initialData.user_cover_presets;

    makeObservable(this);

    $.subscribe('score:pin', this.onScorePinUpdate);
    $(document).on('turbo:before-cache', this.saveState);
  }

  @action
  apiReorderScorePin(currentIndex: number, newIndex: number) {
    if (this.state.lazy.top_ranks == null) return;

    const origItems = this.state.lazy.top_ranks.pinned.items.slice();
    const items = this.state.lazy.top_ranks.pinned.items;
    const adjacentScore = items[newIndex];
    if (adjacentScore == null) {
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

    const params = currentIndex > newIndex
      // target will be above existing item at index
      ? { before_score_id: adjacentScore.id }
      // target will be below existing item at index
      : { after_score_id: adjacentScore.id };

    showLoadingOverlay();
    $.ajax(route('score-pins.reorder', { score: target.id }), {
      data: params,
      dataType: 'json',
      method: 'POST',
    }).fail(action((xhr: JQuery.jqXHR, status: string) => {
      error(xhr, status);
      if (this.state.lazy.top_ranks != null) {
        this.state.lazy.top_ranks.pinned.items = origItems;
      }
    })).always(hideLoadingOverlay);
  }

  @action
  apiSetCover(id: number) {
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

  apiSetHue(value: number | null): JQuery.jqXHR<unknown> {
    this.xhr.setHue?.abort();

    const xhr = $.ajax(route('account.update'), {
      data: {
        user: { user_style: value },
      },
      method: 'PUT',
    }).done(action(() => {
      this.setHue(value);
      this.saveState();
    })) as JQuery.jqXHR<unknown>;

    this.xhr.setHue = xhr;

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
      case 'beatmapPlaycounts': {
        if (this.state.lazy.historical != null) {
          const json = this.state.lazy.historical.beatmap_playcounts;

          this.xhr[section] = apiShowMore(
            json,
            'users.beatmapsets',
            { ...baseParams, type: 'most_played' },
          );
        }

        break;
      }

      case 'favouriteBeatmapsets':
      case 'graveyardBeatmapsets':
      case 'guestBeatmapsets':
      case 'lovedBeatmapsets':
      case 'nominatedBeatmapsets':
      case 'pendingBeatmapsets':
      case 'rankedBeatmapsets': {
        if (this.state.lazy.beatmaps != null) {
          const type = sectionToUrlType[section];
          const json = this.state.lazy.beatmaps[type];

          this.xhr[section] = apiShowMore(
            json,
            'users.beatmapsets',
            { ...baseParams, type: sectionToUrlType[section] },
          );
        }

        break;
      }

      case 'recentActivity':
        if (this.state.lazy.recent_activity != null) {
          this.xhr[section] = apiShowMore(
            this.state.lazy.recent_activity,
            'users.recent-activity',
            baseParams,
          );
        }

        break;

      case 'recentlyReceivedKudosu':
        // do nothing
        break;

      case 'scoresBest':
      case 'scoresFirsts':
      case 'scoresPinned':
      case 'scoresRecent': {
        const type = sectionToUrlType[section];
        const json = type === 'recent' ? this.state.lazy.historical?.recent : this.state.lazy.top_ranks?.[type];

        if (json != null) {
          this.xhr[section] = apiShowMore(
            json,
            'users.scores',
            { ...baseParams, mode: this.currentMode, type },
          );
        }

        break;
      }

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
    $(document).off('turbo:before-cache', this.saveState);
    this.saveState();
  }

  @action
  get<T extends keyof LazyPages>(page: T) {
    const xhr = getPage<LazyPages[T]>(this.state.user, page, this.currentMode)
      .done((json) => runInAction(() => {
        this.state.lazy[page] = json;
      }));

    this.xhr[page] = xhr;

    return xhr;
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

  @action
  setHue(value: number | null) {
    this.state.user.profile_hue = value;
    this.setSelectedHue(value);
  }

  @action
  setSelectedHue(value: number | null) {
    this.selectedHue = value;
    if (this.selectedHue == null) {
      window.newBody?.style.removeProperty('--base-hue-override');
    } else {
      window.newBody?.style.setProperty('--base-hue-override', this.selectedHue.toString());
    }
  }

  @action
  private readonly onScorePinUpdate = (event: unknown, isPinned: boolean, score: ScoreJson) => {
    if (this.state.lazy.top_ranks == null) return;
    // make sure the typing is correct
    if (!isScoreJsonForUser(score)) {
      return;
    }

    const scorePinData = score.current_user_attributes.pin;

    if (scorePinData == null) {
      throw new Error('score is missing pin data');
    }

    const newScore = jsonClone(score);
    newScore.id = scorePinData.score_id;

    const arrayIndex = this.state.lazy.top_ranks.pinned.items.findIndex((s) => s.id === newScore.id);
    this.state.lazy.top_ranks.pinned.count += isPinned ? 1 : -1;

    if (isPinned) {
      if (arrayIndex === -1) {
        this.state.lazy.top_ranks.pinned.items.unshift(newScore);
      }
    } else {
      if (arrayIndex !== -1) {
        pullAt(this.state.lazy.top_ranks.pinned.items, arrayIndex);
      }
    }

    this.saveState();
  };

  private readonly saveState = () => {
    this.container.dataset.savedState = JSON.stringify(this.state);
  };
}
