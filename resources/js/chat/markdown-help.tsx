// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Modal from 'components/modal';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';

const examples = [
  {
    markdown: '# Heading 1',
    html: <h1>Heading 1</h1>,
  },
  {
    markdown: '## Heading 2',
    html: <h2>Heading 2</h2>,
  },
  {
    markdown: '### Heading 3',
    html: <h3>Heading 3</h3>,
  },
  {
    markdown: '**bold** and *emphasis*',
    html: <><strong>bold</strong> and <em>emphasis</em></>,
  },
  {
    markdown: '[links](https://osu.ppy.sh)',
    html: <a href='https://osu.ppy.sh'>links</a>,
  },
  {
    markdown: <>
      1. ordered<br />
      1. list
    </>,
    html: <ol>
      <li>ordered</li>
      <li>list</li>
    </ol>,
  },
  {
    markdown: <>
      - unordered<br />
      - list
    </>,
    html: <ul>
      <li>unordered</li>
      <li>list</li>
    </ul>,
  },
  {
    markdown: '> quote',
    html: <blockquote><p>quote</p></blockquote>,
  },
  {
    markdown: <>
      ```<br />
      code<br />
      blocks<br />
      ```
    </>,
    html: <pre>
      <code>
        code{'\n'}
        blocks
      </code>
    </pre>,
  },
  {
    markdown: '`inline block`',
    html: <code>inline block</code>,
  },
];

interface Example {
  html: React.ReactNode;
  markdown: React.ReactNode;
}

function renderExample({ html, markdown }: Example) {
  return (
    <div className='markdown-help__example'>
      <div>{markdown}</div>
      <div>{html}</div>
    </div>
  );
}

@observer
export default class MarkdownHelp extends React.Component<Record<string, never>> {
  @observable showingModal = false;

  constructor(props: Record<string, never>) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <>
        <button
          className='link'
          onClick={this.toggle}
        >
          Supported Markdown
        </button>
        {this.showingModal && (
          <Modal onClose={this.toggle}>
            <div className='markdown-help'>
              <div className='osu-md osu-md--chat'>
                {examples.map((example, index) => <React.Fragment key={index}>{renderExample(example)}</React.Fragment>)}
              </div>
            </div>
          </Modal>
        )}
      </>
    );
  }

  @action
  private toggle = () => {
    this.showingModal = !this.showingModal;
  };
}
