var gulp 			= require('gulp'),
    plumber 		= require('gulp-plumber'),
    sass 			= require('gulp-ruby-sass'),
    autoprefixer 	= require('gulp-autoprefixer'),
    minifycss 		= require('gulp-minify-css'),
    newer 			= require('gulp-newer'),
    imagemin 		= require('gulp-imagemin'),
    concat 			= require('gulp-concat'),
    git 			= require('gulp-git'),
    livereload 		= require('gulp-livereload');

gulp.task('styles', function(){
    return sass('sass/style.scss')
	    .on('error', function (err) {
	      	console.error('Error!', err.message);
	    })
	   	.pipe(minifycss())
	   	.pipe(gulp.dest('css'))
	   	.pipe(livereload())
});

gulp.task('scripts', function() {
  	return gulp.src([
             	'js/scripts.js'
  		])
    	.pipe(concat('scripts.js'))
    	.pipe(gulp.dest('js/'));
});

gulp.task('default', ['styles']);

gulp.task('watch', function() {

	livereload.listen({start:true});
      // Watch .scss files
    gulp.watch('sass/**/*', ['styles']);
    gulp.watch('js/**/*', ['scripts']);

});

gulp.task('init', function(){
  	git.init();
});

gulp.task('commit', function(){
  	return gulp.src('./*')
  	.pipe(git.add())
  	.pipe(git.commit('initial commit'));
});
gulp.task('setup',['styles','init','commit']);