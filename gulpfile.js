var gulp = require('gulp'),
    less = require('gulp-less'),
    cssmin = require('gulp-cssmin'),
    rename = require('gulp-rename'),
    sys = require('sys'),
    exec = require('gulp-exec')
;

var bower = 'bower_components/';

gulp.task('styles', function() {
  gulp.src('app/Resources/public/less/main.less')
    .pipe(less())
    .pipe(cssmin())
    .pipe(rename({basename: 'compiled', suffix: '.min'}))
    .pipe(
      gulp.dest('web/assets/css')
    )
  ;
  gulp.src([
    bower + 'highlightjs/styles/monokai_sublime.css'
    ])
    .pipe(
      gulp.dest('web/assets/css')
    )
  ;
  gulp.src('app/Resources/public/css/*')
    .pipe(
      gulp.dest('web/assets/css')
    )
  ;
});
gulp.task('fonts', function() {
  gulp.src(bower + 'bootstrap/fonts/*')
    .pipe(
      gulp.dest('web/assets/fonts')
    )
  ;
});
gulp.task('images', function() {
  gulp.src(
    'app/Resources/public/img/*')
    .pipe(
      gulp.dest('web/assets/img')
    )
  ;
});
gulp.task('scripts', function() {
  gulp.src('app/Resources/public/js/*')
    .pipe(
      gulp.dest('web/assets/js')
    )
  ;
  gulp.src(bower + 'highlightjs/highlight.pack.js')
    .pipe(
      gulp.dest('web/assets/js')
    )
  ;
});

gulp.task('test', function() {
    gulp.src('./src/AppBundle/Tests/**/*Test.php').pipe(
        exec('phpunit -c app/', function(error, stdout){
            sys.puts(stdout);
            return false;
        })
    );
});

gulp.task('default', ['styles', 'fonts', 'scripts', 'images']);