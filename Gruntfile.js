module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        less: {
            development: {
                options: {
                    paths: 'app/styles',
                    compress: true
                },
                files: {
                    '.tmp/style.min.css': ['app/**/*.less', '!app/bower_components/**/*.less']
                }
            }
        },
        cssmin: {
            target: {
                options: {
                    sourceMap: true,
                    sourceMapName: 'dist/assets/styles/app.min.map',
                    report: 'gzip'
                },
                files: {
                    'dist/assets/styles/app.min.css': [
                        'app/bower_components/normalize-css/normalize.css',
                        'app/bower_components/textAngular/dist/textAngular.css',
                        'app/bower_components/fancyBox/source/jquery.fancybox.css',
                        'app/bower_components/**/*.min.css',
                        'app/bower_components/medium-editor/dist/css/themes/flat.css',
                        '!app/bower_components/medium-editor/dist/css/themes/**/*.min.css',
                        '.tmp/**/*.css'
                    ]
                }
            }
        },
        uglify: {
            options: {
                mangle: false
            },
            vendor: {
                files: {
                    'dist/assets/scripts/vendor.min.js': [
                        'app/bower_components/jquery/dist/jquery.js',
                        'app/bower_components/bootstrap/dist/js/bootstrap.min.js',
                        'app/bower_components/fancyBox/source/jquery.fancybox.js',
                        'app/bower_components/owl.carousel/dist/owl.carousel.js'
                    ]
                }
            },
            app: {
                options: {
                    sourceMap: true,
                    sourceMapName: 'dist/assets/scripts/app.min.map'
                },
                files: {
                    'dist/assets/scripts/app.min.js': [
                        'app/scripts/**/*.js'
                    ]
                }
            },
            ninepixels: {
                options: {
                    sourceMap: true,
                    sourceMapName: 'dist/angular/ninepixels-core.min.map'
                },
                files: {
                    'dist/angular/ninepixels-core.min.js': [
                        'app/bower_components/angular/angular.js',
                        'app/bower_components/angular-cookies/angular-cookies.js',
                        'app/bower_components/angular-animate/angular-animate.js',
                        'app/bower_components/angular-file-upload/dist/angular-file-upload.js',
                        'app/bower_components/angular-bootstrap/ui-bootstrap-tpls.js',
                        'app/bower_components/underscore/underscore.js',
                        'app/bower_components/medium-editor/dist/js/medium-editor.js',
                        'app/bower_components/angular-medium-editor/dist/angular-medium-editor.js',
                        'app/bower_components/medium-editor-tables/dist/js/medium-editor-tables.js',
                        'app/angular/config.js',
                        'app/angular/api/api.js',
                        'app/angular/login/login.js',
                        'app/angular/site-controller/site-controller.js',
                        'app/angular/uploader/uploader.js',
                        'app/angular/editor/editor.js'
                    ]
                }
            }
        },
        copy: {
            main: {
                files: [
                    {expand: true, src: ['app/*'], dest: 'dist/', filter: 'isFile', flatten: true, dot: true},
                    {expand: true, src: ['app/templates/**/*'], dest: 'dist/templates', flatten: true},
                    {expand: true, src: ['app/globals/**/*'], dest: 'dist/assets/globals', flatten: true},
                    {expand: true, src: ['app/login/**/*'], dest: 'dist/login', flatten: true},
                    {expand: true, src: ['app/images/**/*'], dest: 'dist/assets/images', filter: 'isFile', flatten: true},
                    {expand: true, src: ['app/bower_components/bootstrap/dist/fonts/*'], dest: 'dist/assets/fonts', filter: 'isFile', flatten: true},
                    {expand: true, src: ['app/bower_components/font-awesome/fonts/*'], dest: 'dist/assets/fonts', filter: 'isFile', flatten: true}
                ]
            },
            angular: {
                files: [
                    {expand: true, src: ['app/angular/**/*.html'], dest: 'dist/angular/views/', flatten: true}
                ]
            },
            server: {
                files: [
                    {expand: true, src: ['server'], dest: 'dist/server'}
                ]
            }
        },
        clean: {
            options: {force: true},
            build: {
                src: ["dist", ".tmp"]
            }
        },
        watch: {
            options: {
                livereload: true
            },
            less: {
                files: 'app/**/*.less',
                tasks: ['less', 'cssmin']
            },
            vendor: {
                files: ['app/scripts/**/*.js'],
                tasks: 'uglify:app'
            },
            ninepixels: {
                files: ['app/angular/**/*.js'],
                tasks: 'uglify:ninepixels'
            },
            copy: {
                files: ['app/*', 'app/globals/*', 'app/images/*', 'app/templates/*'],
                tasks: 'copy:main'
            },
            angular: {
                files: ['app/angular/**/*.html'],
                tasks: 'copy:angular'
            }
        },
        open: {
            dev: {
                path: 'http://localhost/hotelcitysavoy/dist'
            }
        }
    });

    grunt.registerTask('develop', [
        'clean',
        'less',
        'cssmin',
        'uglify',
        'copy',
        'open',
        'watch'
    ]);

    grunt.registerTask('build', [
        'less',
        'cssmin',
        'uglify',
        'copy',
        'open',
        'watch'
    ]);

    grunt.registerTask('build-server', [
       'copy:server'
    ]);

    require('load-grunt-tasks')(grunt);
};
