// Doesn't work when specified in karma config for some reason.
import '../app';

const testsContext = require.context('./..', true, /\.spec$/);
// console.log(testsContext.keys());
testsContext.keys().forEach(testsContext);
