var gulp = require('gulp')
;

gulp.task('default', function() {
    // No default task here
});

gulp.task('assets', function() {
  gulp.src('src/AppBundle/Resources/public/**')
    .pipe(
      gulp.dest('web/assets')
    )
  ;
  gulp.src([
    'bower_components/google-code-prettify/bin/prettify.min.css',
    'bower_components/google-code-prettify/styles/sunburst.css'
    ])
    .pipe(
      gulp.dest('web/assets/css')
    )
  ;
  gulp.src('bower_components/google-code-prettify/bin/prettify.min.js')
    .pipe(
      gulp.dest('web/assets/js')
    )
  ;
});