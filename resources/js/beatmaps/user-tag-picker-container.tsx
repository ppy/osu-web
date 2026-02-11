// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action } from 'mobx';
import { observer } from 'mobx-react';
import React, { useCallback, useEffect, useRef } from 'react';
import core from '../osu-core-singleton';
import { classWithModifiers } from '../utils/css';
import UserTagPicker from './user-tag-picker';

let clickStartTarget: unknown;

const controller = core.beatmapTagPickerController;

const UserTagPickerContainer = observer(() => {
  const container = useRef<HTMLDivElement>(null);

  const togglePicker = action(() => controller.showPicker = !controller.showPicker);
  const closePicker = action(() => controller.showPicker = false);

  const onKeyDown = useCallback((e: KeyboardEvent) => {
    if (e.key !== 'Escape') {
      return;
    }

    closePicker();
  }, [closePicker]);

  const onDocumentMouseDown = useCallback((e: MouseEvent) => {
    clickStartTarget = e.target;
  }, []);

  const onDocumentClick = useCallback((e: MouseEvent) => {
    if (!controller.showPicker) {
      return;
    }

    if (e.button !== 0) {
      return;
    }

    if (
      clickStartTarget instanceof Element &&
      container.current != null &&
      clickStartTarget.closest('.user-tag-picker-button')
    ) {
      return;
    }

    closePicker();
  },  [closePicker]);

  useEffect(() => {
    document.addEventListener('keydown', onKeyDown);
    document.addEventListener('mousedown', onDocumentMouseDown);
    document.addEventListener('click', onDocumentClick);

    return () => {
      document.removeEventListener('keydown', onKeyDown);
      document.removeEventListener('mousedown', onDocumentMouseDown);
      document.removeEventListener('click', onDocumentClick);
    };
  }, [onKeyDown, onDocumentMouseDown, onDocumentClick]);

  return (
    <div ref={container} className='user-tag-picker-button'>
      <div
        className={classWithModifiers('beatmapsets-search__icon', { active: controller.showPicker, tags: true })}
        onClick={togglePicker}
        title='browse user tags'
      >
        <i className='fas fa-tag' />
      </div>
      {controller.showPicker && <div className='user-tag-picker-button__picker'>
        <UserTagPicker />
      </div>}
    </div>
  );
});

export default UserTagPickerContainer;
