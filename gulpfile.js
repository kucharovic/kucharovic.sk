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
});