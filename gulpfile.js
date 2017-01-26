//Laravel Elixir
const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js');
});

//Google Webfonts
/*
var gulp = require('gulp');
var googleWebFonts = require('gulp-google-webfonts');

var options = { };

gulp.task('fonts', function () {
	return gulp.src('./fonts.list')
		.pipe(googleWebFonts(options))
		.pipe(gulp.dest('./public/css/out/fonts'))
		;
	});

gulp.task('default', ['fonts']);
*/
