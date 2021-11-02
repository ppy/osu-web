// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

export function formatNumberSuffixed(num?: number, precision?: number, options?: Intl.NumberFormatOptions) {
  if (num == null) return;

  const suffixes = ['', 'k', 'm', 'b', 't'];
  const k = 1000;

  const format = (n: number) => {
    options ??= {};

    if (precision != null) {
      options.minimumFractionDigits = precision;
      options.maximumFractionDigits = precision;
    }

    return n.toLocaleString('en', options);
  };

  if (num < k) return format(num);

  const i = Math.min(suffixes.length - 1, Math.floor(Math.log(num) / Math.log(k)));

  return `${format(num / Math.pow(k, i))}${suffixes[i]}`;
}

export const transparentGif = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';

export function make2x(url?: string) {
  if (url == null) return;

  return url.replace(/(\.[^.]+)$/, '@2x$1');
}

export function stripTags(str: string) {
  return str.replace(/<[^>]*>/g, '');
}
