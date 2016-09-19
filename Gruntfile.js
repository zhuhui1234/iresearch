module.exports = function (grunt) {
    'use strict';
    var arrModules = require('./grunt/module-config.js');
    //获取autoprefixer配置
    var autoprefixer = grunt.file.readJSON('autoprefixer.json', {encoding: 'utf8'});
    //项目配置
    grunt.initConfig({
        //读取packgae.json文件
        pkg: grunt.file.readJSON('package.json'),
        clean: {
            js: 'public/js',
            css: 'public/css',
            public: ['public']
        },
        //拷贝任务
        copy: {
            fonts: {
                expand: true,
                cwd: 'dev/fonts',
                src: '**/*',
                dest: 'public/fonts'
            }
        },
        //构建模块
        requirejs: {
            build: {
                options: {
                    // appDir: './dev',
                    baseUrl: './dev/js',
                    dir: 'public/js',
                    optimize: 'uglify',
                    mainConfigFile: 'dev/js/config.js',
                    optimizeCss: 'standard',
                    modules: arrModules,
                    paths:{
                        wxLogin: "empty:"
                    }
                }
            }
        },
        //压缩js
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %>-<%= pkg.version%>-<%= grunt.template.today("yyyy-mm-dd") %> */\n',
                compress: {
                    drop_console: true //删除console语句
                },
                preserveComments: true //删除注释
            },
            dist: {
                expand: true,
                cwd: 'public/js/',
                src: '**/*.js',
                dest: 'public/js/'
            }
        },
        //编译less
        less: {
            compileCore: {
                options: {
                    strictMath: true,
                    sourceMap: true,
                    outputSourceFiles: true,
                    sourceMapURL: 'app.css.map',
                    sourceMapFilename: 'public/css/app.css.map'
                },
                files: {
                    'public/css/app.css': 'dev/less/app.less'
                }
            },
            compileDocs: {
                options: {
                    strictMath: true,
                    sourceMap: true,
                    outputSourceFiles: true,
                    sourceMapURL: 'docs.css.map',
                    sourceMapFilename: 'public/css/docs.css.map'
                },
                files: {
                    'public/css/docs.css': 'dev/less/docs.less'
                }
            }
        },
        //压缩css
        cssmin: {
            //文件头部输出信息
            options: {
                banner: '/*! <%= pkg.name %>-<%= pkg.version%>: <%= grunt.template.today("yyyy-mm-dd") %> */\n',
                sourceMap: true,
                beautify: {
                    ascii_only: true  //中文ascii化！防止中文乱码
                }
            },
            minify: {
                expand: true,
                //相对路径
                cwd: 'public/css',
                src: '*.css',
                dest: 'public/css/',
                rename: function (dest, src) {
                    var folder = src.substring(0, src.lastIndexOf('/'));
                    var filename = src.substring(src.lastIndexOf('/'), src.length);
                    //  var filename=src;
                    filename = filename.substring(0, filename.lastIndexOf('.'));
                    var fileresult = dest + folder + filename + '.min.css';
                    grunt.log.writeln("现处理文件：" + src + "  处理后文件：" + fileresult);
                    return fileresult;
                }
            }
        },
        //优化css属性顺序
        csscomb: {
            options: {
                banner: '/*! <%= pkg.name %>-<%= pkg.version%>-<%= grunt.template.today("yyyy-mm-dd") %> */\n',
                config: '.csscomb.json'
            },
            dist: {
                expand: true,
                cwd: 'public/css/',
                src: ['*.css', '!*.min.css'],
                dest: 'public/css/'
            }
        },
        //自动添加浏览器前缀
        autoprefixer: {
            options: {
                browsers: autoprefixer.autoprefixerBrowsers
            },
            core: {
                options: {
                    map: true
                },
                src: ['public/css/<%= pkg.name %>.css', 'public/css/docs.css']
            }
        },
        //压缩图像任务
        imagemin: {
            /* 压缩图片大小 */
            dist: {
                options: {
                    optimizationLevel: 3 //定义 PNG 图片优化水平
                },
                files: [
                    {
                        expand: true,
                        cwd: 'dev/img',
                        src: ['**/*.{png,jpg,jpeg}'], // 优化 img 目录下所有 png/jpg/jpeg 图片
                        dest: 'public/img' // 优化后的图片保存位置，覆盖旧图片，并且不作提示
                    }
                ]
            }
        },
        //js检验
        jshint: {
            options:{
                all: ['Gruntfile.js', 'dev/js/app/*.js', 'dev/js/common/*.js', 'dev/js/config.js'],
                reporterOutput: '' 
            }
        },
        //css检验
        csslint: {
            options: {
                csslintrc: '.csslintrc'
            },
            dist: [
                'public/css/app.css',
                'public/css/docs.css'
            ]
        },
        //实时观察配置
        watch: {
            js: {
                files: 'dev/js/**/*',
                tasks: 'watchjs'
            },
            css: {
                files: ['dev/less/**/*.less'],
                tasks: 'watchcss'
            }
        }
    });
    //压缩js
    grunt.loadNpmTasks('grunt-contrib-uglify');
    //拷贝图象字体
    grunt.loadNpmTasks('grunt-contrib-copy');
    //优化css属性顺序
    grunt.loadNpmTasks('grunt-csscomb');
    //检查css错误
    grunt.loadNpmTasks('grunt-contrib-csslint');
    //编译Less
    grunt.loadNpmTasks('grunt-contrib-less');
    //压缩CSS
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    //添加浏览器前缀
    grunt.loadNpmTasks('grunt-autoprefixer');
    //压缩requirejs模块
    grunt.loadNpmTasks('grunt-contrib-requirejs');
    //实时更新改动的js和scss
    grunt.loadNpmTasks('grunt-contrib-watch');
    //js错误检查
    grunt.loadNpmTasks('grunt-contrib-jshint');
    //清除public所有文件
    grunt.loadNpmTasks('grunt-contrib-clean');
    //压缩图像
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    //样式规范检查
    grunt.loadNpmTasks('grunt-contrib-csslint');
    // 默认grunt任务
    grunt.registerTask('default', ['clean', 'jshint', 'requirejs', 'uglify', 'less', 'autoprefixer', 'csscomb', 'csslint', 'cssmin', 'imagemin', 'copy']);
    // //实时观察改变并编译
    // grunt.registerTask('watch', ['clean:css','clean:js','less','autoprefixer','csscomb','csslint','cssmin','jshint','requirejs']);
    //只编译sass
    grunt.registerTask('watchcss', ['clean:css', 'less', 'autoprefixer', 'csscomb', 'csslint', 'cssmin']);
    //实时观察JS变化
    grunt.registerTask('watchjs', ['clean:js', 'jshint', 'jshint', 'requirejs']);
};
