// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { observer } from 'mobx-react';
import Message from 'models/chat/message';
import * as React from 'react';
import ReactMarkdown from 'react-markdown';
import autolink from 'remark-plugins/autolink';
import disableConstructs from 'remark-plugins/disable-constructs';
import legacyLink from 'remark-plugins/legacy-link';
import wikiLink, { RemarkWikiLinkPlugin } from 'remark-wiki-link';
import { classWithModifiers } from 'utils/css';
import { safeReactMarkdownUrl, wikiUrl } from 'utils/url';

interface Props {
  message: Message;
}

function linkRenderer(astProps: JSX.IntrinsicElements['a']) {
  return (
    <a href={safeReactMarkdownUrl(astProps.href)} rel='nofollow noreferrer' target='_blank'>
      {astProps.children}
    </a>
  );
}

const components = Object.freeze({
  a: linkRenderer,
});

@observer
export default class MessageItem extends React.Component<Props> {
  render() {
    return (
      <div className={classWithModifiers('chat-message-item', { sending: !this.props.message.persisted })}>
        <div className='chat-message-item__entry'>
          {this.renderMarkdown()}
          {!this.props.message.persisted && !this.props.message.errored &&
            <div className='chat-message-item__status'>
              <Spinner />
            </div>
          }
          {this.props.message.errored &&
            <div className='chat-message-item__status chat-message-item__status--errored'>
              <i className='fas fa-times' />
            </div>
          }
        </div>
      </div>
    );
  }

  private renderMarkdown() {
    const remarkType = this.props.message.type === 'markdown' ? 'chat' : 'chatPlain';
    const wikiLinkPlugin: RemarkWikiLinkPlugin = [wikiLink, { hrefTemplate: wikiUrl }];

    return (
      <ReactMarkdown
        className={classWithModifiers('osu-md', 'chat', {
          'chat-action': this.props.message.type === 'action',
          'chat-plain': remarkType === 'chatPlain',
        })}
        components={components}
        remarkPlugins={[autolink, [disableConstructs, { type: remarkType }], legacyLink, wikiLinkPlugin]}
        unwrapDisallowed
      >
        {this.props.message.content}
      </ReactMarkdown>
    );
  }
}
