// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import { each, find, unescape } from 'lodash';
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
  // mobile safari zooms in on focus of input boxes with font-size < 16px, this works around that
  focus: (el: HTMLElement) => {
    el = $(el)[0]; // so we can handle both jquery'd and normal dom nodes

    if (!osuCommon.isIos) {
      return el.focus();
    }

    const prevSize = el.style.fontSize;
    el.style.fontSize = '16px';
    el.focus();
    el.style.fontSize = prevSize;
  },
  formatBytes: (bytes: number, decimals = 2) => {
    const suffixes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const k = 1000;

    if (bytes < k) {
      return `${bytes} B`;
    }

    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return `${osuCommon.formatNumber(bytes / Math.pow(k, i), decimals)} ${suffixes[i]}`;
  },
  formatNumber: (num: number | null, precision?: number, options?: Intl.NumberFormatOptions, locale?: string) => {
    if (num == null) {
      return null;
    }

    options ??= {};

    if (precision != null) {
      options.minimumFractionDigits = precision;
      options.maximumFractionDigits = precision;
    }

    return num.toLocaleString(locale ?? currentLocale, options);
  },
  groupColour: (group?: GroupJson) => ({ '--group-colour': group?.colour ?? 'initial' } as React.CSSProperties),
  isClickable: (el: HTMLElement): boolean => {
    if (osuCommon.isInputElement(el) || ['A', 'BUTTON'].includes(el.tagName)) {
      return true;
    }

    if (el.parentNode instanceof HTMLElement) {
      return osuCommon.isClickable(el.parentNode);
    }

    return false;
  },
  isInputElement: (el: HTMLElement) => ['INPUT', 'SELECT', 'TEXTAREA'].includes(el.tagName) || el.isContentEditable,
  isIos: /iPad|iPhone|iPod/.test(navigator.platform),
  // make a clone of json-like object (object with simple values)
  jsonClone: (obj: any) => JSON.parse(JSON.stringify(obj ?? null)),
  keepScrollOnLoad: () => {
    const position = [
      window.pageXOffset,
      window.pageYOffset,
    ];

    $(document).one('turbolinks:load', () => {
      window.scrollTo(position[0], position[1]);
    });
  },
  link: (url: string, text: string, options: OsuLinkOptions = {}) => {
    if (options.unescape) {
      url = unescape(url);
      text = unescape(text);
    }

    const el = document.createElement('a');
    el.setAttribute('href', url);
    el.setAttribute('data-remote', options.isRemote ? 'true' : '');
    el.className = options.classNames != null ? options.classNames.join(' ') : '';
    el.textContent = text;

    if (options.props != null) {
      each(options.props, (val, prop) => {
        el.setAttribute(prop, val ?? '');
      });
    }

    return el.outerHTML;
  },
  linkify: (text: string, newWindow = false) => text.replace(osuCommon.urlRegex, `<a href="$1" rel="nofollow noreferrer"${newWindow ? ' target="blank"' : ''}>$2</a>`),
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
  storeJson: (id: string, object: Record<string, unknown>) => {
    const json = JSON.stringify(object);
    let element = document.getElementById(id) as (HTMLScriptElement | null);

    if (element == null) {
      element = document.createElement('script');
      element.id = id;
      element.type = 'application/json';
      document.body.appendChild(element);
    }

    element.text = json;
  },
  timeago: (time = '') => {
    const el = document.createElement('time');

    el.classList.add('js-timeago');
    el.setAttribute('datetime', time);
    el.textContent = time;

    return el.outerHTML;
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
