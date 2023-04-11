const path = require('path');

module.exports = {
  root: path.resolve(__dirname, './'),
  build: {
    outDir: path.resolve(__dirname, './dist'),
    assetsDir: 'assets',
    rollupOptions: {
      input: 'resources/js/app.js',
    },
  },
};
