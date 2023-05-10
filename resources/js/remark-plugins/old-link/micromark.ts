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
  let foundUrl = false;
  let foundUrlColon = false;
  let openBrackets = 0;
  let urlSlashCount = 0;

  return start;

  function start(code: Code): State | void {
    if (code !== codes.leftSquareBracket) return nok(code);

    effects.enter('legacyLink');
    effects.consume(code);
    effects.enter('legacyLinkUrl');

    return consumeUrl;
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

    if (code === codes.space) {
      if (foundUrl) {
        effects.exit('legacyLinkUrl');
        effects.consume(code);
        effects.enter('legacyLinkTitle');
        effects.enter('chunkString', { contentType: 'string' });

        return consumeTitle;
      } else {
        return nok(code);
      }
    }

    effects.consume(code);
    return consumeUrl;
  }

  function consumeTitle(code: Code): State | void {
    if (isEol(code)) return nok(code);

    if (code === codes.backslash) {
      effects.consume(code);

      return consumeTitleEscape;
    }

    if (code === codes.rightSquareBracket) {
      if (openBrackets === 0) {
        effects.exit('chunkString');
        effects.exit('legacyLinkTitle');
        effects.consume(code);
        effects.exit('legacyLink');

        return ok(code);
      }

      openBrackets--;
    }

    if (code === codes.leftSquareBracket) {
      openBrackets++;
    }

    effects.consume(code);

    return consumeTitle;
  }

  function consumeTitleEscape(code: Code): State | void {
    if (code === codes.backslash || code === codes.leftSquareBracket || code === codes.rightSquareBracket) {
      effects.consume(code);

      return consumeTitle;
    }

    return consumeTitle(code);
  }
}

const micromark = {
  text: { [codes.leftSquareBracket]: { tokenize } },
};
export default micromark;
