/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
import { Editor as SlateEditor } from 'slate';

const EditorPluginTimestamp = () => ({
  onKeyDown: (event: KeyboardEvent, editor: SlateEditor, next: () => any) => {
    const TS_REGEX = /\b((\d{2,}):([0-5]\d)[:.](\d{3})( \((?:\d[,|])*\d\))?)/;
    console.log(editor, event.key);

    if (event.key === 'Backspace') {
      // handle breaking timestamps when deleting into them
      console.log('backspace', editor);
      editor.moveFocusBackward(1);
      editor.unwrapInline('timestamp'); // remove existing timestamps
      editor.moveFocusForward(1);

      return next();
    }

    let current = editor.value.startText.text;

    // isPrintableChar
    if (event.key.length === 1) {
      current += event.key;
    }

    const matches = current.match(TS_REGEX);
    if (matches && matches.index !== undefined) {
      console.log('match', matches, event.key, editor.value.anchorInline ? editor.value.anchorInline.type : null);
      if (editor.value.anchorInline && editor.value.anchorInline.type === 'timestamp') {
        return next();
      }

      event.preventDefault();

      if (event.key.length === 1) {
        editor.insertText(event.key);
      }

      editor.moveFocusTo(matches.index);
      editor.unwrapInline('timestamp'); // remove existing timestamps
      editor.wrapInline({type: 'timestamp', data: {lastWord: current}}); // set timestamp inline
      editor.moveFocusForward(matches[0].length + 1); // deselect it
    }

    return next();
  },
});

export default EditorPluginTimestamp;
