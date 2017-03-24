@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container mt-30 mb-30">
            <div class="panel panel-table pt-20 pb-20" style="overflow: auto;">
                <table class="table-action table" id="datatable">
                    <thead>
                    <tr>
                        <th>{{trans('dash.columns.no')}}</th>
                        <th>{{trans('dash.columns.app_id')}}</th>
                        <th>{{trans('dash.columns.fee_category')}}</th>
                        <th>{{trans('dash.columns.breakdown')}}</th>
                        <th>{{trans('dash.columns.total_payments')}}</th>
                        <th>{{trans('dash.columns.payment_date')}}</th>

                        <!-- <th>{{trans('dash.columns.pay_state')}}</th> -->

                        <th>{{trans('dash.columns.status')}}</th>
                        <th>{{trans('dash.columns.no_payment_slip')}}</th>
                        <th class="tight no_filter">{{trans('dash.columns.actions')}}</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
    <div id="action"></div>
    @include('internal.bkpa._partials.documentModal')
@endsection

@push('scripts')
<script>
    $(function() {
        $receiveGetData = function($element, $route, $options) {
            if (!$($element).length) {
                return false;
            }
            var $defaults = {
                autoWidth : false,
                serverSide : true,
                iDisplayLength : 50,
                lengthMenu: [ 10, 25, 50, 75, 100, 200, 300, 500 ],
                // ajax : $route,
                "ajax": {
                    "url": $route,
                    "type": "POST"
                },
                order : [ [ 0, 'desc' ] ],
                responsive : true,
                columnDefs : [{
                    responsivePriority : 1,
                    targets : 1
                },
                {
                    responsivePriority : 2,
                    targets : -1
                }]
            };
            var $dataTable = $($element).DataTable(jQuery.extend($defaults, $options));
            
            $dataTable.on(
                'init.dt',
                function() {
                    $('.dataTables_paginate').find('span.ellipsis').remove();
                    $('.dataTables_filter, .dataTables_length').find('input, select')
                            .addClass('form-control');
                }).on('preXhr.dt', function() {
//                $app.displayLoading($element);
                }).on('xhr.dt', function() {
//                $app.hideLoading($element);
                }
            );

            return $dataTable;
        };
        $receiveGetData('#datatable', '{!! route('internal.bkpa.receipt.data') !!}', {
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    orderable: false
                },
                { data: 'app_id' },
                { data: 'category_fee'},
                { data: 'breakdown'},
                { data: 'sum' },
                { data: 'date' },

                // { data: 'state' },


                { data: 'status' },
                { data: 'slug' },
                { data: 'action' }
            ],
            order : [ [ 0, 'asc' ] ],
        });

        $(document).on('click','.documentModal',function(e){
            e.preventDefault();
{{--            // {{url('documents/'.$id.'/'.$pay)}}--}}
            var urls = $(this).data('url');
//            var id = $(this).data('content');
            var basic_path = $(this).data('basic');
            var payArray = jQuery.makeArray(urls);
            $('iframe').remove();
            $.each(payArray, function(key, value) {
                {{--var iframe = document.createElement('iframe');--}}
                {{--iframe.setAttribute('src', {{url('documents/'.$id.'/'.value)}});--}}
//                $('#documentModel-modal-body').append('<iframe src="' +
//                    'http://dev.com/documents/' + id + '/' + value + '" width="100%" height="auto" frameborder="0"></iframe>');
                var image_path = basic_path+'/'+value;
                $('#documentModel-modal-body').append('<iframe id="attachment-iframe-' + key + '" src="' +
                    image_path + '" width="100%" height="250px" frameborder="0"></iframe>');

//                $('#documentModel-modal-body #attachment-iframe-' + key).load(function() {
//                    callback(this);
//                });
//
//                $('#documentModal').find('iframe').body.appendChild(iframe);
            });
//            $('#documentModal').find('iframe').attr('src', url);
            $('#documentModal').modal();
        });

        $(document).on('click','.actionModal',function(e){
            e.preventDefault();
            var _token = '{{ csrf_token() }}';
            var id = $(this).data('id');
            $.ajax({
                type:'GET',
                url:'{{ route('internal.bkpa.receipt.action') }}/'+id,
                data:{_token:_token},
                success:function(data){
                    $('#action').html(data);
                    $('#actionModal').modal();
                }
            });
        });

        $(document).on('submit', '#actionForm', function (e) {
            $('#actionModal').modal('hide');
            $('.processingModal').modal('show');

            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
//                    console.log(data);
                    location.reload();
                },
                error: function(response){
                    console.log(response);
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-modal-img-description').text('Name: ' + input.files[0].name + ', Type: ' + input.files[0].type);
                    $('#preview-modal-img').attr('src', e.target.result);
                    $('.preview-embed-div').css('display', 'block');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('click', '.preview-image-a', function() {
//            var img_ipt = $(this).next().find('input.official_payment_slip');
            var img_ipt = $('input[type="file"]');
            readURL(img_ipt[0]);
        });
    });

</script>
@endpush