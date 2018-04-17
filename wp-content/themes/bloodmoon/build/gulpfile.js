'use strict';

//VARS

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');

//SCSS

//look for every scss file in whatever directory we tell the function to look
gulp.task('sass', function () {
    return gulp.src('./../sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest('./../'));
});

//auto watch
gulp.task('default', function() {
    gulp.watch('./../sass/**/*.scss', ['sass']);
});

