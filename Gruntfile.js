/*global module:false */

'use strict';

module.exports = function(grunt) {

  // load all grunt tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  // Project configuration.
  grunt.initConfig({

    copy: {
      css : {
        files: {
          '_site/css/site.css': 'css/site.css'
        }
      }
    },

    compass: {
      dev: {
        options: {
          sassDir: 'sass',
          cssDir: 'css'
        }
      }
    },

    watch: {
      sass: {
        files: ['western-express/wp-content/themes/western-express/sass/*.scss'],
        tasks: ['compassCopy']
      },
      // files: [
      //   '_includes/*.html',
      //   '_layouts/*.html',
      //   '_posts/*.html',
      //   'index.html'
      // ],
      options: {
        // livereload: true,
        atBegin: true,
        interrupt: true,
        debounceDelay: 300
      }
    }

  });

  // watch
  grunt.registerTask('compassCopy', ['compass:dev', 'copy:css']);

  // Default task.
  grunt.registerTask('default', 'watch');

};