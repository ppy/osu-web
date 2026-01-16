import { debounce } from 'lodash';
import { route } from '../../laroute';

export default class TagEditorState {
  private readonly debouncedUpdate;

  constructor(private readonly container: HTMLElement) {
    this.debouncedUpdate = debounce(this.update, 200);
  }

  readonly onClick = () => {
    this.container.classList.add('js-forum-topic-tag-editor-ajax--loading', 'simple-menu__item--disabled');

    this.debouncedUpdate();
  };

  private readonly checkbox = () => this.container.querySelector('input[type="checkbox"]') as HTMLInputElement;

  private readonly issueTag = () => {
    if (!('issueTag' in this.container.dataset)) {
      throw new Error('missing issueTag on tag dataset');
    }

    return this.container.dataset.issueTag;
  };

  private readonly topicId = () => {
    const editor = this.container.closest('.js-forum-tag-editor') as HTMLElement;

    if (!('topicId' in editor.dataset)) {
      throw new Error('missing topic-id on tag editor dataset');
    }

    return editor.dataset.topicId;
  };

  private readonly update = () => {
    $.ajax(route('forum.topics.issue-tag', {
      issue_tag: this.issueTag(),
      state: !this.checkbox().checked,
      topic: this.topicId(),
    }), {
      method: 'POST',
    }).done(() => {
      this.checkbox().checked = !this.checkbox().checked;
    }).always(() => {
      this.container.classList.remove('js-forum-topic-tag-editor-ajax--loading', 'simple-menu__item--disabled');
    });
  };
}
