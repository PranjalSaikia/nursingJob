(function(){
    //Section 1 : Code to execute when the toolbar button is pressed
    var editorCustom;
    var a = {
        exec:function(editor){
            editorCustom = editor;
            var theSelectedText = "";
            var mySelection = editor.getSelection();

            if (CKEDITOR.env.ie) {
                mySelection.unlock(true);
                theSelectedText = mySelection.getNative().createRange().text;
            } else {
                theSelectedText = mySelection.getNative();
            }

            var backgroundHtmlStyle = " style='background-color: white; ";
            backgroundHtmlStyle += " height: " + $(window).height() + "px; ";
            backgroundHtmlStyle += " width: " + $(document).width() + "px; ";
            backgroundHtmlStyle += " left: 0; opacity: 0.5; position: fixed; top: 0; z-index: 500; ' ";
            var backgroundHtml = "<div class='ck-editor-image-upload-background' "+backgroundHtmlStyle+"></div>";
            $("body").append(backgroundHtml);

            var uploadFormHtml = "<div class='ck-editor-image-upload'><form id='ck-editor-image-upload-form' accept='utf-8' method=\"post\" enctype=\"multipart/form-data\" accept-charset=\"utf-8\" > ";
            uploadFormHtml += "<div><span class='1'>Upload Image File</span><span class='2'></span><input type=\"file\" name=\"file\" class=\"file\"/></div>";
            uploadFormHtml += "</form></div>";

            jQuery.dialogFromHTML("Insert Image", uploadFormHtml, {width: 400});

            $(".ck-editor-image-upload").find(".file").bind("change", function() {
                $("#ck-editor-image-upload-form").attr("action", BASE_URL + "custom_image/upload_ck_editor_image");
                $("#ck-editor-image-upload-form").ajaxForm({
                    beforeSubmit: function() {
                        jQuery.showBackgroundWorkingState();
                    },
                    success: function(data) {
                        if(data != "error" && data != "unsupported") {
                            var imageLocation = CK_EDITOR_IMAGE_DIR + data;
                            var imageHtml = "<img src='"+imageLocation+"' alt='"+data+"'/>";

                            try {
                                editorCustom.insertHtml(imageHtml);
                            } catch (ex) {
                                var content = editorCustom.getData() + "<p>" + imageHtml + "</p>";
                                editorCustom.setData(content);
                            }
                        } else {
                            jQuery.showWarning("File uploading error, please try again");
                        }
                        jQuery.closeAllDialog();
                        jQuery.hideBackgroundWorkingState();
                        jQuery(".ck-editor-image-upload-background").remove();
                    },
                    error: function() {
                        jQuery.showWarning("File uploading error, please try again");
                        jQuery.closeAllDialog();
                        jQuery.hideBackgroundWorkingState();
                        jQuery(".ck-editor-image-upload-background").remove();
                    }
                }).submit();
            });
        }
    },
    //Section 2 : Create the button and add the functionality to it
    b='imageUploader';
    CKEDITOR.plugins.add(b,{
        init:function(editor){
            editor.addCommand(b,a);
            editor.ui.addButton('imageUploader',{
                label:'Insert Image',
                icon: this.path + 'icon.gif',
                command:b
            });
        }
    });
})();