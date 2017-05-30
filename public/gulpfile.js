var gulp = require('gulp');
var _ = console.log;
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var debug = require('gulp-debug');
var jsValidate = require('gulp-jsvalidate');


gulp.task('validar_javascript', function () {
    return gulp.src('./js/*.js')
        .pipe(jsValidate());
});

gulp.task('compilar_archivos_angular',['validar_javascript'],function(){
    //'!./js/angular/**/ng-*.js'
    gulp.src(['./js/angular/**/*.js'])
        .pipe(debug())
        .pipe(concat('ng-app.min.js'))
        .pipe(uglify()).on('error', function (e) {
            _("Ha ocurrido un error \n %s", e.message);
        })
        .pipe(gulp.dest('./js/'))
});


gulp.task('listen_modificaciones',['compilar_archivos_angular'],function(){
    gulp.watch('./js/angular/*.js', ['compilar_archivos_angular'], function(e){
        _("archivo %s [%s]",e.type,e.path);
    })
});
