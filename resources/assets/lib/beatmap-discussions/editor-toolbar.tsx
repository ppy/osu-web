// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Portal } from 'components/portal';
import { throttle } from 'lodash';
import * as React from 'react';
import { Editor, Element, Node, Range } from 'slate';
import { ReactEditor } from 'slate-react';
import { nextVal } from 'utils/seq';
import { EditorToolbarButton } from './editor-toolbar-button';
import { SlateContext } from './slate-context';

const bn = 'beatmap-discussion-editor-toolbar';

export class EditorToolbar extends React.Component {
  static contextType = SlateContext;
  declare context: React.ContextType<typeof SlateContext>;
  private readonly eventId = `editor-toolbar-${nextVal()}`;
  private ref = React.createRef<HTMLDivElement>();
  private scrollContainer?: HTMLElement;
  private scrollTimer?: number;
  private readonly throttledUpdate = throttle(() => this.updatePosition(), 100);

  get selectionRange() {
    const {selection} = this.context;

    if (
      !selection ||
      !ReactEditor.isFocused(this.context) ||
      Range.isCollapsed(selection) ||
      Editor.string(this.context, selection) === ''
    ) {
      return null;
    }

    const domSelection = window.getSelection();
    return domSelection?.getRangeAt(0);
  }

  get visible() {
    return this.selectionRange != null;
  }

  componentDidMount() {
    $(window).on(`scroll.${this.eventId}`, this.throttledUpdate);
    this.updatePosition();
  }

  // updates cascade from our parent (slate editor), i.e. `componentDidUpdate` gets called on editor changes (typing/selection changes/etc)
  componentDidUpdate() {
    this.updatePosition();
  }

  componentWillUnmount() {
    $(window).off(`.${this.eventId}`);
    if (this.scrollContainer) {
      $(this.scrollContainer).off(`.${this.eventId}`);
    }
    this.throttledUpdate.cancel();
  }

  hide() {
    const tooltip = this.ref.current;

    if (tooltip) {
      tooltip.style.display = 'none';
    }
  }

  render() {
    if (!this.context || !this.visible) {
      return null;
    }

    return (
      <Portal>
        <div
          ref={this.ref}
          className={bn}
        >
          <EditorToolbarButton format='bold' />
          <EditorToolbarButton format='italic' />
          <div className={`${bn}__popup-tail`} />
        </div>
      </Portal>
    );
  }

  setScrollContainer(container: HTMLElement) {
    if (this.scrollContainer) {
      $(this.scrollContainer).off(`.${this.eventId}`);
    }
    this.scrollContainer = container;
    $(this.scrollContainer).on(`scroll.${this.eventId}`, this.throttledUpdate);
  }

  updatePosition() {
    const tooltip = this.ref.current;
    if (!tooltip || !this.context) {
      return;
    }

    if (this.scrollTimer) {
      window.clearTimeout(this.scrollTimer);
    }

    // we use setTimeout here as a workaround for incorrect bounds sometimes being returned for the selection range,
    // seemingly when called too soon after a scroll event
    this.scrollTimer = window.setTimeout(() => {
      const selectionRange = this.selectionRange;
      if (selectionRange == null) {
        return this.hide();
      }

      for (const p of Editor.positions(this.context, { at: this.context.selection ?? undefined, unit: 'block' })) {
        const block = Node.parent(this.context, p.path);

        if (Element.isElement(block) && block.type === 'embed') {
          return this.hide();
        }
      }

      const containerBounds = this.scrollContainer?.getBoundingClientRect();
      const containerTop = containerBounds?.top ?? 0;
      const containerBottom = containerBounds?.bottom;
      const selectionBounds = selectionRange.getBoundingClientRect();

      const outsideContainer =
        selectionBounds.top < containerTop ||
        (containerBottom && selectionBounds.top > containerBottom);

      if (outsideContainer) {
        return this.hide();
      } else {
        tooltip.style.display = 'block';
        tooltip.style.left = `${selectionBounds.left + ((window.pageXOffset - tooltip.offsetWidth) / 2) + (selectionBounds.width / 2)}px`;
        tooltip.style.top = `${selectionBounds.top - tooltip.clientHeight - 10}px`;
      }
    }, 10);
  }
}
