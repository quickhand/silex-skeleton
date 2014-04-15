module.exports = function(grunt) {

    // Configuration goes here
    grunt.initConfig({
        recess: {
            build: {
                src: grunt.file.read('./static/lessorder').replace(/^\s+|\s+$/g, '').split(/\r?\n/),
                dest: 'web/pub/css/combined.css',
                options: {
                    compile: true,
                    compress: true
                }
            }
        },
        uglify: {

            options: {
                mangle: false
            },
            my_target: {
                files: {
                    'web/pub/js/combined.min.js': grunt.file.read('./static/jsorder').replace(/^\s+|\s+$/g, '').split(/\r?\n/)
                }
            }

        },
        watch: {
            scripts: {
                files: grunt.file.read('./static/jsorder').replace(/^\s+|\s+$/g, '').split(/\r?\n/),
                tasks: ['uglify'],
                options: {
                },
            },
            stylesheets: {
                files: grunt.file.read('./static/lessorder').replace(/^\s+|\s+$/g, '').split(/\r?\n/),
                tasks: ['recess'],
                options: {
                },
            }
        }

    });

    // Load plugins here
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-recess');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Define your tasks here

    grunt.registerTask(
        'build', 
        'Compiles all of the assets and copies the files to the build directory.', 
        ['recess','uglify']
    );
};
