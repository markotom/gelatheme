'use strict';

module.exports = function (grunt) {
  
  // Load all grunt tasks
  require('load-grunt-tasks')(grunt);

  // Config
  grunt.initConfig({

    // Compile less files
    less: {
      development: {
        options: {
          paths: [ 'less' ]
        },
        files: {
          'css/style.css': 'less/style.less'
        }
      },
      production: {
        options: {
          paths: [ 'less' ],
          cleancss: true
        },
        files: {
          'css/style.css': 'less/style.less'
        }
      }
    },

    // Watch
    watch: {
      less: {
        files: [ 'less/*.less' ],
        tasks: [ 'less:development' ],
        options: { nospawn: true }
      },
      livereload: {
        options: { livereload: true },
        files: [
          '**/*.less',
          '**/*.php'
        ]
      }
    },

    // Handle releases
    release: {
      options: {
        commit: true,
        push: false,
        pushTags: false,
        npm: false,
        commitMessage: 'Release <%= version %>',
        tagMessage: 'Version <%= version %>'
      }
    }

  });

  // Build Task
  grunt.registerTask('build', [ 'less:production' ]);

};
