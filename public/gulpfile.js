var gulp = require('gulp');
var _ = console.log;
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var debug = require('gulp-debug');

gulp.task('crear_controladores',function(){
  gulp.src('./js/angular/controladores/*.js')
  .pipe(debug())
  .pipe(concat('ng-controladores.js'))
  .pipe(uglify())
  .pipe(gulp.dest('./js/angular/'))
});

