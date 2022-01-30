const path = require("path");

module.exports = {
  entry: path.resolve(__dirname, "src/js/megamenu.js"),
  output: {
    filename: "./js/megamenu.min.js",
    path: path.resolve(__dirname, "dist"),
  },
};
