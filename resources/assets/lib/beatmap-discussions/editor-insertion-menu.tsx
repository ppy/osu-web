// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as _ from 'lodash';
import * as React from 'react';
import { Editor as SlateEditor, Range, Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import BeatmapJsonExtended from '../interfaces/beatmap-json-extended';
import { Portal } from '../portal';
import { SlateContext } from './slate-context';

const editorClass = 'beatmap-discussion-editor';

interface Props {
  currentBeatmap: BeatmapJsonExtended;
}

export class EditorInsertionMenu extends React.Component<Props> {
  static contextType = SlateContext;

  bn = 'beatmap-discussion-editor-insertion-menu';
  hideInsertMenuTimer?: number;
  insertRef: React.RefObject<HTMLDivElement>;
  mouseOver = false;
  scrollContainer: HTMLElement | undefined;
  throttledMouseEnter = _.throttle(this.menuMouseEnter.bind(this), 10);
  throttledMouseExit = _.throttle(this.menuMouseLeave.bind(this), 10);
  throttledMouseHover = _.throttle(this.scrollContainerMouseMove.bind(this), 10);

  constructor(props: Props) {
    super(props);

    this.insertRef = React.createRef();
  }

  componentDidMount() {
    if (this.insertRef.current) {
      $(this.insertRef.current).on('mouseenter.editor-insert-menu', this.throttledMouseEnter);
      $(this.insertRef.current).on('mouseleave.editor-insert-menu', this.throttledMouseExit);
    }
  }

  componentWillUnmount() {
    if (this.scrollContainer) {
      $(this.scrollContainer).off('.editor-insert-menu');
    }
    if (this.insertRef.current) {
      $(this.insertRef.current).off('.editor-insert-menu');
    }
  }

  getBlockFromInsertMarker() {
    const container = this.scrollContainer;
    const insertBar = this.insertRef.current;
    if (!container || !insertBar) {
      return;
    }

    const y = insertBar.getBoundingClientRect().y + (insertBar.getBoundingClientRect().height / 2);

    let blockOffset = -1;
    for (const child of container.children[0].children) {
      if (y < child.getBoundingClientRect().top) {
        const prevBlock = container.children[0].children[blockOffset];
        if (y > prevBlock.getBoundingClientRect().top + (prevBlock.getBoundingClientRect().height / 2)) {
          blockOffset++;
        }

        break;
      }
      blockOffset++;
    }

    return container.children[0].children[blockOffset];
  }

  hideMenu() {
    if (!this.insertRef.current || this.mouseOver) {
      return;
    }

    this.insertRef.current.style.opacity = '0';
  }

  insertBlock = (event: React.MouseEvent<HTMLElement>) => {
    const type = event.currentTarget.dataset.dtype;
    const beatmapId = this.props.currentBeatmap?.id;

    // find where to insert the new embed (relative to the dropdown menu)
    const lastChild = this.getBlockFromInsertMarker()?.lastChild;

    if (!lastChild) {
      return;
    }

    // convert from dom node to document path
    const node = ReactEditor.toSlateNode(this.context, lastChild);
    const path = ReactEditor.findPath(this.context, node);
    const at = SlateEditor.start(this.context, path);
    let insertNode;

    switch (type) {
      case 'suggestion': case 'problem': case 'praise':
        insertNode = {
          beatmapId,
          children: [{text: ''}],
          discussionType: type,
          type: 'embed',
        };
        break;
      case 'paragraph':
        insertNode = {
          children: [{text: ''}],
          type: 'paragraph',
        };
        break;
    }

    if (!insertNode) {
      return;
    }

    Transforms.insertNodes(this.context, insertNode, { at });
  }

  insertButton = (type: string) => {
    let icon = 'fas fa-question';

    switch (type) {
      case 'praise':
      case 'problem':
      case 'suggestion':
        icon = BeatmapDiscussionHelper.messageType.icon[type];
        break;
      case 'paragraph':
        icon = 'fas fa-indent';
        break;
    }

    return (
      <button
        type='button'
        className={`${editorClass}__menu-button ${editorClass}__menu-button--${type}`}
        data-dtype={type}
        onClick={this.insertBlock}
        // title={osu.trans(`beatmaps.discussions.review.insert-block.${type}`)}
      >
        <i className={icon}/>
      </button>
    );
  }

  menuMouseEnter() {
    this.mouseOver = true;
  }

  menuMouseLeave() {
    this.mouseOver = false;
    this.startHideTimer();
  }

  render() {
    return (
        <Portal>
          <div
            className={`${this.bn}`}
            ref={this.insertRef}
          >
            <div
              className={`${this.bn}__content`}
            >
              <i className='fas fa-plus' />
              <div className={`${this.bn}__menu-content`}>
                {this.insertButton('suggestion')}
                {this.insertButton('problem')}
                {this.insertButton('praise')}
                {this.insertButton('paragraph')}
              </div>
            </div>
          </div>
        </Portal>
    );
  }

  scrollContainerMouseMove(event: JQuery.MouseMoveEvent) {
    const block = event.target.closest(`.${editorClass}__block`);

    if (
      !block ||
      !this.insertRef.current ||
      (this.context.selection && !Range.isCollapsed(this.context.selection))
    ) {
      return;
    }

    const blockRect = block.getBoundingClientRect();

    if (!event.originalEvent) {
      return;
    }

    const cursorPos = {
      x: event.originalEvent.clientX,
      y: event.originalEvent.clientY,
    };

    if ((cursorPos?.y - blockRect.top) > (blockRect.height / 2)) {
      // show below
      this.insertRef.current.style.top = `${blockRect.top + blockRect.height - 10}px`;
    } else {
      // show above
      this.insertRef.current.style.top = `${blockRect.top - 10}px`;
    }

    this.showMenu();

    if (this.hideInsertMenuTimer) {
      Timeout.clear(this.hideInsertMenuTimer);
    }

    this.startHideTimer();
  }

  setScrollContainer(container: HTMLElement) {
    this.scrollContainer = container;
    $(this.scrollContainer).on('mousemove.editor-insert-menu', this.throttledMouseHover);
  }

  showMenu() {
    if (this.insertRef.current) {
      this.insertRef.current.style.opacity = '1';
    }
  }

  startHideTimer() {
    this.hideInsertMenuTimer = Timeout.set(2000, this.hideMenu.bind(this));
  }

}
