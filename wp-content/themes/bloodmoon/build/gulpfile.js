'use strict';

var gulp = require('gulp');
var rollup = require('rollup-stream');
var source = require('vinyl-source-stream');

var sass = require('gulp-sass');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', function () {
    return gulp.src('./../sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest('./../'));
});

gulp.task('default', function() {
    gulp.watch('./../sass/**/*.scss', ['sass']);
    gulp.watch('./../js/modules/*.js', ['bundle']);
});


/*
 * Scripts
 */

gulp.task('bundle', function(){
    return rollup({
            input: './../js/main.js'
        })
        .pipe(source('app.js'))
        .pipe(gulp.dest('./../js/dist'));
});

