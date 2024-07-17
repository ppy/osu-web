// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, observable, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { nextVal } from 'utils/seq';
import Controller from './controller';
import CoverSelection from './cover-selection';
import CoverUploader from './cover-uploader';

type DropOverlayState = 'hover' | undefined;
type DropOverlayVisibility = 'hidden' | undefined;

interface Props {
  controller: Controller;
}

@observer
export default class CoverSelector extends React.Component<Props> {
  @observable private dropOverlayState: DropOverlayState;
  @observable private dropOverlayVisibility: DropOverlayVisibility = 'hidden';
  private readonly dropzoneRef = React.createRef<HTMLDivElement>();
  private readonly eventId = `users-show-cover-selector-${nextVal()}`;
  private readonly uploaderRef = React.createRef<CoverUploader>();

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    this.uploaderRef.current?.setup();
    $.subscribe(`dragenterGlobal.${this.eventId}`, this.dropOverlayStart);
    $.subscribe(`dragendGlobal.${this.eventId}`, this.dropOverlayEnd);
  }

  componentWillUnmount() {
    this.uploaderRef.current?.destroy();
    $.unsubscribe(`.${this.eventId}`);
    this.props.controller.setDisplayCoverUrl(null);
  }

  render() {
    const holdoverCoverPreset = this.props.controller.holdoverCoverPreset;

    return (
      <div ref={this.dropzoneRef} className='profile-cover-change-popup'>
        <h2 className='title title--profile-edit-popup'>
          {trans('users.show.edit.cover.title')}
        </h2>
        <div className='profile-cover-change-popup__defaults'>
          {this.props.controller.userCoverPresets.map((preset) =>
            (<CoverSelection
              key={preset.id}
              controller={this.props.controller}
              preset={preset}
            />),
          )}
          {holdoverCoverPreset != null &&
            <CoverSelection
              controller={this.props.controller}
              preset={holdoverCoverPreset}
            />
          }
          <p className='profile-cover-change-popup__selections-info'>
            {trans('users.show.edit.cover.defaults_info')}
          </p>
        </div>
        <CoverUploader
          ref={this.uploaderRef}
          controller={this.props.controller}
          dropzoneRef={this.dropzoneRef}
        />
        {this.props.controller.canUploadCover &&
          <div
            className={classWithModifiers('profile-cover-change-popup__drop-overlay', this.dropOverlayState)}
            data-visibility={this.dropOverlayVisibility}
            onDragEnter={this.dropOverlayEnter}
            onDragLeave={this.dropOverlayLeave}
          >
            {trans('users.show.edit.cover.upload.dropzone')}
          </div>
        }
      </div>
    );
  }

  @action
  private readonly dropOverlayEnd = () => {
    this.dropOverlayVisibility = 'hidden';
  };

  @action
  private readonly dropOverlayEnter = () => {
    this.dropOverlayState = 'hover';
  };

  @action
  private readonly dropOverlayLeave = () => {
    this.dropOverlayState = undefined;
  };

  @action
  private readonly dropOverlayStart = () => {
    this.dropOverlayVisibility = undefined;
  };
}
