/**
 * Sample language Gruntfile.
 * 
 * Copy this to your Known plugin root, rename to Gruntfile.js, and create a package.json 
 * with an appropriate "name" variable (usually your package namespace).
 */

/*jshint ignore:start*/
const sass = require('node-sass'); // Use Node SASS (wrapper around libsass)
/*jshint ignore:end*/

module.exports = function (grunt) {
    
    // Project configuration.
    grunt.initConfig({
	pkg: grunt.file.readJSON('package.json'),
	sass: {
	    options: {
		sourcemap: 'none',
		implementation: sass,
		noCache: true
	    },
	    dev: {
		files: {
		    'css/courseware.css': 'css/scss/courseware.scss',
		},
	    },
	    dist: {
		files: {
		    'css/courseware.min.css': 'css/scss/courseware.scss',
		},
		options: {
		  outputStyle: 'compressed'
		}
	    }
	}
    });
    
    
    grunt.loadNpmTasks('grunt-sass');
    
    
    grunt.registerTask('build-css', ['sass']);

    // Build your language file
    grunt.registerTask('build-lang', '', function(){
	
	const { execSync } = require('child_process');
	
	var pot = grunt.config.get('pkg.name').toLowerCase() + '.pot';
	
	console.log("Building language file as ./languages/" + pot);
	
	execSync('touch ./languages/' + pot); // Make sure it exists, if we're going to remove (for broken builds)
	execSync('rm ./languages/' + pot); // Remove existing
	
	execSync('find . -type f -regex ".*\.php" | php vendor/mapkyca/known-language-tools/buildpot.php >> ./languages/' + pot); 
	
    });
    
    
    grunt.registerTask('default', ['build-css', 'build-lang']);

};