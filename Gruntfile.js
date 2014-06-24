module.exports = function(grunt) {

  // 1. Вся настройка находится здесь
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    concat: {
    options: {
      // define a string to put between each file in the concatenated output
      // separator: ';'
    },
    js: {
      src: 'js/*.js',
      dest: 'js/build/<%= pkg.name %>.js'
    },
    css: {
      src: ['css/default.css','css/fonts.css'],
      dest: 'css/style.css'
    }
  },

  uglify: {
    options: {
      banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
    },
    build: {
      src: 'js/build/<%= pkg.name %>.js',
      dest: 'js/build/<%= pkg.name %>.min.js'
    }
  },

  jshint: {
    options: {
      curly: true,
      eqeqeq: true,
      eqnull: true,
      browser: true,
      globals: {
        jQuery: true
      },
    },
    src: ['js/jquery_aalexeev.js']
  },

  imagemin: {
    dynamic: {
      files: [{
        expand: true,
        cwd: 'images/',
        src: ['**/*.{png,jpg,gif}'],
        dest: 'images/'
      }]
    }
  }, 

  less: {
    dist: {
      options: {
        // cleancss:"true"
      },

      src: 'less/style.less',
      dest: 'css/style.css'
    }
  },

  autoprefixer: {
    multiple_files: {
      expand: true, 
      flatten: true,
      src: 'css/style.css',
    },
  },

  cssmin: {
    options: {
      banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
    },
    dist: {
      src: 'css/style.css',
      dest: 'css/style.min.css'
    }
  },

  watch: {

    scripts: {
        files: ['js/**/*.js'],
        tasks: ['concat', 'uglify'],
        options: {
            spawn: false,
        },
    },

    less: {
      files: ['less/**/*.less'],
      tasks: ['less', 'autoprefixer', 'cssmin'],
      options: {
          spawn: false,
          livereload: true
      }
    },

    css: {
      files: ['!css/style*','css/*.css'],
      tasks: ['concat:css','autoprefixer','cssmin'],
      options: {
          spawn: false,
          livereload: true
      }
    },

    livereload: {
      options: { livereload: true },
      files: ['**/*.{html,php}','css/**/*.css','js/**/*.js']
    }
  }

  });

  // 3. Тут мы указываем Grunt, что хотим использовать этот плагин
  require('load-grunt-tasks')(grunt);

  // 4. Указываем, какие задачи выполняются, когда мы вводим «grunt» в терминале
  grunt.registerTask('default', ['concat','uglify','imagemin','less','autoprefixer','cssmin']);
  grunt.registerTask('js', ['concat','uglify']);
  grunt.registerTask('css', ['concat:css','autoprefixer','cssmin']);

};