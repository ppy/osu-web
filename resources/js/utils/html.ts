// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { padStart } from 'lodash';
import { CSSProperties } from 'react';
import { urlPresence } from './css';

const byteSuffixes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
const kilo = 1000;
const numberSuffixes = ['', 'k', 'm', 'b', 't'];

export function bottomPage() {
  return bottomPageDistance() === 0;
}

export function bottomPageDistance() {
  const page = document.documentElement;

  return page.scrollHeight - page.scrollTop - page.clientHeight;
}

export function createClickCallback(target: unknown) {
  if (target instanceof HTMLElement) {
    // plain javascript here doesn't trigger submit events
    // which means jquery-ujs handler won't be triggered
    // reference: https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/submit
    if (target instanceof HTMLFormElement) {
      return () => $(target).submit();
    }

    // inversely, using jquery here won't actually click the thing
    // reference: https://github.com/jquery/jquery/blob/f5aa89af7029ae6b9203c2d3e551a8554a0b4b89/src/event.js#L586
    return () => target.click();
  }
}

export function cssVar2x(url?: string | null) {
  if (url == null) return;

  return {
    '--bg': urlPresence(url),
    '--bg-2x': urlPresence(make2x(url)),
  } as CSSProperties;
}

function padTimeComponent(time: number) {
  return padStart(time.toString(), 2, '0');
}

export function formatBytes(bytes: number, decimals = 2) {
  if (bytes < kilo) {
    return `${bytes} B`;
  }

  const i = Math.floor(Math.log(bytes) / Math.log(kilo));
  return `${formatNumber(bytes / Math.pow(kilo, i), decimals)} ${byteSuffixes[i]}`;
}

export function formatDuration(valueSecond: number) {
  const s = valueSecond % 60;
  const m = Math.floor(valueSecond / 60) % 60;
  const h = Math.floor(valueSecond / 3600);

  if (h > 0) {
    return `${h}:${padTimeComponent(m)}:${padTimeComponent(s)}`;
  }

  return `${m}:${padTimeComponent(s)}`;
}

const defaultNumberFormatter = new Intl.NumberFormat(window.currentLocale);

export function formatNumber(num: number, precision?: number, options?: Intl.NumberFormatOptions, locale?: string) {
  if (precision == null && options == null && locale == null) {
    return defaultNumberFormatter.format(num);
  }

  options ??= {};

  if (precision != null) {
    options.minimumFractionDigits = precision;
    options.maximumFractionDigits = precision;
  }

  return num.toLocaleString(locale ?? window.currentLocale, options);
}

export function formatNumberSuffixed(num?: number, precision?: number, options?: Intl.NumberFormatOptions) {
  if (num == null) return;

  const format = (n: number) => {
    options ??= {};

    if (precision != null) {
      options.minimumFractionDigits = precision;
      options.maximumFractionDigits = precision;
    }

    return n.toLocaleString('en', options);
  };

  if (num < kilo) return format(num);

  const i = Math.min(numberSuffixes.length - 1, Math.floor(Math.log(num) / Math.log(kilo)));

  return `${format(num / Math.pow(kilo, i))}${numberSuffixes[i]}`;
}

export function htmlElementOrNull(thing: unknown) {
  if (thing instanceof HTMLElement) {
    return thing;
  }

  return null;
}

export function isClickable(maybeEl: unknown): boolean {
  const el = htmlElementOrNull(maybeEl);

  if (el == null) {
    return false;
  }

  if (isInputElement(el) || ['A', 'BUTTON'].includes(el.tagName)) {
    return true;
  }

  const parentEl = htmlElementOrNull(el.parentNode);
  if (parentEl != null) {
    return isClickable(parentEl);
  }

  return false;
}

export function isInputElement(el: HTMLElement) {
  return ['INPUT', 'OPTION', 'SELECT', 'TEXTAREA'].includes(el.tagName) || el.isContentEditable;
}

export const transparentGif = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';

export function make2x(url?: string) {
  if (url == null) return;

  return url.replace(/(\.[^.]+)$/, '@2x$1');
}

export function setBrowserTitle(title: string) {
  document.title = `${title} | osu!`;
}

export function stripTags(str: string) {
  return str.replace(/<[^>]*>/g, '');
}
