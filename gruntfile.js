'use strict';
module.exports = function (grunt) {

	// load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),
		
		// Gulp can't do what I need well enough
		compress: {
			main: {
				options: {
					archive: 'kwaske_th_17.zip'
				},
				files: [
					{expand: true, dot: true, src: ['./kwaske_th_17/**/*.*'], dest: './'}
				]
			}
		}

	});
	
};