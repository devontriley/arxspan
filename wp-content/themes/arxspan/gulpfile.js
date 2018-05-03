'use strict';

var gulp = require('gulp');
var webpack = require('webpack');
var webpackStream = require('webpack-stream');
var webpackConfig = require('./webpack.config.js');
var sass = require('gulp-sass');
var cleanCSS = require('gulp-clean-css');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', function () {
    return gulp.src('./sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./'));
});

/*
 * Scripts
 */

gulp.task('webpack', function() {
   gulp.src('./js/main.js')
       .pipe(webpackStream(webpackConfig), webpack)
       .pipe(gulp.dest('./js/dist'));
});

/*
 * Watch
 */

gulp.task('default', function() {
    gulp.watch('./sass/**/*.scss', ['sass']);
    gulp.watch('./js/*.js', ['webpack']);
});

