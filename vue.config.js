module.exports = {
    devServer: {
        proxy: {
            '/ajax': {
                target: 'http://localhost:8000/',
                ws: true,
                changeOrigin: true
            }
        }
    },
    pages: {
        index: {
            entry: 'resources/app.js'
        }
    }
};