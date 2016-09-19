define(['jquery', 'upload'], function($) {
	console.log('Module upload loaded.');
	$(function() {
        $('#input01').filestyle({
            buttonText : '选择文件',
            placeholder: '上传文件',
            iconName : 'fa fa-folder-open'
        });
        $('#input02').filestyle({
            buttonName : 'btn-primary',
            placeholder: '上传文件',
            buttonText : '选择文件',
            iconName : 'fa fa-folder-open'
        });
        $('#input03').filestyle({
            iconName : 'fa fa-plus',
            buttonText : '上传'
        });
        $('#input04').filestyle({
            disabled : true,
            buttonText : '选择文件'
        });
        $('#input05').filestyle({
            input : false,
            buttonText: '上传文件',
            buttonName : 'btn-primary'
        });

        $('#clear').click(function() {
            $('#input02').filestyle('clear');
        });

	});
});