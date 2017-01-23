var gulp = require('gulp'),
		webserver = require('gulp-webserver'),
		exec = require('child_process').exec;

gulp.task('webserver', function() {
	gulp.src('./')
		.pipe(webserver({
			livereload: true,
			fallback: 'index.html',
			open: true
		}));
});

gulp.task('build', function (cb) {
	exec('php getdata.php > data.json', function (err, stdout, stderr) {
		console.log(stdout);
		console.log(stderr);
		cb(err);
	});
});