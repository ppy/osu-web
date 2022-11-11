// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Modal } from 'components/modal';
import TimeWithTooltip from 'components/time-with-tooltip';
import { UserLink } from 'components/user-link';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as moment from 'moment';
import * as React from 'react';
import Controller from './controller';
import MetadataEditor from './metadata-editor';

interface Props {
  controller: Controller;
}

@observer
export default class Metadata extends React.PureComponent<Props> {
  @observable private isEditing = false;

  private get beatmapset() {
    return this.props.controller.beatmapset;
  }

  @computed
  private get nominators() {
    const ret: UserJson[] = [];
    const usersById = this.props.controller.usersById;
    for (const nomination of this.props.controller.beatmapset.current_nominations) {
      const user = usersById[nomination.user_id];
      if (user != null) {
        ret.push(user);
      }
    }

    return ret;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    const tags = this.beatmapset.tags.split(' ');
    const canEdit = this.beatmapset.current_user_attributes?.can_edit_metadata ?? false;
    const nominators = this.nominators;

    return (
      <div className='beatmapset-metadata u-fancy-scrollbar'>
        {this.isEditing && (
          <Modal onClose={this.toggleEditing} visible>
            <MetadataEditor controller={this.props.controller} onClose={this.toggleEditing} />
          </Modal>
        )}

        {this.beatmapset.source !== '' && (
          <>
            <div>
              {osu.trans('beatmapsets.show.info.source')}
            </div>
            <div className='beatmapset-metadata__value'>
              <a href={route('beatmapsets.index', { q: this.beatmapset.source })}>
                {this.beatmapset.source}
              </a>
            </div>
          </>
        )}

        <div>
          {osu.trans('beatmapsets.show.info.genre')}
        </div>
        <div className='beatmapset-metadata__value'>
          <a href={route('beatmapsets.index', { g: this.beatmapset.genre.id })}>
            {this.beatmapset.genre.name}
          </a>
        </div>

        <div className='beatmapset-metadata__spacer' />

        <div>
          {osu.trans('beatmapsets.show.info.language')}
        </div>
        <div className='beatmapset-metadata__value'>
          <a href={route('beatmapsets.index', { l: this.beatmapset.language.id })}>
            {this.beatmapset.language.name}
          </a>
        </div>

        {tags.length > 0 && (
          <>
            <div>
              {osu.trans('beatmapsets.show.info.tags')}
            </div>
            <div className='beatmapset-metadata__value beatmapset-metadata__value--tags'>
              {tags.map((tag, idx) => (
                <React.Fragment key={`${tag}-${idx}`}>
                  <a href={route('beatmapsets.index', { q: tag })}>
                    {tag}
                  </a>
                  {' '}
                </React.Fragment>
              ))}
            </div>
          </>
        )}

        <div className='beatmapset-metadata__spacer' />

        {nominators != null && nominators.length > 0 && (
          <>
            <div>
              {osu.trans('beatmapsets.show.info.nominators')}
            </div>
            <div className='beatmapset-metadata__value'>
              {nominators.map((nominator, idx) => (
                <React.Fragment key={nominator.id}>
                  <UserLink user={{ id: nominator.id, username: nominator.username }} />
                  {idx < nominators.length - 1 && (<span>, </span>)}
                </React.Fragment>
              ))}
            </div>
          </>
        )}

        {this.beatmapset.submitted_date != null && (
          <>
            <div>
              {osu.trans('beatmapsets.show.info.submitted')}
            </div>
            <div className='beatmapset-metadata__value'>
              {this.renderDate(this.beatmapset.submitted_date)}
            </div>
          </>
        )}

        {this.beatmapset.ranked > 0 && this.beatmapset.ranked_date != null ? (
          <>
            <div>
              {osu.trans(`beatmapsets.show.info.${this.beatmapset.status}`)}
            </div>
            <div className='beatmapset-metadata__value'>
              {this.renderDate(this.beatmapset.ranked_date)}
            </div>
          </>
        ) : (
          <>
            <div>
              {osu.trans('beatmapsets.show.info.updated')}
            </div>
            <div className='beatmapset-metadata__value'>
              {this.renderDate(this.beatmapset.last_updated)}
            </div>
          </>
        )}

        {canEdit && (
          <div className='beatmapset-metadata__edit-button'>
            <button
              className='btn-circle'
              onClick={this.toggleEditing}
              type='button'
            >
              <span className='btn-circle__content'>
                <i className='fas fa-pencil-alt' />
              </span>
            </button>
          </div>
        )}
      </div>
    );
  }

  private renderDate(dateTime: string) {
    return (
      <TimeWithTooltip
        dateTime={dateTime}
        relative={Math.abs(moment().diff(moment(dateTime), 'weeks')) < 4}
      />
    );
  }

  @action
  private readonly toggleEditing = () => {
    this.isEditing = !this.isEditing;
  };
}
