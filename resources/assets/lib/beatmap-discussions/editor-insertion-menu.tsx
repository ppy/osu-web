// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as _ from 'lodash';
import { Portal } from 'portal';
import * as React from 'react';
import { Editor as SlateEditor, Element as SlateElement, Node as SlateNode, Point, Text as SlateText, Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import { SlateContext } from './slate-context';

interface Props {
  currentBeatmap: BeatmapJsonExtended;
}

export class EditorInsertionMenu extends React.Component<Props> {
  static contextType = SlateContext;
  bn = 'beatmap-discussion-editor-insertion-menu';
  declare context: React.ContextType<typeof SlateContext>;
  hideInsertMenuTimer?: number;
  hoveredBlock: HTMLElement | undefined;
  insertPosition: 'above' | 'below' | undefined;
  insertRef: React.RefObject<HTMLDivElement> = React.createRef();
  mouseOver = false;
  scrollContainer: HTMLElement | undefined;
  // setTimeout delay is to prevent flashing when hovering the menu (the portal is not inside the container, so it fires a mouseleave)
  throttledContainerMouseExit = _.throttle(() => {
    setTimeout(this.hideMenu.bind(this), 100);
  }, 10);
  throttledContainerMouseMove = _.throttle(this.containerMouseMove.bind(this), 10);
  throttledMenuMouseEnter = _.throttle(this.menuMouseEnter.bind(this), 10);
  throttledMenuMouseExit = _.throttle(this.menuMouseLeave.bind(this), 10);
  throttledScroll = _.throttle(this.forceHideMenu.bind(this), 10);
  private readonly uuid: string = osu.uuid();

  componentDidMount() {
    if (this.insertRef.current) {
      $(this.insertRef.current).on(`mouseenter.${this.uuid}`, this.throttledMenuMouseEnter);
      $(this.insertRef.current).on(`mouseleave.${this.uuid}`, this.throttledMenuMouseExit);
    }
    $(window).on(`scroll.${this.uuid}`, this.throttledScroll);
  }

  // updates cascade from our parent (slate editor), i.e. `componentDidUpdate` gets called on editor changes (typing/selection changes/etc)
  componentDidUpdate() {
    this.forceHideMenu();
  }

  componentWillUnmount() {
    $(window).off(`.${this.uuid}`);
    if (this.scrollContainer) {
      $(this.scrollContainer).off(`.${this.uuid}`);
    }
    if (this.insertRef.current) {
      $(this.insertRef.current).off(`.${this.uuid}`);
    }
  }

  containerMouseMove(event: JQuery.MouseMoveEvent) {
    if (!event.originalEvent) {
      return;
    }

    const y = event.originalEvent.clientY;
    const container = this.scrollContainer!;
    const children = container.children[0].children;

    let blockOffset = 0;
    for (const child of children) {
      if (y < child.getBoundingClientRect().top) {
        if (blockOffset > 0) {
          const prevBlock = children[blockOffset - 1];
          if (y < prevBlock.getBoundingClientRect().top + (prevBlock.getBoundingClientRect().height / 2)) {
            blockOffset--;
          }
        }
        break;
      }

      if (blockOffset < children.length - 1) {
        blockOffset++;
      }
    }

    this.hoveredBlock = children[blockOffset] as HTMLElement;
    const blockBounds = this.hoveredBlock.getBoundingClientRect();

    // If we're past the half-way point of the block's height then put the menu below the block, otherwise put it above
    if (y > blockBounds.top + (blockBounds.height / 2)) {
      this.insertPosition = 'below';
    } else {
      this.insertPosition = 'above';
    }

    this.updatePosition();
    this.showMenu();
    this.startHideTimer();
  }

  forceHideMenu() {
    this.mouseOver = false;
    this.hideMenu();
  }

  hideMenu() {
    if (!this.insertRef.current || this.mouseOver) {
      return;
    }

    this.insertRef.current.style.display = 'none';
  }

  insertBlock = (event: React.MouseEvent<HTMLElement>) => {
    const ed: ReactEditor = this.context;
    const slateNodeElement = this.hoveredBlock?.lastChild;
    const type = event.currentTarget.dataset.discussionType;
    const beatmapId = this.props.currentBeatmap?.id;

    let insertNode: SlateNode | undefined;
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

    if (!insertNode || !slateNodeElement) {
      return;
    }

    let node = ReactEditor.toSlateNode(ed, slateNodeElement);
    let insertAt: Point;
    if (
      (SlateText.isText(node) && node.text === '') ||
      (SlateElement.isElement(node) && SlateEditor.isEmpty(ed, node))
    ) {
      // TODO: This horrible mess is a workaround for Slate incorrectly inserting nodes at the wrong place when
      //  inserting relative to empty blocks/paragraphs.
      if (this.insertPosition === 'above') {
        const previousSlateElement = this.hoveredBlock?.previousSibling?.lastChild;
        if (previousSlateElement != null) {
          node = ReactEditor.toSlateNode(ed, previousSlateElement);
          insertAt = SlateEditor.end(ed, ReactEditor.findPath(ed, node));
        } else {
          // if there's no previous block, that means we're at the start of the review/document, so insert there.
          insertAt = {path: [], offset: 0};
        }
      } else {
        const nextSlateElement = this.hoveredBlock?.previousSibling?.lastChild;
        if (nextSlateElement != null) {
          node = ReactEditor.toSlateNode(ed, nextSlateElement);
          insertAt = SlateEditor.start(ed, ReactEditor.findPath(ed, node));
        } else {
          // if there's no next block, that means we're at the end of the review/document, so insert there.
          insertAt = SlateEditor.end(ed, []);
        }
      }
    } else {
      const path = ReactEditor.findPath(ed, node);
      insertAt = this.insertPosition === 'above' ?
        SlateEditor.start(ed, path) :
        SlateEditor.end(ed, path);
    }

    Transforms.insertNodes(ed, insertNode, { at: insertAt });
  };

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
        className={`${this.bn}__menu-button ${this.bn}__menu-button--${type}`}
        data-discussion-type={type}
        onClick={this.insertBlock}
        title={osu.trans(`beatmaps.discussions.review.insert-block.${type}`)}
        type='button'
      >
        <i className={icon}/>
      </button>
    );
  };

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
          ref={this.insertRef}
          className={`${this.bn}`}
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
    if (this.scrollContainer) {
      $(this.scrollContainer).off(`.${this.uuid}`);
    }
    this.scrollContainer = container;
    $(this.scrollContainer).on(`mousemove.${this.uuid}`, this.throttledContainerMouseMove);
    $(this.scrollContainer).on(`mouseleave.${this.uuid}`, this.throttledContainerMouseExit);
    $(this.scrollContainer).on(`scroll.${this.uuid}`, this.throttledScroll);
  }

  showMenu() {
    if (this.insertRef.current) {
      this.insertRef.current.style.display = 'flex';
    }
  }

  startHideTimer() {
    if (this.hideInsertMenuTimer) {
      window.clearTimeout(this.hideInsertMenuTimer);
    }

    this.hideInsertMenuTimer = window.setTimeout(this.hideMenu.bind(this), 2000);
  }

  updatePosition() {
    if (!this.scrollContainer || !this.hoveredBlock || !this.insertRef.current) {
      return;
    }

    const blockBounds = this.hoveredBlock.getBoundingClientRect();
    const containerBounds = this.scrollContainer.getBoundingClientRect();

    this.insertRef.current.style.left = `${containerBounds.left + 15}px`;
    this.insertRef.current.style.width = `${containerBounds.width - 30}px`;

    if (this.insertPosition === 'above') {
      this.insertRef.current.style.top = `${blockBounds.top - 10}px`;
    } else if (this.insertPosition === 'below') {
      this.insertRef.current.style.top = `${blockBounds.top + blockBounds.height - 10}px`;
    }
  }

}
