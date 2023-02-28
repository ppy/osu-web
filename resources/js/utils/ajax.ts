// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import { createClickCallback } from 'utils/html';
import { trans } from 'utils/lang';
import { popup } from './popup';
import { present } from './string';

interface UnknownErrorJson {
  error?: string;
  message?: string;
  validation_error?: Record<string, string>[];
}

const jqXHRProperties = ['status', 'statusText', 'readyState', 'responseText'];

export function emitError(element: HTMLElement = document.body) {
  return (xhr: JQuery.jqXHR, status: string, errorThrown: unknown) => $(element).trigger('ajax:error', [xhr, status, errorThrown]);
}

export const error = (xhr: JQuery.jqXHR, status: string, callback?: () => void) => {
  if (status === 'abort') return;
  if (core.userLogin.showOnError(xhr, callback)) return;
  if (core.userVerification.showOnError(xhr, callback)) return;

  popup(xhrErrorMessage(xhr), 'danger');
};

export const fileuploadFailCallback = (event: unknown, data: JQueryFileUploadDone) => {
  error(data.jqXHR, data.textStatus, () => data.submit?.());
};

export function isJqXHR(obj: unknown): obj is JQuery.jqXHR {
  return typeof obj === 'object'
    && obj != null
    && jqXHRProperties.every((value) => value in obj);
}

export const onError = (xhr: JQuery.jqXHR) => error(xhr, xhr.statusText);

export const onErrorWithCallback = (callback?: () => void) => (xhr: JQuery.jqXHR, status: string) => {
  error(xhr, status, callback);
};

export const onErrorWithClick = (target: unknown) => onErrorWithCallback(createClickCallback(target));

export function xhrErrorMessage(xhr?: JQuery.jqXHR) {
  if (xhr == null || xhr.responseJSON == null) {
    return trans('errors.unknown');
  }

  const json = xhr.responseJSON as UnknownErrorJson;
  if (json.validation_error != null) {
    return `${Object.values(json.validation_error).flat().join(', ')}.`;
  }

  let message = json.error ?? json.message ?? '';
  if (!present(message)) {
    const errorKey = `errors.codes.http-${xhr.status}`;
    message = trans(errorKey);
    if (message === errorKey) {
      message = trans('errors.unknown');
    }
  }

  return message;
}
