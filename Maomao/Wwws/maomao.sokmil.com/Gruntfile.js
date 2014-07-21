module.exports = function (grunt) {
	// config 
	grunt.initConfig({
		
		/*
		 task : {
			options: {
				
			},
			target1: {
				options: {

				},
				設定
			},
			target2: {
				設定
			}
		 }
		 */
		
		
		
		less: {
			build: {
				/*
				src: 'css/src/style.less',
				dest: 'css/style.css'
				*/
			   files: {
				   // dest:src
				   // 'css/style.css':'css/src/style.less'
				   // 'css/style.css':['css/src/style1.less','css/src/style2.less']
				   // 'css/style.css':'css/src/*.less'
				   // 'css/style.css':'css/src/**/*.less'
			   }
			}
		},
		
		csslint: {
			check: {
				// src: 'css/style.css'
				src: '<%= less.build.dest %>'
			}
		}
		
		
		
	});
	// plugin
	grunt.loadNpmTasks('grunt-contrib-less');
	
	// tasks
	grunt.registerTask('default', ['less', 'csslint']);
};