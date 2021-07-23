// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import { find } from 'lodash';
import core from 'osu-core-singleton';
import * as React from 'react';
import Timeout from 'timeout';
import { currentUrl as getCurrentUrl } from 'utils/turbolinks';

const osuCommon = {
  ajaxError: (xhr: JQuery.jqXHR) => {
    if (core.userLogin.showOnError(xhr)) return;
    if (core.userVerification.showOnError(xhr)) return;

    osuCommon.popup(osuCommon.xhrErrorMessage(xhr), 'danger');
  },
  bottomPage: () => osuCommon.bottomPageDistance() === 0,
  bottomPageDistance: () => {
    const body = document.documentElement ?? document.body.parentElement ?? document.body;
    return (body.scrollHeight - body.scrollTop) - body.clientHeight;
  },
  classWithModifiers: (className: string, modifiers?: string[]) => {
    let ret = className;

    if (modifiers != null) {
      modifiers.forEach((modifier) => {
        ret += ` ${className}--${modifier}`;
      });
    }

    return ret;
  },
  currentUserIsFriendsWith: (userId: number) => find(currentUser.friends, { target_id: userId }),
  diffColour: (difficultyRating?: string | null) => ({ '--diff': `var(--diff-${difficultyRating ?? 'default'})` } as React.CSSProperties),
  emitAjaxError: (element = document.body) => (xhr: JQuery.jqXHR, status: string, error: string) => $(element).trigger('ajax:error', [xhr, status, error]),
  groupColour: (group?: GroupJson) => ({ '--group-colour': group?.colour ?? 'initial' } as React.CSSProperties),
  isIos: /iPad|iPhone|iPod/.test(navigator.platform),
  parseJson<T = any>(id: string, remove = false) {
    const element = window.newBody?.querySelector(`#${id}`);

    if (element instanceof HTMLScriptElement) {
      const json: T = JSON.parse(element.text);

      if (remove) {
        element.remove();
      }

      return json;
    }
  },
  popup: (message: string, type = 'info') => {
    const popupContainer = $('#popup-container');
    const alert = $('.popup-clone').clone();

    const closeAlert = () => alert.click();

    alert.addClass(`alert-${type} popup-active`).removeClass('popup-clone');

    alert.find('.popup-text').html(message);

    if (['warning', 'danger'].includes(type)) {
      $('#overlay')
        .off('click.close-alert')
        .one('click.close-alert', closeAlert)
        .fadeIn();
    } else {
      Timeout.set(5000, closeAlert);
    }

    const activeElement = document.activeElement;

    if (activeElement instanceof HTMLElement) {
      activeElement.blur();
    }

    alert.appendTo(popupContainer).fadeIn();
  },
  presence: (str?: string | null) => osuCommon.present(str) ? str : null,
  present: (str?: string | null) => str != null && str !== '',
  setHash: (newHash: string) => {
    const currentUrl = getCurrentUrl().href;
    let newUrl = currentUrl.replace(/#.*/, '');
    newUrl += newHash;

    if (newUrl === currentUrl) {
      return;
    }

    history.replaceState(history.state, '', newUrl);
  },
  trans: (key: string, replacements = {}, locale?: string) => {
    if (osuCommon.transExists(key, locale)) {
      locale = fallbackLocale;
    }

    return Lang.get(key, replacements, locale);
  },
  transExists: (key: string, locale?: string) => {
    const translated = Lang.get(key, null, locale);

    return osuCommon.present(translated) && translated !== key;
  },
  urlRegex: /(https?:\/\/((?:(?:[a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.)*[a-z][a-z0-9-]*[a-z0-9](?::\d+)?)(?:(?:(?:\/+(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)*(?:\?(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?(?:#(?:[a-z0-9$_\.\+!\*',;:@&=/?-]|%[0-9a-f]{2})*)?)?(?:[^\.,:\s])))/ig,
  xhrErrorMessage: (xhr: JQuery.jqXHR) => {
    const validationMessage = xhr.responseJSON.validation_error;
    let message: string;

    if (validationMessage != null) {
      let allErrors: string[] = [];

      // FIXME: not sure about this conversion `for own` from coffeescript
      for (const field in validationMessage) {
        if (validationMessage.hasOwnProperty(field)) {
          const errors = validationMessage[field];
          allErrors = allErrors.concat(errors);
        }
      }

      message = `${allErrors.join(', ')}.`;
    }

    message ??= xhr.responseJSON.error;
    message ??= xhr.responseJSON.message;

    if (message == null || message === '') {
      const errorKey = `errors.codes.http-${xhr.status}`;
      message = osuCommon.trans(errorKey);

      if (message === errorKey) {
        message = osuCommon.trans('errors.unknown');
      }
    }

    return message;
  },
};
