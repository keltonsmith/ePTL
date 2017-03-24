$(document).ready(function () {
    $('#add-more-but').click(function() {
        var last_div = $('.add-more-file-div').prev(), last_file_ipt = $(last_div).find("input");
//            var last_ipt_name = $(last_file_ipt[0]).attr('name'), cur_ipt_cnt = parseInt(last_ipt_name.replace( /[^\d.]/g, '' )), new_ipt_name = 'file' + (cur_ipt_cnt + 1).toString();

        var new_file_div = '<div class="fileinput fileinput-new input-group" data-provides="fileinput">' +
                                '<div class="form-control" data-trigger="fileinput"><i' +
                                'class="glyphicon glyphicon-file fileinput-exists"></i>' +
                                    '<span class="fileinput-filename"></span>' +
                                '</div>' +
                                '<a data-toggle="modal" data-target=".bd-example-modal-lg" class="input-group-addon btn btn-default fileinput-exists preview-image-a">' +
                                'Preview</a>' +
                                '<span class="input-group-addon btn btn-default btn-file text-400">' +
                                    '<span class="fileinput-new">Select file</span>' +
                                    '<span class="fileinput-exists">Change</span>' +
                                    '<input class="preview-image-input" name="files[]" type="file">' +
                                '</span>' +
                                '<a href="#" class="input-group-addon btn btn-default fileinput-exists"' +
                                'data-dismiss="fileinput">Remove</a>' +
                            '</div>';
        $(last_div).after(new_file_div);
//            $(last_div).next().find("input").attr('name', new_ipt_name);
//            $('.add-more-file-div').next().val(cur_ipt_cnt + 1);
    });

    $('form').on('click', '.add-more-but', function() {
    // $('.add-more-but').click(function() {
        var image_ipt_name = $(this).attr('data-content');
        var last_div = $('.add-more-file-div-' + image_ipt_name).prev(), last_file_ipt = $(last_div).find("input");
//            var last_ipt_name = $(last_file_ipt[0]).attr('name'), cur_ipt_cnt = parseInt(last_ipt_name.replace( /[^\d.]/g, '' )), new_ipt_name = 'file' + (cur_ipt_cnt + 1).toString();

        var new_file_div = '<div class="fileinput fileinput-new input-group" data-provides="fileinput">' +
            '<div class="form-control" data-trigger="fileinput"><i' +
            'class="glyphicon glyphicon-file fileinput-exists"></i>' +
            '<span class="fileinput-filename"></span>' +
            '</div>' +
            '<a data-toggle="modal" data-target=".bd-example-modal-lg" class="input-group-addon btn btn-default fileinput-exists preview-image-a">' +
            'Preview</a>' +
            '<span class="input-group-addon btn btn-default btn-file text-400">' +
            '<span class="fileinput-new">Select file</span>' +
            '<span class="fileinput-exists">Change</span>' +
            '<input class="preview-image-input" name="' + image_ipt_name + '[]" type="file">' +
            '</span>' +
            '<a href="#" class="input-group-addon btn btn-default fileinput-exists"' +
            'data-dismiss="fileinput">Remove</a>' +
            '</div>';
        $(last_div).after(new_file_div);
//            $(last_div).next().find("input").attr('name', new_ipt_name);
//            $('.add-more-file-div').next().val(cur_ipt_cnt + 1);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview-modal-img-description').text('Name: ' + input.files[0].name + ', Type: ' + input.files[0].type);
                $('#preview-modal-img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('click', '.preview-image-a', function() {
        var img_ipt = $(this).next().find('input.preview-image-input');
        readURL(img_ipt[0]);
    });
});