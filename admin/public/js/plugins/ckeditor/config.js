/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.filebrowserBrowseUrl = 'public/js/plugins/ckfinder/ckfinder.html';
    config.filebrowserUploadUrl = 'public/js/plugins/ckfinder/core/connector/php/vendor/connector.php?command=QuickUpload&type=Files';
};
