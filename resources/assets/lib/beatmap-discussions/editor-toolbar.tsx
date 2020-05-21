// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as _ from 'lodash';
import { Portal } from 'portal';
import * as React from 'react';
import { Editor, Range } from 'slate';
import { ReactEditor } from 'slate-react';
import { isFormatActive, toggleFormat } from './editor-helpers';
import { SlateContext } from './slate-context';

const bn = 'beatmap-discussion-editor-toolbar';

export class EditorToolbar extends React.Component {
  static contextType = SlateContext;
  ref: React.RefObject<HTMLDivElement>;
  private updateTimer: number | undefined;

  constructor(props: {}) {
    super(props);

    this.ref = React.createRef();
  }

  componentDidMount() {
    $(window).on('scroll.editor-toolbar', _.throttle(() => {
      this.updatePosition();
    }, 100));
  }

  componentDidUpdate() {
    this.updatePosition();
  }

  componentWillUnmount() {
    $(window).off('.editor-toolbar');
  }

  render(): React.ReactNode {
    if (!this.context || !this.visible()) {
      return null;
    }

    const ToolbarButton = ({format}: { format: string }) => (
      <button
        className={osu.classWithModifiers(`${bn}__button`, [isFormatActive(this.context, format) ? 'active' : ''])}
        // we use onMouseDown instead of onClick here so the popup remains visible after clicking
        // tslint:disable-next-line:jsx-no-lambda
        onMouseDown={(event) => {
          event.preventDefault();
          toggleFormat(this.context, format);
        }}
      >
        <i className={`fas fa-${format}`}/>
      </button>
    );

    return (
      <Portal>
        <div
          className={bn}
          ref={this.ref}
        >
          <ToolbarButton format='bold'/>
          <ToolbarButton format='italic'/>
          <div className={`${bn}__popup-tail`}/>
        </div>
      </Portal>
    );
  }

  updatePosition() {
    const el = this.ref.current;
    if (!el || !this.context || !this.visible()) {
      return;
    }

    if (this.updateTimer) {
      clearTimeout(this.updateTimer);
    }

    // incorrect bounds are sometimes returned for the selection range, seemingly when called too soon after a
    // scroll event... so we use setTimeout here as a workaround
    this.updateTimer = setTimeout(() => {
      const domSelection = window.getSelection();
      const domRange = domSelection!.getRangeAt(0);
      const rect = domRange!.getBoundingClientRect();

      el.style.display = 'block';
      el.style.left = `${rect.left + ((window.pageXOffset - el.offsetWidth) / 2) + (rect.width / 2)}px`;
      el.style.top = `${rect.top - el.clientHeight - 10}px`;

    }, 100);
  }

  visible(): boolean {
    const {selection} = this.context;

    if (
      !selection ||
      !ReactEditor.isFocused(this.context) ||
      Range.isCollapsed(selection) ||
      Editor.string(this.context, selection) === ''
    ) {
      return false;
    }

    const domSelection = window.getSelection();
    const domRange = domSelection?.getRangeAt(0);

    return domRange !== null;
  }
}
