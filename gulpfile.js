'use strict';
// generated on 2014-09-14 using generator-gulp-webwebsite 0.1.0

var gulp = require('gulp');

// load plugins
var $ = require('gulp-load-plugins')();

gulp.task('styles', function () {
    return gulp.src('website/css/*')
        /*.pipe($.rubySass({
            style: 'expanded',
            precision: 10
        }))
*/
        //.pipe($.autoprefixer('last 1 version'))
        .pipe(gulp.dest('dist/css'))
        .pipe($.size());
});

gulp.task('scripts', function () {
    return gulp.src('website/js/**/*.js')
        //.pipe($.jshint())
        //.pipe($.jshint.reporter(require('jshint-stylish')))
        .pipe(gulp.dest('dist/js'))
        .pipe($.size());
});

gulp.task('html', ['styles', 'scripts'], function () {
    var jsFilter = $.filter('**/*.js');
    var cssFilter = $.filter('**/*.css');

    return gulp.src('website/*.html')
        .pipe($.useref.assets({searchPath: '{.tmp,website}'}))
        .pipe(jsFilter)
        .pipe($.uglify())
        .pipe(jsFilter.restore())
        .pipe(cssFilter)
        .pipe($.csso())
        .pipe(cssFilter.restore())
        .pipe($.useref.restore())
        .pipe($.useref())
        .pipe(gulp.dest('dist'))
        .pipe($.size());
});

gulp.task('images', function () {
    return gulp.src('website/img/**/*')
/*        .pipe($.cache($.imagemin({
            optimizationLevel: 3,
            progressive: true,
            interlaced: true
        }))) 
*/
        .pipe(gulp.dest('dist/img'))
        .pipe($.size());
});

gulp.task('fonts', function () {
    return $.filter('**/*.{eot,svg,ttf,woff}')
        .pipe($.flatten())
        .pipe(gulp.dest('dist/fonts'))
        .pipe($.size());
});

gulp.task('extras', function () {
    return gulp.src(['website/*.*', '!website/*.html'], { dot: true })
        .pipe(gulp.dest('dist'));
});

gulp.task('clean', function () {
    return gulp.src(['.tmp', 'dist'], { read: false }).pipe($.clean());
});

gulp.task('build', ['html','images','fonts', 'extras']);

gulp.task('default', ['clean'], function () {
    gulp.start('build');
});

gulp.task('connect', function () {
    var connect = require('connect');
    var website = connect()
        .use(require('connect-livereload')({ port: 35729 }))
        .use(connect.static('website'))
        .use(connect.static('.tmp'))
        .use(connect.directory('website'));

    require('http').createServer(website)
        .listen(9000)
        .on('listening', function () {
            console.log('Started connect web server on http://localhost:9000');
        });
});

gulp.task('serve', ['connect', 'styles'], function () {
    require('opn')('http://localhost:9000');
});

gulp.task('watch', ['connect', 'serve'], function () {
    var server = $.livereload();

    // watch for changes

    gulp.watch([
        'website/*.html',
        '.tmp/css/**/*.css',
        'website/js/**/*.js',
        'website/img/**/*'
    ]).on('change', function (file) {
        server.changed(file.path);
    });

    gulp.watch('website/css/**/*.scss', ['styles']);
    gulp.watch('website/js/**/*.js', ['scripts']);
    gulp.watch('website/img/**/*', ['images']);
});
