// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class ForumPoll {
  constructor() {
    $(document)
      .on('click', '.js-forum-poll--switch-page', this.switchPage)
      .on('click', '.js-forum-poll--switch-edit', this.switchEdit);
  }

  switchEdit = (event: JQuery.ClickEvent) => {
    const $container = $(event.target).parents('.js-forum-poll--container');

    if ($container.attr('data-edit') === '1') {
      $container.attr('data-edit', '0');

      const form = $(event.target).closest('form')[0];

      if (form != null) {
        form.reset();
      }
    } else {
      $container.attr('data-edit', '1');
    }
  };

  switchPage = (event: JQuery.ClickEvent) => {
    const target = event.currentTarget;

    if (!(target instanceof HTMLElement)) {
      return;
    }

    const targetPage = target.dataset.targetPage;

    if (typeof targetPage === 'string') {
      $(event.target).parents('.js-forum-poll--container').attr('data-page', targetPage);
    }
  };
}
