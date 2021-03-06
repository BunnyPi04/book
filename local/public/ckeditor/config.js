/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	      //KCFinder      
     config.filebrowserBrowseUrl = '/public/admin/plugins/kcfinder/browse.php?opener=ckeditor&type=files';      
     config.filebrowserImageBrowseUrl = '/public/admin/plugins/kcfinder/browse.php?opener=ckeditor&type=images';      
     config.filebrowserFlashBrowseUrl = '/public/admin/plugins/kcfinder/browse.php?opener=ckeditor&type=flash';      
     config.filebrowserUploadUrl = '/public/admin/plugins/kcfinder/upload.php?opener=ckeditor&type=files';      
     config.filebrowserImageUploadUrl = '/public/admin/plugins/kcfinder/upload.php?opener=ckeditor&type=images';     
     config.filebrowserFlashUploadUrl = '/public/admin/plugins/kcfinder/upload.php?opener=ckeditor&type=flash';
};
