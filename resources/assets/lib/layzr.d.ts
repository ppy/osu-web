// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// this is @types/layzr.js but with the export declaration fixed for layzr.module.js
declare module 'layzr' {
  type LayzrEvents = 'src:before' | 'src:after';

  interface LayzrInstance {
    /**
     * Manually check if elements are in the viewport. This method is called while the window is scrolled or resized.
     */
    check(): LayzrInstance;
    /**
     * Emit an event, firing all of its handlers.
     *
     * @param name Event name
     * @param args Arguments that will be passed to each handler
     */
    emit(name: LayzrEvents, ...args: any[]): LayzrInstance;
    /**
     * Add or remove the scroll and resize event handlers.
     *
     * @param flag
     */
    handlers(flag: boolean): LayzrInstance;
    /**
     * Remove a specific handler from an event.
     *
     * @param name Event name
     * @param handler Event handler
     */
    off(name: LayzrEvents, handler?: () => Record<string, never>): LayzrInstance;
    /**
     * This event is emitted immediately before/after an image source is set. The image node is passed to the event handler.
     *
     * @param name Event name
     * @param handler Event handler
     */
    on(
      name: LayzrEvents,
      handler: (element: HTMLElement) => void,
    ): LayzrInstance;
    /**
     * This event is emitted immediately before/after an image source is set. The image node is passed to the event handler. Fires once.
     *
     * @param name Event name
     * @param handler Event handler
     */
    once(
      name: LayzrEvents,
      handler: (element: HTMLElement) => void,
    ): LayzrInstance;
    /**
     * Update the elements Layzr is checking.
     */
    update(): LayzrInstance;
  }

  interface LayzrOptions {
    /**
     * Customize the attribute the normal resolution source is taken from.
     */
    normal?: string;
    /**
     * Customize the attribute the retina/high resolution source is taken from.
     */
    retina?: string;
    /**
     * Customize the attribute the source set is taken from.
     */
    srcset?: string;
    /**
     * Adjust when images load, relative to the viewport. Positive values make images load sooner, negative values make images load later.
     *
     * Threshold is a percentage of the viewport height, identical to the CSS vh unit.
     */
    threshold?: number;
  }

  export default function layzr(options?: LayzrOptions): LayzrInstance;
}
