var gulp    = require('gulp'),
    notify  = require('gulp-notify'),
    run     = require('gulp-run')
    phpspec = require('gulp-phpspec');

gulp.task('phpspec', function() {
    gulp.src('spec/**/*.php')
        .pipe(run('clear'))
        .pipe(phpspec('', { 'verbose': 'v', notify: true, debug: true }))
        .on('error', notify.onError({
            title: "Testing Failed",
            message: "Error(s) occurred during test...",
            icon: __dirname + '/fail.png'
        }))
        .pipe(notify({
            title: "Success",
            message: "All tests have returned green!"
        }));;
});

// set watch task to look for changes in test files
gulp.task('watch', function () {
    gulp.watch('spec/**/*.php', ['phpspec']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['phpspec', 'watch']);