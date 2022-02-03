// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import UserExtendedJson from 'interfaces/user-extended-json';
import { route } from 'laroute';
import { action } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { fileuploadFailCallback } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import Controller from './controller';
import CoverSelection from './cover-selection';

interface Props {
  controller: Controller;
  dropzoneRef: React.RefObject<HTMLDivElement>;
}

@observer
export default class CoverUploader extends React.Component<Props> {
  private readonly uploadButtonContainer = React.createRef<HTMLLabelElement>();

  private get $uploadButton() {
    return $(this.uploadButtonContainer.current ?? {}).find('.js-profile-cover-upload');
  }

  destroy() {
    this.$uploadButton.fileupload('destroy').remove();
  }

  render() {
    return (
      <div className='profile-cover-uploader'>
        <CoverSelection
          controller={this.props.controller}
          isSelected={this.props.controller.state.user.cover.id == null}
          modifiers='custom'
          name='-1'
          thumbUrl={this.props.controller.state.user.cover.custom_url}
          url={this.props.controller.state.user.cover.custom_url}
        />

        <div className='profile-cover-uploader__button'>
          <label
            ref={this.uploadButtonContainer}
            className={classWithModifiers(
              'btn-osu-big',
              ['fileupload', 'full', 'rounded'],
              { disabled: !this.props.controller.canUploadCover },
            )}
          >
            {osu.trans('users.show.edit.cover.upload.button')}
          </label>
        </div>

        <div className='profile-cover-uploader__info'>
          <p className='profile-cover-uploader__info-entry'>
            <strong>
              <StringWithComponent
                mappings={{
                  link: (
                    <a
                      href={route('store.products.show', { product: 'supporter-tag' })}
                      rel="noreferrer"
                      target='_blank'
                    >
                      {osu.trans('users.show.edit.cover.upload.restriction_info.link')}
                    </a>
                  ),
                }}
                pattern={osu.trans('users.show.edit.cover.upload.restriction_info._')}
              />
            </strong>
          </p>

          <p className='profile-cover-uploader__info-entry'>
            {osu.trans('users.show.edit.cover.upload.dropzone_info')}
          </p>

          <p className='profile-cover-uploader__info-entry'>
            {osu.trans('users.show.edit.cover.upload.size_info')}
          </p>
        </div>
      </div>
    );
  }

  setup() {
    if (this.uploadButtonContainer.current == null) {
      throw new Error("can't setup before mounting");
    }

    const $uploadButton = $('<input>', {
      class: 'js-profile-cover-upload fileupload',
      // this ignores any updates to the passed attribute although technically
      // should never happen.
      disabled: !this.props.controller.canUploadCover,
      name: 'cover_file',
      type: 'file',
    });

    this.uploadButtonContainer.current.appendChild($uploadButton[0]);

    $uploadButton.fileupload({
      always: action(() => {
        this.props.controller.isUpdatingCover = false;
      }),
      dataType: 'json',
      done: action((e: unknown, data: { result: UserExtendedJson }) => {
        this.props.controller.setCover(data.result.cover);
      }),
      dropZone: this.props.dropzoneRef.current ?? undefined,
      fail: fileuploadFailCallback,
      submit: action(() => {
        this.props.controller.isUpdatingCover = true;
        $.publish('dragendGlobal');
      }),
      url: route('account.cover'),
    });
  }
}
