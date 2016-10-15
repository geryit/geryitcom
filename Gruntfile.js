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
                    'css/styles.less',
                    'blog/wp-content/themes/geryit/functions.php',
                    'blog/wp-content/themes/geryit/css/styles.less'
                ],
                actions: [
                    {
                        name: 'remove version with strings ?1111 ',
                        search: /\?v=\d\d\d\d/g,
                        replace: ''
                    },
                    {
                        name: 'add version number to strings ending with .png, .jpg... ',
                        search: /\.(gzip|png|jpg|svg)/g,
                        replace: function (arg1) {
                            if (arg1) return arg1 + '?v=' + fourDigits;
                        }
                    }
                ]
            }
        },


        less: {
            production: {
                options: {
                    plugins: [
                        new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]}),
                        new (require('less-plugin-clean-css'))()
                    ]
                },
                files: {
                    'css/styles.css': 'css/styles.less',
                    'blog/wp-content/themes/geryit/css/styles.css': 'blog/wp-content/themes/geryit/css/styles.less'
                }
            }
        },


        concat: {
            js: {
                files: {
                    'js/scripts.js': [
                        'js/jquery.min.js',
                        'js/jquery.cycle.lite.min.js',
                        'js/custom.js'
                    ]

                }
            }
        },

        uglify: {
            js: {
                files: {
                    'js/scripts.min.js': [
                        'js/scripts.js'
                    ],
                    'blog/wp-content/themes/geryit/js/scripts.min.js': [
                        'blog/wp-content/themes/geryit/js/scripts.js'
                    ]

                }
            }
        },

        compress: {
            options: {
                mode: 'gzip'
            },
            assets: {
                files: {
                    'css/styles.css.gzip': ['css/styles.css'],
                    'js/scripts.js.gzip': ['js/scripts.js'],
                    'blog/wp-content/themes/geryit/css/styles.css.gzip': ['blog/wp-content/themes/geryit/css/styles.css'],
                    'blog/wp-content/themes/geryit/js/scripts.min.js.gzip': ['blog/wp-content/themes/geryit/js/scripts.min.js']
                }
            }
        },

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
                    ContentEncoding: 'gzip', // applies to all the files!
                    ContentType: 'text/css',
                    Expires: new Date(new Date().setFullYear(new Date().getFullYear() + 1))
                }
            },
            css: {
                files: {
                    expand: true,
                    cwd: '/',
                    src: ['**/*.gzip'],
                    dest: '/'
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
    grunt.registerTask('build', ['regex-replace', 'newer:less', 'newer:concat', 'newer:uglify', 'newer:compress', 'aws_s3', 'rsync']);
    grunt.registerTask('deploy', [
        'build'
    ]);
};


