// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Processor } from 'unified';

export function disableTokenizersPlugin(this: Processor, {allowedBlocks = [] as string[], allowedInlines = [] as string[]} = {}) {
  // Ensure core required tokenizers are always allowed (otherwise infinite loops and other bad things happen...)
  allowedBlocks.push('root', 'newline');
  allowedInlines.push('text');

  this.Parser.prototype.blockMethods
    .filter((key: string) => !allowedBlocks.includes(key))
    .forEach((key: string) => {
      this.Parser.prototype.blockTokenizers[key] = () => true;
    });

  this.Parser.prototype.inlineMethods
    .filter((key: string) => !allowedInlines.includes(key))
    .forEach((key: string) => {
      this.Parser.prototype.inlineTokenizers[key] = () => true;
      this.Parser.prototype.inlineTokenizers[key].locator = () => -1;
    });
}
