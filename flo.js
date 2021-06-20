var flo = require('fb-flo'),
    path = require('path'),
    fs = require('fs');

var server = flo(
  './',
  {
    port: 8888,
    host: 'localhost',
    verbose: false,
    glob: [
       // All JS files in `sourceDirToWatch` and subdirectories
      '**/*.js',
       // All CSS files in `sourceDirToWatch` and subdirectories
      '**/*.css',
      '**/*.html'
    ]
  },
  function resolver(filepath, callback) {
      console.log(filepath + ' a été modifié');
    callback({
      resourceURL: filepath,
      reload: !filepath.match(/\.(css)$/),
      // any string-ish value is acceptable. i.e. strings, Buffers etc.
      contents: fs.readFileSync(filepath),
      update: function(_window, _resourceURL) {
        // this function is executed in the browser, immediately after the resource has been updated with new content
        // perform additional steps here to reinitialize your application so it would take advantage of the new resource
        console.log("Resource " + _resourceURL + " has just been updated with new content");
      }
    });
  }
);
