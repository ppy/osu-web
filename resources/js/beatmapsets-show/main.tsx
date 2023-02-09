// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Comments } from 'components/comments';
import { CommentsManager } from 'components/comments-manager';
import HeaderV4 from 'components/header-v4';
import NotificationBanner from 'components/notification-banner';
import PlaymodeTabs from 'components/playmode-tabs';
import GameMode, { gameModes } from 'interfaces/game-mode';
import { action, autorun, computed, IReactionDisposer, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { generate, setHash } from 'utils/beatmapset-page-hash';
import { trans } from 'utils/lang';
import Controller from './controller';
import Header from './header';
import headerLinks from './header-links';
import Hype from './hype';
import Info from './info';
import NsfwWarning from './nsfw-warning';
import ScoreboardMain from './scoreboard/main';

interface Props {
  container: HTMLElement;
}

@observer
export default class Main extends React.Component<Props> {
  @observable private controller: Controller;
  private setHashDisposer?: IReactionDisposer;

  @computed
  private get headerLinksAppend() {
    if (this.controller.state.showingNsfwWarning) return null;

    const entries = gameModes.map((ruleset) => {
      const beatmaps = this.controller.beatmaps.get(ruleset) ?? [];
      const mainCount = beatmaps.filter((b) => !b.convert).length;

      return {
        count: mainCount > 0 ? mainCount : undefined,
        disabled: beatmaps.length === 0,
        href: generate({ ruleset }),
        mode: ruleset,
      };
    });

    return (
      <PlaymodeTabs
        currentMode={this.controller.currentBeatmap.mode}
        entries={entries}
        modifiers='beatmapset'
        onClick={this.onClickPlaymode}
      />
    );
  }

  constructor(props: Props) {
    super(props);

    this.controller = new Controller(this.props.container);

    makeObservable(this);
  }

  componentDidMount() {
    this.setHashDisposer = autorun(this.setHash);
    $(document).one('turbolinks:before-cache', () => this.setHashDisposer?.());
  }

  componentWillUnmount() {
    this.setHashDisposer?.();
    this.controller.destroy();
  }

  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        {this.renderDeletedNotification()}
        {this.renderPageHeader()}
        {this.controller.state.showingNsfwWarning
          ? <NsfwWarning onClose={this.onCloseNsfwWarning} />
          : this.renderPage()
        }
      </div>
    );
  }

  @action
  private readonly onClickPlaymode = (e: React.MouseEvent, mode: GameMode) => {
    e.preventDefault();

    this.controller.state.playmode = mode;
  };

  @action
  private readonly onCloseNsfwWarning = () => {
    this.controller.state.showingNsfwWarning = false;
  };

  private renderDeletedNotification() {
    if (this.controller.beatmapset.deleted_at == null) {
      return;
    }

    return (
      <NotificationBanner
        message={trans('beatmapsets.show.deleted_banner.message')}
        title={trans('beatmapsets.show.deleted_banner.title')}
        type='info'
      />
    );
  }

  private renderPage() {
    return (
      <>
        <div className='osu-page osu-page--generic-compact'>
          <Header controller={this.controller} />
          <Info controller={this.controller} />

          <div className='user-profile-pages user-profile-pages--no-tabs'>
            {this.controller.beatmapset.can_be_hyped &&
              <div className='page-extra page-extra--compact'>
                <Hype beatmapset={this.controller.beatmapset} />
              </div>
            }

            {this.controller.currentBeatmap.is_scoreable &&
              <div className='page-extra'>
                <ScoreboardMain
                  beatmap={this.controller.currentBeatmap}
                  container={this.props.container}
                />
              </div>
            }

            <div className='page-extra page-extra--compact'>
              <CommentsManager
                commentableId={this.controller.beatmapset.id}
                commentableType='beatmapset'
                component={Comments}
                componentProps={{
                  modifiers: 'page-extra',
                }}
              />
            </div>
          </div>
        </div>
      </>
    );
  }

  private renderPageHeader() {
    return (
      <HeaderV4
        links={headerLinks('show', this.controller.beatmapset)}
        linksAppend={this.headerLinksAppend}
        theme='beatmapset'
      />
    );
  }

  private readonly setHash = () => {
    setHash(generate({ beatmap: this.controller.currentBeatmap }));
  };
}
