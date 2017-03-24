@extends('layouts.app')

<style>
    .notes-list {
        width: 100%;
        text-align: right;
        margin: 10px 0;
    }
    .radio-list {
        width: 100%;
        float: left;
    }
    .radio-list > div {
        float: left !important;
        /*width: 50% !important;*/
    }
    .radio-list > div:last-child {
        margin-left: 10px;
        margin-top: 10px !important;
    }
</style>

@section('content')
    @include('internal._partials.preview')
    <div class="content" style="margin-top: -480px">
        <div class="container mt-30 mb-30">
            @include('internal.pw.project.questions._partials.top')
            @include('internal.pw.project.questions._partials.specialist')
            {{--<div class="form-title row-table text-500 mt-30">--}}
                {{--<div class="col-cell cell-icon">--}}
                    {{--<i class="zmdi zmdi-n-2-square text-muted mr-5"></i>--}}
                {{--</div>--}}
                {{--<div class="col-cell pl-10">--}}
                    {{--Site Inspection Checklist--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<hr class="mt-10 mb-30">--}}
            {{--<div class="panel panel-table mb-30 mt-10">--}}
                {{--<table class="site-inspection-checklist-table datatabless td-middle table ma-0">--}}
                    {{--<thead>--}}
                    {{--<tr align="text-center">--}}
                        {{--<th class="tight">No.</th>--}}
                        {{--<th width="350">Description</th>--}}
                        {{--<th>Compliance Status</th>--}}
                        {{--<th align="center">Notes</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}

                    {{--<tbody>--}}
                    {{--@foreach(trans('pw.questions.highway') as $questionNum => $question)--}}
                        {{--<tr>--}}
                            {{--<td class="tight">{{ (intval($questionNum)+1) }}</td>--}}
                            {{--<td>{!! $question['description'] !!}</td>--}}
                            {{--<td>--}}
                                {{--@for($i=0;$i<$question['statusesCount'];$i++)--}}
                                {{--<div class="radio-list">--}}
                                {{--@foreach($question['statuses'] as $no => $status)--}}
                                    {{--<div class="radio" data-content="{{ $status['text'] }}">--}}
                                        {{--<input type="radio"--}}
                                               {{--id="q{{$questionNum}}_{{$i}}_{{$no}}"--}}
                                               {{--name="q{{$questionNum}}_{{$i}}"--}}
                                               {{--value="{{$status['value']}}"--}}
                                        {{--@if(old('q'.$questionNum.'_'.$i) == $no)--}}
                                            {{--{{'checked=checked'}}@endif--}}
                                        {{-->--}}
                                        {{--{!! Form::label('q'.$questionNum.'_'.$i."_".$no, $status['text']) !!}--}}
                                    {{--</div>--}}
                                {{--@endforeach--}}
                                {{--</div>--}}
                                {{--@endfor--}}
                            {{--</td>--}}
                            {{--<td class="text-right">--}}
                                {{--@for($i=1;$i<=$question['statusesCount'];$i++)--}}
                                {{--<div class="notes-list">--}}
                                {{--{!! Form::textarea(--}}
                                {{--'q'.$questionNum.'_' . $i .'_note',--}}
                                {{--old('q'.$questionNum.'_' . $i . 'note'),--}}
                                {{--['rows' => 3, 'cols' => 30]) !!}--}}
                                {{--</div>--}}
                                {{--@endfor--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}

            @include('internal.pw.project.questions._partials.files')
            @include('internal.pw.project.questions._partials.bottom')
        </div><!--end.row-->
    </div>
    </div>
@endsection


@section('script')
<script>
    // Initialize the datePicker
    $("#datepicker").pickadate({
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd',
        hiddenName: true,
        datepicker: true
    });

    $(document).ready(function () {
        $('#add-more-but').click(function() {
            var last_div = $('.add-more-file-div').prev(), last_file_ipt = $(last_div).find("input");
//            var last_ipt_name = $(last_file_ipt[0]).attr('name'), cur_ipt_cnt = parseInt(last_ipt_name.replace( /[^\d.]/g, '' )), new_ipt_name = 'file' + (cur_ipt_cnt + 1).toString();

            var new_file_div = '<div class="fileinput fileinput-new input-group" data-provides="fileinput">' +
                                    '<div class="form-control" data-trigger="fileinput"><i' +
                                    'class="glyphicon glyphicon-file fileinput-exists"></i>' +
                                        '<span class="fileinput-filename"></span>' +
                                    '</div>' +
                                    '<a data-toggle="modal" data-target=".bd-example-modal-lg" class="input-group-addon btn btn-default fileinput-exists preview-image-a"' +
                                    '>{{trans('apply.files.buttons.preview')}}</a>' +
                                    '<span class="input-group-addon btn btn-default btn-file text-400">' +
                                        '<span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>' +
                                        '<span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>' +
                                        '{!! Form::file("files[]", array("class" => "preview-image-input")) !!}' +
                                    '</span>' +
                                    '<a href="#" class="input-group-addon btn btn-default fileinput-exists"' +
                                    'data-dismiss="fileinput">{{trans('apply.files.buttons.remove')}}</a>' +
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


        $(document).on('click', '.preview-existing-image-a', function() {
            var img_path = $(this).attr('data-path');
            var inspection_id = $(this).attr('data-inspection');
            $('#preview-modal-img').attr('src', '/inspections/' + inspection_id + '/' + img_path);
        });
    });
</script>
@endsection