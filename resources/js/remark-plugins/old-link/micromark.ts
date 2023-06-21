// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { codes } from 'micromark-util-symbol/codes';
import type { Code, Effects, State } from 'micromark-util-types';

function isEol(code: Code) {
  return code === codes.carriageReturn
    || code === codes.lineFeed
    || code === codes.carriageReturnLineFeed
    || code === codes.eof;
}

function tokenize(effects: Effects, ok: State, nok: State) {
  let foundTitle = false;
  let foundUrl = false;
  let foundUrlColon = false;
  let openBrackets = 0;
  let urlSlashCount = 0;

  return start;

  function start(code: Code): State | void {
    if (code !== codes.leftParenthesis) return nok(code);

    effects.enter('oldLink');
    effects.consume(code);
    effects.enter('oldLinkTitle');
    effects.enter('chunkString', { contentType: 'string' });

    return consumeTitle;
  }

  function consumeUrl(code: Code): State | void {
    if (isEol(code)) return nok(code);

    if (!foundUrl) {
      if (foundUrlColon) {
        if (urlSlashCount < 2) {
          if (code === codes.slash) {
            urlSlashCount++;
          } else {
            return nok(code);
          }
        } else {
          foundUrl = true;
        }
      } else {
        if (code === codes.colon) {
          foundUrlColon = true;
        }
      }
    }

    if (code === codes.rightSquareBracket) {
      if (foundUrl) {
        if (openBrackets === 0) {
          effects.exit('oldLinkUrl');
          effects.consume(code);
          effects.exit('oldLink');

          return ok(code);
        }

        openBrackets--;
      } else {
        return nok(code);
      }
    }

    if (code === codes.leftSquareBracket) {
      openBrackets++;
    }

    effects.consume(code);
    return consumeUrl;
  }

  function consumeUrlStart(code: Code): State | void {
    if (code === codes.leftSquareBracket) {
      effects.consume(code);
      effects.enter('oldLinkUrl');

      return consumeUrl;
    }

    return nok(code);
  }

  function consumeTitle(code: Code): State | void {
    if (isEol(code)) return nok(code);

    if (code === codes.backslash) {
      effects.consume(code);

      return consumeTitleEscape;
    }

    if (code === codes.rightParenthesis) {
      if (openBrackets === 0) {
        if (foundTitle) {
          effects.exit('chunkString');
          effects.exit('oldLinkTitle');
          effects.consume(code);

          return consumeUrlStart;
        } else {
          return nok(code);
        }
      }

      openBrackets--;
    }

    if (code === codes.leftParenthesis) {
      openBrackets++;
    }

    effects.consume(code);
    foundTitle = true;

    return consumeTitle;
  }

  function consumeTitleEscape(code: Code): State | void {
    if (code === codes.backslash || code === codes.leftParenthesis || code === codes.rightParenthesis) {
      effects.consume(code);

      return consumeTitle;
    }

    return consumeTitle(code);
  }
}

const micromark = {
  text: { [codes.leftParenthesis]: { tokenize } },
};
export default micromark;
