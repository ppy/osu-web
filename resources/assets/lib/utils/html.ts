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
