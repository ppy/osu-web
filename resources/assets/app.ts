// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// tslint:disable: ordered-imports
import 'url-polyfill';
import 'app-deps';

// import-glob-loader doesn't seem to work with resolve: {}?
import './coffee/_classes/*.coffee';

import 'jquery-pubsub.coffee';
import 'osu-common';

import 'spoilerbox.coffee';
import 'store.coffee';
import 'store-username-change.coffee';
import 'forum/post-box.coffee';
import 'ujs-common.coffee';
import 'bootstrap-modal.coffee';
import 'shared.coffee';
import 'turbolinks-overrides.coffee';
import 'lang-overrides';

import 'import-shims';  // shim imports to window
import 'osu-core-singleton';
import 'main.coffee';

import 'register-components.coffee';
