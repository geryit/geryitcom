module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt);
    require('time-grunt')(grunt);

    var fourDigits = Math.floor(1000 + Math.random() * 9000);
    grunt.initConfig({


        'regex-replace': {

            assets: {
                //specify a target with any name
                src: [
                    'index.php',
                    'blog/wp-content/themes/geryit/functions.php',
                    'src/less/*.less'
                ],
                actions: [
                    {
                        name: 'remove version with strings ?1111 ',
                        search: /\?v=\d\d\d\d/g,
                        replace: ''
                    },
                    {
                        name: 'find specific strings and add version',
                        search: /(styles.min.css|scripts.min.js)/g,
                        replace: function (arg1) {
                            if (arg1) return arg1 + '?v=' + fourDigits;
                        }
                    }
                ]
            }
        },


        less: {
            options: {
                plugins: [
                    new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]}),
                    new (require('less-plugin-clean-css'))({rebase: true})
                ]
            },
            production: {
                files: {
                    'dist/styles.min.css': 'src/less/styles.less'
                }
            }
        },

        uglify: {
            production: {
                files: {
                    'dist/scripts.min.js': [
                        'src/js/jquery.min.js',
                        'src/js/jquery.cycle.lite.min.js',
                        'src/js/site.js',
                        'src/js/blog.js'
                    ]
                }
            }
        },
        //
        // compress: {
        //     options: {
        //         mode: 'gzip'
        //     },
        //     production: {
        //         files: [{
        //             expand: true,
        //             cwd: './',
        //             src: ['**/ge_styles.min.css', '**/ge_scripts.min.js'],
        //             dest: './',
        //             rename: function (dest, src) {
        //                 return dest + '/' + src + '.gzip';
        //             }
        //         }]
        //     }
        // },

        aws: grunt.file.readJSON('.aws.json'), // Read the file

        aws_s3: {
            options: {
                accessKeyId: "<%= aws.AWSAccessKeyId %>",
                secretAccessKey: "<%= aws.AWSSecretKey %>",
                region: '<%= aws.AWSRegion %>',
                bucket: '<%= aws.AWSBucket %>',
                uploadConcurrency: 5, // 5 simultaneous uploads
                downloadConcurrency: 5, // 5 simultaneous downloads,
                differential: true,
                params: {
                    CacheControl: 'public, max-age=31536000',
                    // ContentEncoding: 'gzip', // applies to all the files!
                    // ContentType: 'text/css',
                    Expires: new Date(new Date().setFullYear(new Date().getFullYear() + 1))
                }
            },
            production: {
                files: [{
                    expand: true, cwd: 'dist/', src: ['**'], dest: 'dist/'
                }]
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
    grunt.registerTask('build', ['regex-replace', 'less', 'newer:uglify']);
    grunt.registerTask('deploy', [
        'build',
        'aws_s3',
        'rsync'
    ]);
};


