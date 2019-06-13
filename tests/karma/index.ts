// This builds the tests into a single bundle.

// Doesn't work when specified in karma config for some reason.
import '../../resources/assets/app';

// webpack's require typings are different from node's
// and installing either of those typings breaks the typings for the web stuff
// because the typings for global functions like setTimeout are different.
declare var require: any;

const testsContext = require.context('.', true, /\.spec$/);
testsContext.keys().forEach(testsContext);
