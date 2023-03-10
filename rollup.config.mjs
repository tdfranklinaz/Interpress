import { nodeResolve } from '@rollup/plugin-node-resolve'

import terser from '@rollup/plugin-terser'
import livereload from 'rollup-plugin-livereload'
import postcss from 'rollup-plugin-postcss'

export default {
    input: 'scripts/script.js',
    output: [
        {
            dir: '.interpress/build',
            format: 'es',
            plugins: [
                terser()
            ]
        }
    ],
    plugins: [
        nodeResolve(),
        postcss(),
        livereload({
            watch: [
                '.interpress/**/*.js',
            ],
            verbose: false,
        })
    ]
}