// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import { createClickCallback } from 'utils/html';

export const error = (xhr: JQuery.jqXHR, status: string, callback?: () => void) => {
  if (status === 'abort') return;
  if (core.userLogin.showOnError(xhr, callback)) return;
  if (core.userVerification.showOnError(xhr, callback)) return;

  osu.popup(osu.xhrErrorMessage(xhr), 'danger');
};

export const fileuploadFailCallback = (event: unknown, data: JQueryFileUploadDone) => {
  error(data.jqXHR, data.textStatus, () => data.submit?.());
};

export const onErrorWithCallback = (callback?: () => void) => (xhr: JQuery.jqXHR, status: string) => {
  error(xhr, status, callback);
};

export const onErrorWithClick = (target: unknown) => onErrorWithCallback(createClickCallback(target));
