// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MetadataEditor from 'beatmapsets-show/metadata-editor';
import BbcodeEditor, { OnChangeProps } from 'components/bbcode-editor';
import { Modal } from 'components/modal';
import { BeatmapsetJsonForShow } from 'interfaces/beatmapset-extended-json';
import { route } from 'laroute';
import { round, sum } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithClick } from 'utils/ajax';
import { formatNumber } from 'utils/html';

interface Props {
  beatmap: BeatmapsetJsonForShow['beatmaps'][number];
  beatmapset: BeatmapsetJsonForShow;
}

@observer
export default class Info extends React.Component<Props> {
  @observable private isBusy = false;
  @observable private isEditingDescription = false;
  @observable private isEditingMetadata = false;

  @computed
  private get failData() {
    if (this.props.beatmap.failtimes.exit.length !== this.props.beatmap.failtimes.fail.length) {
      throw new Error('invalid failtimes data (different length)');
    }

    const fails = this.props.beatmap.failtimes.exit.map((exitValue, i) => [
      exitValue,
      this.props.beatmap.failtimes.fail[i],
    ]);

    return {
      fails,
      maxValue: Math.max(1, Math.max(...fails.map(sum))),
    };
  }

  private get withEditDescription() {
    return this.props.beatmapset.description.bbcode != null;
  }

  private get withEditMetadata() {
    return this.props.beatmapset.current_user_attributes?.can_edit_metadata ?? false;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    const tags = this.props.beatmapset.tags
      .split(' ')
      .filter(osu.present)
      .slice(0, 21);

    const tagsOverload = tags.length === 21;

    if (tagsOverload) {
      tags.pop();
    }

    return (
      <div className='beatmapset-info'>
        {this.isEditingDescription &&
          <Modal onClose={this.handleCloseDescriptionEditor} visible>
            <div className='osu-page'>
              <BbcodeEditor
                key={this.props.beatmapset.id /* ensure component is reset if beatmapset changes */}
                disabled={this.isBusy}
                modifiers='beatmapset-description-editor'
                onChange={this.handleEditorChange}
                rawValue={this.props.beatmapset.description.bbcode ?? ''}
              />
            </div>
          </Modal>
        }

        {this.isEditingMetadata &&
          <Modal onClose={this.handleCloseMetadataEditor} visible>
            <MetadataEditor beatmapset={this.props.beatmapset} onClose={this.handleCloseMetadataEditor} />
          </Modal>
        }

        <div className='beatmapset-info__box beatmapset-info__box--description'>
          {this.withEditDescription && this.renderEditDescriptionButton()}

          <h3 className='beatmapset-info__header'>
            {osu.trans('beatmapsets.show.info.description')}
          </h3>

          <div className='beatmapset-info__description-container u-fancy-scrollbar'>
            <div
              className='beatmapset-info__description'
              dangerouslySetInnerHTML={{
                __html: this.props.beatmapset.description.description ?? '',
              }}
            />
          </div>
        </div>

        <div className='beatmapset-info__box beatmapset-info__box--meta'>
          {this.withEditMetadata && this.renderEditMetadataButton()}

          {osu.present(this.props.beatmapset.source) &&
            <>
              <h3 className='beatmapset-info__header'>
                {osu.trans('beatmapsets.show.info.source')}
              </h3>
              <a
                className='beatmapset-info__link'
                href={route('beatmapsets.index', { q: this.props.beatmapset.source })}
              >
                {this.props.beatmapset.source}
              </a>
            </>
          }

          <div className='beatmapset-info__half-box'>
            <div className='beatmapset-info__half-entry'>
              <h3 className='beatmapset-info__header'>
                {osu.trans('beatmapsets.show.info.genre')}
              </h3>
              <a
                className='beatmapset-info__link'
                href={route('beatmapsets.index', { g: this.props.beatmapset.genre.id })}
              >
                {this.props.beatmapset.genre.name}
              </a>
            </div>

            <div className='beatmapset-info__half-entry'>
              <h3 className='beatmapset-info__header'>
                {osu.trans('beatmapsets.show.info.language')}
              </h3>
              <a
                className='beatmapset-info__link'
                href={route('beatmapsets.index', { l: this.props.beatmapset.language.id })}
              >
                {this.props.beatmapset.language.name}
              </a>
            </div>
          </div>

          {tags.length > 0 &&
            <>
              <h3 className='beatmapset-info__header'>
                {osu.trans('beatmapsets.show.info.tags')}
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
    if (this.props.beatmap.playcount === 0) {
      return (
        <div className='beatmap-success-rate'>
          <div className='beatmap-success-rate__empty'>
            {osu.trans('beatmapsets.show.info.no_scores')}
          </div>
        </div>
      );
    }

    const percentage = round((this.props.beatmap.passcount / this.props.beatmap.playcount) * 100, 1);

    return (
      <div className='beatmap-success-rate'>
        <h3 className='beatmap-success-rate__header'>
          {osu.trans('beatmapsets.show.info.success-rate')}
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
          title={`${formatNumber(this.props.beatmap.passcount)} / ${formatNumber(this.props.beatmap.playcount)}`}
        >
          {`${percentage}%`}
        </div>

        <h3 className='beatmap-success-rate__header'>
          {osu.trans('beatmapsets.show.info.points-of-failure')}
        </h3>

        <div className='beatmap-success-rate__chart'>
          {this.renderFailChart()}
        </div>
      </div>
    );
  }

  @action
  private saveDescription({ event, value }: OnChangeProps) {
    this.isBusy = true;

    $.ajax(route('beatmapsets.update', { beatmapset: this.props.beatmapset.id }), {
      data: {
        description: value,
      },
      method: 'PATCH',
    }).done(action((beatmapset: BeatmapsetJsonForShow) => {
      this.isEditingDescription = false;
      $.publish('beatmapset:set', { beatmapset });
    })).fail(
      onErrorWithClick(event?.target),
    ).always(action(() => {
      this.isBusy = false;
    }));
  }
}
