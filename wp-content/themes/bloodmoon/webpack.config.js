module.exports = {
    output: {
        filename: 'bundle.js'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader',
                query: {
                    presets: [
                        ['latest', {modules: false}],
                    ]
                }
            }
        ]
    }
    // watch: true,
    // watchOptions: {
    //     aggregateTimeout: 300,
    //     poll: 1000
    // }
};
