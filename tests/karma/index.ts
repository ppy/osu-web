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

// This builds the tests into a single bundle.

import '../../resources/assets/build/locales/en';

// Doesn't work when specified in karma config for some reason.
import '../../resources/assets/app';

// webpack's require typings are different from node's
// and installing either of those typings breaks the typings for the web stuff
// because the typings for global functions like setTimeout are different.
declare var require: any;

const testsContext = require.context('.', true, /\.spec$/);
testsContext.keys().forEach(testsContext);
