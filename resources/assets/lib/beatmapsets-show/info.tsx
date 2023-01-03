// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BbcodeEditor, { OnChangeProps } from 'components/bbcode-editor';
import Modal from 'components/modal';
import { UserLink } from 'components/user-link';
import { BeatmapsetJsonForShow } from 'interfaces/beatmapset-extended-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { round, sum } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithClick } from 'utils/ajax';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { present } from 'utils/string';
import Controller from './controller';
import MetadataEditor from './metadata-editor';

interface Props {
  controller: Controller;
}

@observer
export default class Info extends React.Component<Props> {
  @observable private isEditingDescription = false;
  @observable private isEditingMetadata = false;
  @observable private saveDescriptionXhr: JQuery.jqXHR<BeatmapsetJsonForShow> | null = null;

  private get controller() {
    return this.props.controller;
  }

  @computed
  private get failData() {
    if (this.controller.currentBeatmap.failtimes.exit.length !== this.controller.currentBeatmap.failtimes.fail.length) {
      throw new Error('invalid failtimes data (different length)');
    }

    const fails = this.controller.currentBeatmap.failtimes.exit.map((exitValue, i) => [
      exitValue,
      this.controller.currentBeatmap.failtimes.fail[i],
    ]);

    return {
      fails,
      maxValue: Math.max(1, Math.max(...fails.map(sum))),
    };
  }

  @computed
  private get nominators() {
    const ret: UserJson[] = [];
    const usersById = this.controller.usersById;
    for (const nomination of this.controller.beatmapset.current_nominations) {
      const user = usersById[nomination.user_id];
      if (user != null) {
        ret.push(user);
      }
    }

    return ret;
  }

  private get withEditDescription() {
    return this.controller.beatmapset.description.bbcode != null;
  }

  private get withEditMetadata() {
    return this.controller.beatmapset.current_user_attributes?.can_edit_metadata ?? false;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    this.saveDescriptionXhr?.abort();
  }

  render() {
    const tags = this.controller.beatmapset.tags
      .split(' ')
      .filter(present)
      .slice(0, 21);

    const tagsOverload = tags.length === 21;

    if (tagsOverload) {
      tags.pop();
    }

    return (
      <div className='beatmapset-info'>
        {this.isEditingDescription &&
          <Modal onClose={this.handleCloseDescriptionEditor}>
            <div className='osu-page'>
              <BbcodeEditor
                key={this.controller.beatmapset.id /* ensure component is reset if beatmapset changes */}
                disabled={this.saveDescriptionXhr != null}
                modifiers='beatmapset-description-editor'
                onChange={this.handleEditorChange}
                rawValue={this.controller.beatmapset.description.bbcode ?? ''}
              />
            </div>
          </Modal>
        }

        {this.isEditingMetadata &&
          <Modal onClose={this.handleCloseMetadataEditor}>
            <MetadataEditor controller={this.props.controller} onClose={this.handleCloseMetadataEditor} />
          </Modal>
        }

        <div className='beatmapset-info__box beatmapset-info__box--description'>
          {this.withEditDescription && this.renderEditDescriptionButton()}

          <h3 className='beatmapset-info__header'>
            {trans('beatmapsets.show.info.description')}
          </h3>

          <div className='beatmapset-info__description-container u-fancy-scrollbar'>
            <div
              className='beatmapset-info__description'
              dangerouslySetInnerHTML={{
                __html: this.controller.beatmapset.description.description ?? '',
              }}
            />
          </div>
        </div>

        <div className='beatmapset-info__box beatmapset-info__box--meta'>
          {this.withEditMetadata && this.renderEditMetadataButton()}

          {this.nominators.length > 0 &&
            <>
              <h3 className='beatmapset-info__header'>
                {trans('beatmapsets.show.info.nominators')}
              </h3>
              <div>
                {this.nominators.map((user, i) => (
                  <React.Fragment key={user.id}>
                    <UserLink
                      className='beatmapset-info__link'
                      user={user}
                    />
                    {i < this.nominators.length - 1 && ', '}
                  </React.Fragment>
                ))}
              </div>
            </>
          }

          {present(this.controller.beatmapset.source) &&
            <>
              <h3 className='beatmapset-info__header'>
                {trans('beatmapsets.show.info.source')}
              </h3>
              <a
                className='beatmapset-info__link'
                href={route('beatmapsets.index', { q: this.controller.beatmapset.source })}
              >
                {this.controller.beatmapset.source}
              </a>
            </>
          }

          <div className='beatmapset-info__half-box'>
            <div className='beatmapset-info__half-entry'>
              <h3 className='beatmapset-info__header'>
                {trans('beatmapsets.show.info.genre')}
              </h3>
              <a
                className='beatmapset-info__link'
                href={route('beatmapsets.index', { g: this.controller.beatmapset.genre.id })}
              >
                {this.controller.beatmapset.genre.name}
              </a>
            </div>

            <div className='beatmapset-info__half-entry'>
              <h3 className='beatmapset-info__header'>
                {trans('beatmapsets.show.info.language')}
              </h3>
              <a
                className='beatmapset-info__link'
                href={route('beatmapsets.index', { l: this.controller.beatmapset.language.id })}
              >
                {this.controller.beatmapset.language.name}
              </a>
            </div>
          </div>

          {tags.length > 0 &&
            <>
              <h3 className='beatmapset-info__header'>
                {trans('beatmapsets.show.info.tags')}
              </h3>
              <div>
                {tags.map((tag, i) => (
                  <React.Fragment key={`${tag}-${i}`}>
                    <a
                      className='beatmapset-info__link'
                      href={route('beatmapsets.index', { q: tag })}
                    >
                      {tag}
                    </a>
                    {' '}
                  </React.Fragment>
                ))}
                {tagsOverload && '...'}
              </div>
            </>
          }
        </div>

        <div className='beatmapset-info__box beatmapset-info__box--success-rate'>
          {this.renderPlaycountInfo()}
        </div>
      </div>
    );
  }

  @action
  private readonly handleCloseDescriptionEditor = () => {
    this.isEditingDescription = false;
  };

  @action
  private readonly handleCloseMetadataEditor = () => {
    this.isEditingMetadata = false;
  };

  @action
  private readonly handleEditorChange = (change: OnChangeProps) => {
    switch (change.type) {
      case 'cancel':
        this.isEditingDescription = false;
        break;
      case 'save':
        if (change.hasChanged) {
          this.saveDescription(change);
        } else {
          this.isEditingDescription = false;
        }
        break;
    }
  };

  @action
  private readonly onEditDescriptionClick = () => {
    this.isEditingDescription = !this.isEditingDescription;
  };

  @action
  private readonly onEditMetadataClick = () => {
    this.isEditingMetadata = !this.isEditingMetadata;
  };

  private renderEditDescriptionButton() {
    return (
      <div className='beatmapset-info__edit-button'>
        <button
          className='btn-circle'
          onClick={this.onEditDescriptionClick}
          type='button'
        >
          <span className='btn-circle__content'>
            <span className='fas fa-pencil-alt' />
          </span>
        </button>
      </div>
    );
  }

  private renderEditMetadataButton() {
    return (
      <div className='beatmapset-info__edit-button'>
        <button
          className='btn-circle'
          onClick={this.onEditMetadataClick}
          type='button'
        >
          <span className='btn-circle__content'>
            <span className='fas fa-pencil-alt' />
          </span>
        </button>
      </div>
    );
  }

  private renderFailChart() {
    const { fails, maxValue } = this.failData;

    return (
      <div className='stacked-bar-chart stacked-bar-chart--beatmap-fail-rate'>
        {fails.map((f, i) => (
          <div key={i} className='stacked-bar-chart__col'>
            {f.map((value, j) => (
              <div
                key={j}
                className={`stacked-bar-chart__entry stacked-bar-chart__entry--${j}`}
                style={{
                  height: `${100 * value / maxValue}%`,
                }}
              />
            ))}
          </div>
        ))}
      </div>
    );
  }

  private renderPlaycountInfo() {
    if (this.controller.currentBeatmap.playcount === 0) {
      return (
        <div className='beatmap-success-rate'>
          <div className='beatmap-success-rate__empty'>
            {trans('beatmapsets.show.info.no_scores')}
          </div>
        </div>
      );
    }

    const percentage = round((this.controller.currentBeatmap.passcount / this.controller.currentBeatmap.playcount) * 100, 1);

    return (
      <div className='beatmap-success-rate'>
        <h3 className='beatmap-success-rate__header'>
          {trans('beatmapsets.show.info.success-rate')}
        </h3>

        <div className='bar bar--beatmap-success-rate'>
          <div
            className='bar__fill'
            style={{
              width: `${percentage}%`,
            }}
          />
        </div>

        <div
          className='beatmap-success-rate__percentage'
          data-tooltip-position='bottom center'
          style={{
            marginLeft: `${percentage}%`,
          }}
          title={`${formatNumber(this.controller.currentBeatmap.passcount)} / ${formatNumber(this.controller.currentBeatmap.playcount)}`}
        >
          {`${percentage}%`}
        </div>

        <h3 className='beatmap-success-rate__header'>
          {trans('beatmapsets.show.info.points-of-failure')}
        </h3>

        <div className='beatmap-success-rate__chart'>
          {this.renderFailChart()}
        </div>
      </div>
    );
  }

  @action
  private saveDescription({ event, value }: OnChangeProps) {
    if (this.saveDescriptionXhr != null) return;

    this.saveDescriptionXhr = $.ajax(route('beatmapsets.update', { beatmapset: this.controller.beatmapset.id }), {
      data: { description: value },
      method: 'PATCH',
    });

    this.saveDescriptionXhr.done((beatmapset) => runInAction(() => {
      this.isEditingDescription = false;
      this.controller.state.beatmapset = beatmapset;
    })).fail(
      onErrorWithClick(event?.target),
    ).always(action(() => {
      this.saveDescriptionXhr = null;
    }));
  }
}
