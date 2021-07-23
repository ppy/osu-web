// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

const Timeout = {
  clear: (id: number) => window.clearTimeout(id),
  set: (delay: number, func: () => void) => window.setTimeout(func, delay),
};

export default Timeout;
