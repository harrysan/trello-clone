const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.extend(
    "graphql",
    new (class {
        dependencies() {
            return ["graphql", "graphql-tag"];
        }

        webpackRules() {
            return {
                test: /\.(graphql|gql)$/,
                exclude: /node_modules/,
                loader: "graphql-tag/loader",
            };
        }
    })()
);

mix.webpackConfig({
    resolve: {
        fallback: {
            child_process: "empty",
            fs: require.resolve("browserify-fs"),
            util: require.resolve("util"),
            http: require.resolve("stream-http"),
            https: require.resolve("https-browserify"),
            tls: require.resolve("tls-browserify"),
            net: require.resolve("net-browserify"),
            crypto: require.resolve("crypto-browserify"),
            path: require.resolve("path-browserify"),
            os: require.resolve("os-browserify"),
            stream: require.resolve("stream-browserify"),
            zlib: require.resolve("browserify-zlib"),
        },
    },
});

mix.js("resources/js/app.js", "public/js")
    .vue()
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")]);

mix.graphql();
