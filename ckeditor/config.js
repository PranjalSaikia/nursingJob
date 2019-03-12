/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' },
		
	];
	

 
 
	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	
};

//==============================================================

CKEDITOR.editorConfig = function (config) {
// Define changes to default configuration here. For example:
// config.language = 'fr';
// config.uiColor = '#AADC6E';
CKEDITOR.on('instanceReady', function (ev) {
    var writer = ev.editor.dataProcessor.writer;
    // The character sequence to use for every indentation step.
    writer.indentationChars = '  ';

    var dtd = CKEDITOR.dtd;
    // Elements taken as an example are: block-level elements (div or p), list items (li, dd), and table elements (td, tbody).
    for (var e in CKEDITOR.tools.extend({}, dtd.$block, dtd.$listItem, dtd.$tableContent)) {
        ev.editor.dataProcessor.writer.setRules(e, {
            // Indicates that an element creates indentation on line breaks that it contains.
            indent: false,
            // Inserts a line break before a tag.
            breakBeforeOpen: false,
            // Inserts a line break after a tag.
            breakAfterOpen: false,
            // Inserts a line break before the closing tag.
            breakBeforeClose: false,
            // Inserts a line break after the closing tag.
            breakAfterClose: false
        });
    }

    for (var e in CKEDITOR.tools.extend({}, dtd.$list, dtd.$listItem, dtd.$tableContent)) {
        ev.editor.dataProcessor.writer.setRules(e, {
            indent: true,
        });
    }



});
}







