module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt);
    require('time-grunt')(grunt);
    grunt.initConfig({
        less: {
            production: {
                options: {
                    plugins: [
                        new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]}),
                        new (require('less-plugin-clean-css'))()
                    ]
                },
                files: {
                    'css/styles.css': 'css/styles.less'
                }
            }
        },
        rsync: {
            options: {
                args: ["-avP --exclude-from=rsync_exclude.txt"]
            },
            production: {
                options: {
                    src: "./",
                    dest: "/var/www/geryit.com",
                    host: "geryit"
                }
            }
        }
    });
    grunt.registerTask('default', ['newer:less']);
    grunt.registerTask('build', ['newer:less', 'rsync']);
    grunt.registerTask('deploy', [
        'build'
    ]);
};


