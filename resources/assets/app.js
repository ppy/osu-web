import 'jquery-prefilter.coffee';

// import-glob-loader doesn't seem to work with resolve: {}?
import './coffee/_classes/*.coffee';

import 'react-namespaces.coffee';
import './coffee/react/_components/*.coffee';

import 'jquery-pubsub.coffee';
import 'osu_common.coffee';

import 'navbar-mobile.coffee';
import 'spoilerbox.coffee';
import 'store.coffee';
import 'store-username-change.coffee';
import 'forum/post-box.coffee';
import 'forum/topic-ajax.coffee';
import 'ujs-common.coffee';
import 'bootstrap-modal.coffee';
import 'logout.coffee';
import 'shared.coffee';
import 'turbolinks-overrides.coffee';

import 'import-shims';  // shim imports to window
import 'main.coffee';
