var gulp        = require('gulp');
var browserSync = require('browser-sync');

// Static server
gulp.task('serve', function() {
    browserSync({
        server: {
            baseDir: "./website/"
        }
    });
});

gulp.task('bs-reload', function () {
    browserSync.reload();
});

gulp.task('default', ['serve'], function () {
    gulp.watch("website/*.html", ['bs-reload']);
    gulp.watch("website/css/*.css", ['bs-reload']);
    gulp.watch("website/js/*.js", ['bs-reload']);
});