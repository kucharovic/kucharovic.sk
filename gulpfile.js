var gulp = require('gulp'),
    less = require('gulp-less'),
    cssmin = require('gulp-cssmin'),
    rename = require('gulp-rename'),
    sys = require('sys'),
    exec = require('gulp-exec')
;

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
    'bower_components/typeplate-starter-kit/css/typeplate.css',
    'bower_components/google-code-prettify/bin/prettify.min.css',
    'bower_components/google-code-prettify/styles/sunburst.css'
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
  gulp.src('bower_components/google-code-prettify/bin/prettify.min.js')
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

gulp.task('default', ['styles', 'scripts', 'images']);