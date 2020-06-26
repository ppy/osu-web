// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as _ from 'lodash';
import { Portal } from 'portal';
import * as React from 'react';
import { Editor as SlateEditor, Element as SlateElement, Node as SlateNode, Point, Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import { SlateContext } from './slate-context';

const editorClass = 'beatmap-discussion-editor';

interface Props {
  currentBeatmap: BeatmapJsonExtended;
}

export class EditorInsertionMenu extends React.Component<Props> {
  static contextType = SlateContext;
  bn = 'beatmap-discussion-editor-insertion-menu';
  hideInsertMenuTimer?: number;
  hoveredBlock: HTMLElement | undefined;
  insertRef: React.RefObject<HTMLDivElement>;
  menuPos: string | undefined;
  mouseOver = false;
  scrollContainer: HTMLElement | undefined;
  // setTimeout delay is to prevent flashing when hovering the menu (the portal is not inside the container, so it fires a mouseleave)
  throttledContainerMouseExit = _.throttle(() => { setTimeout(this.hideMenu.bind(this), 100); }, 10);
  throttledContainerMouseMove = _.throttle(this.containerMouseMove.bind(this), 10);
  throttledMenuMouseEnter = _.throttle(this.menuMouseEnter.bind(this), 10);
  throttledMenuMouseExit = _.throttle(this.menuMouseLeave.bind(this), 10);
  throttledScroll = _.throttle(this.forceHideMenu.bind(this), 10);

  constructor(props: Props) {
    super(props);

    this.insertRef = React.createRef();
  }

  componentDidMount() {
    if (this.insertRef.current) {
      $(this.insertRef.current).on('mouseenter.editor-insert-menu', this.throttledMenuMouseEnter);
      $(this.insertRef.current).on('mouseleave.editor-insert-menu', this.throttledMenuMouseExit);
    }
    $(window).on('scroll.editor-insert-menu', this.throttledScroll);
  }

  // updates cascade from our parent (slate editor), i.e. `componentDidUpdate` gets called on editor changes (typing/selection changes/etc)
  componentDidUpdate() {
    this.forceHideMenu();
  }

  componentWillUnmount() {
    $(window).off('.editor-insert-menu');
    if (this.scrollContainer) {
      $(this.scrollContainer).off('.editor-insert-menu');
    }
    if (this.insertRef.current) {
      $(this.insertRef.current).off('.editor-insert-menu');
    }
  }

  containerMouseMove(event: JQuery.MouseMoveEvent) {
    const block = event.target.closest(`.${editorClass}__block`);

    if (
      !block ||
      !this.insertRef.current ||
      !event.originalEvent ||
      event.originalEvent.buttons > 0 // don't show while dragging
    ) {
      this.hoveredBlock = undefined;
      return;
    }

    this.hoveredBlock = block;
    const blockRect = block.getBoundingClientRect();
    const cursorPos = {
      x: event.originalEvent.clientX,
      y: event.originalEvent.clientY,
    };

    // If we're past the half-way point of the block's height then put the menu below the block, otherwise put it above
    if ((cursorPos?.y - blockRect.top) > (blockRect.height / 2)) {
      this.menuPos = 'below';
    } else {
      this.menuPos = 'above';
    }

    this.updatePosition();
    this.showMenu();
    this.startHideTimer();
  }

  forceHideMenu() {
    this.mouseOver = false;
    this.hideMenu();
  }

  getBlockFromInsertMarker() {
    const container = this.scrollContainer;
    const insertMarker = this.insertRef.current;
    if (!container || !insertMarker) {
      return;
    }

    const y = insertMarker.getBoundingClientRect().y + (insertMarker.getBoundingClientRect().height / 2);

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

    this.insertRef.current.style.display = 'none';
  }

  insertBlock = (event: React.MouseEvent<HTMLElement>) => {
    const e: ReactEditor = this.context;
    const lastChild = this.getBlockFromInsertMarker()?.lastChild;

    if (!lastChild) {
      return;
    }

    let node = ReactEditor.toSlateNode(e, lastChild);
    let at: Point;

    // TODO: This is a workaround for Slate incorrectly inserting nodes _after_ an empty element instead of _before_.
    //  Either due to a bug in SlateEditor.end() or with how our 'embed' blocks are implemented... maybe we should
    //  look at converting the embeds to voids at some point?
    if (SlateElement.isElement(node) && SlateEditor.isEmpty(e, node)) {
      const previousBlock = lastChild.parentElement!.previousSibling;

      if (previousBlock) {
        node = ReactEditor.toSlateNode(e, (previousBlock.lastChild as Node));
        at = SlateEditor.end(e, ReactEditor.findPath(e, node));
      } else {
        // inserting block at start of review/document
        at = {path: [], offset: 0};
      }
    } else {
      at = SlateEditor.start(e, ReactEditor.findPath(e, node));
    }

    let insertNode: SlateNode | undefined;
    const type = event.currentTarget.dataset.dtype;
    const beatmapId = this.props.currentBeatmap?.id;

    switch (type) {
      case 'suggestion':
      case 'problem':
      case 'praise':
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

    Transforms.insertNodes(e, insertNode, { at });
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
        title={osu.trans(`beatmaps.discussions.review.insert-block.${type}`)}
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
            <div className={`${this.bn}__body`}>
              <i className='fas fa-plus' />
              <div className={`${this.bn}__buttons`}>
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

  setScrollContainer(container: HTMLElement) {
    this.scrollContainer = container;
    $(this.scrollContainer).on('mousemove.editor-insert-menu', this.throttledContainerMouseMove);
    $(this.scrollContainer).on('mouseleave.editor-insert-menu', this.throttledContainerMouseExit);
    $(this.scrollContainer).on('scroll.editor-insert-menu', this.throttledScroll);
  }

  showMenu() {
    if (this.insertRef.current) {
      this.insertRef.current.style.display = 'flex';
    }
  }

  startHideTimer() {
    if (this.hideInsertMenuTimer) {
      Timeout.clear(this.hideInsertMenuTimer);
    }

    this.hideInsertMenuTimer = Timeout.set(2000, this.hideMenu.bind(this));
  }

  updatePosition() {
    if (!this.scrollContainer || !this.hoveredBlock || !this.insertRef.current) {
      return;
    }

    const blockRect = this.hoveredBlock.getBoundingClientRect();
    const containerBounds = this.scrollContainer.getBoundingClientRect();

    const outsideContainer =
      blockRect.top < containerBounds.top ||
      (blockRect.top > containerBounds.bottom);

    if (outsideContainer) {
      return this.forceHideMenu();
    }

    if (this.menuPos === 'above') {
      this.insertRef.current.style.top = `${blockRect.top - 10}px`;
    } else if (this.menuPos === 'below') {
      this.insertRef.current.style.top = `${blockRect.top + blockRect.height - 10}px`;
    }
  }

}
