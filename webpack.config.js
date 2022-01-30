const path = require("path");
const TerserPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

const sourceMapEnabled = process.env.NODE_ENV !== "production";

module.exports = {
  entry: path.resolve(__dirname, "src/js/megamenu.js"),
  output: {
    filename: "./js/megamenu.min.js",
    path: path.resolve(__dirname, "dist"),
  },
  optimization: {
    minimizer: [
      new TerserPlugin({
        extractComments: false,
      }),
    ],
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: "babel-loader",
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: "css-loader",
            options: {
              sourceMap: sourceMapEnabled,
            },
          },
          {
            loader: "postcss-loader",
            options: {
              sourceMap: sourceMapEnabled,
            },
          },
          {
            loader: "sass-loader",
            options: {
              implementation: require("sass"),
              sourceMap: sourceMapEnabled,
            },
          },
        ],
      },
    ],
  },
  plugins: [
    new CleanWebpackPlugin({}),
    new MiniCssExtractPlugin({
      filename: "./css/megamenu.min.css",
    }),
  ],
  devtool: "source-map",
  watchOptions: {
    ignored: /node_modules/,
  },
};
