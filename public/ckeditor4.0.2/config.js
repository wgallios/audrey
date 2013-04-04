/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';


    config.filebrowserBrowseUrl = '/public/ckfinder2.3.1/ckfinder.html';
    config.filebrowserImageBrowseUrl = '/public/ckfinder2.3.1/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = '/public/ckfinder2.3.1/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = '/public/ckfinder2.3.1/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = '/public/ckfinder2.3.1/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = '/public/ckfinder2.3.1/core/connector/php/connector.php?command=QuickUpload&type=Flash';

    config.extraPlugins = 'maxheight';



};
