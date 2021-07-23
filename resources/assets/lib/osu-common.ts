// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import { each, find, unescape } from 'lodash';
import core from 'osu-core-singleton';
import * as React from 'react';
import { TurbolinksAction } from 'turbolinks';
import { currentUrl as getCurrentUrl } from 'utils/turbolinks';

const osu = {
  ajaxError: (xhr: JQuery.jqXHR) => {
    if (core.userLogin.showOnError(xhr)) return;
    if (core.userVerification.showOnError(xhr)) return;

    osu.popup(osu.xhrErrorMessage(xhr), 'danger');
  },

  bottomPage: () => osu.bottomPageDistance() === 0,

  bottomPageDistance: () => {
    const body = document.documentElement ?? document.body.parentElement ?? document.body;
    return (body.scrollHeight - body.scrollTop) - body.clientHeight;
  },

  currentUserIsFriendsWith: (userId: number) => find(currentUser.friends, { target_id: userId }),

  diffColour: (difficultyRating?: string | null) => ({ '--diff': `var(--diff-${difficultyRating ?? 'default'})` } as React.CSSProperties),

  emitAjaxError: (element = document.body) => (xhr: JQuery.jqXHR, status: string, error: string) => $(element).trigger('ajax:error', [xhr, status, error]),

  // mobile safari zooms in on focus of input boxes with font-size < 16px, this works around that
  focus: (el: HTMLElement) => {
    el = $(el)[0]; // so we can handle both jquery'd and normal dom nodes

    if (!osu.isIos) {
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
    return `${osu.formatNumber(bytes / Math.pow(k, i), decimals)} ${suffixes[i]}`;
  },

  formatNumber: (num: number | null, precision?: number | null, options?: Intl.NumberFormatOptions | null, locale?: string) => {
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
    if (osu.isInputElement(el) || ['A', 'BUTTON'].includes(el.tagName)) {
      return true;
    }

    if (el.parentNode instanceof HTMLElement) {
      return osu.isClickable(el.parentNode);
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

  linkify: (text: string, newWindow = false) => text.replace(osu.urlRegex, `<a href="$1" rel="nofollow noreferrer"${newWindow ? ' target="_blank"' : ''}>$2</a>`),

  navigate: (url: string, keepScroll = false, action?: TurbolinksAction) => {
    action ??= { action: 'advance' };

    if (keepScroll) {
      osu.keepScrollOnLoad();
    }

    Turbolinks.visit(url, action);
  },

  parseJson<T = any>(id: string, remove = false) {
    const element = window.newBody?.querySelector(`#${id}`);

    if (element instanceof HTMLScriptElement) {
      const json: T = JSON.parse(element.text);

      if (remove) {
        element.remove();
      }

      return json;
    }

    return {} as T;
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
      window.setTimeout(closeAlert, 5000);
    }

    const activeElement = document.activeElement;

    if (activeElement instanceof HTMLElement) {
      activeElement.blur();
    }

    alert.appendTo(popupContainer).fadeIn();
  },

  popupShowing: () => $('#overlay').is(':visible'),

  presence: (str?: string | null) => osu.present(str) ? str : null,

  present: (str?: string | null) => str != null && str !== '',

  promisify: (xhr: JQuery.jqXHR): Promise<any> => new Promise((resolve, reject) => {
    xhr.done(resolve).fail(reject);
  }),

  reloadPage: (keepScroll = true) => {
    $(document).off('.ujsHideLoadingOverlay');
    Turbolinks.clearCache();

    const url = window.reloadUrl != null ? window.reloadUrl : getCurrentUrl().href;

    window.reloadUrl = null;

    osu.navigate(url, keepScroll, { action: 'replace' });
  },

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
    if (osu.transExists(key, locale)) {
      locale = fallbackLocale;
    }

    return Lang.get(key, replacements, locale);
  },

  transArray: (array: any[], key = 'common.array_and') => {
    switch (array.length) {
      case 0:
        return '';
      case 1:
        return String(array[0]);
      case 2:
        return array.join(osu.trans(`${key}.two_words_connector`));
      default:
        return `${array.slice(0, -1).join(osu.trans(`${key}.words_connector`))}${osu.trans(`${key}.last_word_connector`)}${String(array[array.length - 1])}`;
    }
  },

  transChoice: (key: string, count: number, replacements: Record<string, unknown> = {}, locale?: string): string => {
    locale ??= currentLocale;
    const isFallbackLocale = locale === fallbackLocale;

    if (!isFallbackLocale && !osu.transExists(key, locale)) {
      return osu.transChoice(key, count, replacements, fallbackLocale);
    }

    replacements.count_delimited = osu.formatNumber(count, null, null, locale);
    const translated = Lang.choice(key, count, replacements, locale);

    if (!isFallbackLocale && translated == null) {
      // added by Lang.choice
      delete replacements.count;

      return osu.transChoice(key, count, replacements, fallbackLocale);
    }

    return translated;
  },

  // Handles case where crowdin fills in untranslated key with empty string.
  transExists: (key: string, locale?: string) => {
    const translated = Lang.get(key, null, locale);

    return osu.present(translated) && translated !== key;
  },

  updateQueryString: (url: string | null, params: { [key: string]: string | null | undefined }) => {
    const docUrl = getCurrentUrl();
    const urlObj = new URL(url ?? docUrl.href, docUrl.origin);

    // FIXME: not sure about this conversion `for own` from coffeescript
    for (const key in params) {
      if (Object.prototype.hasOwnProperty.call(params, key)) {
        const value = params[key];

        if (value != null) {
          urlObj.searchParams.set(key, value);
        } else {
          urlObj.searchParams.delete(key);
        }
      }
    }

    return urlObj.href;
  },

  // Wrapping the string with quotes and escaping the used quotes inside
  // is sufficient. Use double quote as it's easy to figure out with
  // encodeURI (it doesn't escape single quote).
  urlPresence: (url?: string | null) => osu.present(url) ? `url("${String(url).replace(/"/g, '%22')}")` : undefined,

  urlRegex: /(https?:\/\/((?:(?:[a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.)*[a-z][a-z0-9-]*[a-z0-9](?::\d+)?)(?:(?:(?:\/+(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)*(?:\?(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?(?:#(?:[a-z0-9$_\.\+!\*',;:@&=/?-]|%[0-9a-f]{2})*)?)?(?:[^\.,:\s])))/ig,

  uuid: () => Turbolinks.uuid(), // no point rolling our own

  xhrErrorMessage: (xhr: JQuery.jqXHR) => {
    const validationMessage = xhr.responseJSON.validation_error;
    let message: string;

    if (validationMessage != null) {
      let allErrors: string[] = [];

      // FIXME: not sure about this conversion `for own` from coffeescript
      for (const field in validationMessage) {
        if (Object.prototype.hasOwnProperty.call(validationMessage, field)) {
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
      message = osu.trans(errorKey);

      if (message === errorKey) {
        message = osu.trans('errors.unknown');
      }
    }

    return message;
  },
};

declare global {
  interface Window {
    osu: typeof osu;
  }
}

window.osu = osu;

export default osu;
