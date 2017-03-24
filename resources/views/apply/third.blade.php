@extends('layouts.app')

@section('toolbar')
    @include('partials.steps', compact($steps))
@endsection

@section('content')
    @include('partials/preview')
    <div class="content">
        <div class="container mt-30 mb-30">

            @include('partials.errors')

            <div class="form-title row-table text-500">
                <div class="col-cell cell-icon">
                    <i class="zmdi zmdi-n-2-square text-muted mr-5"></i>
                </div>
                <div class="col-cell pl-10">
                    {{trans('apply.third.title')}}
                </div>
            </div>

            <hr class="mt-10 mb-30">

            <div class="row row-10">
                <div class="column col-sm-10 col-sm-offset-1">
                    {!! Form::model($payment, ['route' => ['apply.third', $type], 'class' => 'form-horizontal', 'files'=>true, 'method' => 'post', 'id' => 'processing_fee_form']) !!}
                    @if($application->type == 'highway')
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                                {{trans('apply.third.development_type')}}
                            </label>
                            <div class="col-sm-5">
                                <div class="form-control-select">
                                    {!! Form::select('development_type_id',
                                    [null => trans('apply.please_select')] + $development_types->toArray(),
                                    old('type'),
                                    ['class' => 'form-control', 'id' => 'development_type']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group hide" id="feesContainer">
                            <label class="col-sm-4 control-label">
                                <font><font class="">
                                        {{trans('apply.third.processing_fee')}}
                                    </font></font>
                            </label>
                            <div class="col-sm-5">
                                <div class="form-control-select">
                                    {!! Form::select('processing_fee_id',
                                    $processing_fees->toArray(),
                                    old('processing_fee_id'),
                                    ['class' => 'form-control', 'id' => 'processing_fees']) !!}
                                </div>
                                <br><font> <font>{{trans('general.other')}}
                                        : </font></font>{!! Form::text('other', old('other'), ['class'=>'form-control']) !!}
                             </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                                <font><font class="">{{trans('apply.third.processing_fee')}}</font></font>
                            </label>
                            <div class="col-sm-5">
                                <div class="form-control-select">
                                    {!! Form::select('processing_fee_id', [null=> trans('apply.please_select')] + $processing_fees->toArray(), old('processing_fee_id'), ['class' => 'form-control', 'id' => 'ad_processing_fees']) !!}
                                </div>
                                <br><font><font>{{trans('general.other')}}
                                        : </font></font>{!! Form::text('other', old('other'), ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{trans('apply.third.structure_size.title')}}</label>
                            <div class="col-sm-2">
                                {{trans('apply.third.height')}}
                                : {!! Form::text('height', old('height'), ['class'=>'form-control', 'id'=>'height']) !!}

                                {{trans('apply.third.width')}}
                                : {!! Form::text('width', old('width'), ['class'=>'form-control', 'id'=>'width']) !!}

                                {{trans('apply.third.total_square')}}
                                : {!! Form::text('total', old('total'), ['class'=>'form-control', 'id'=>'total']) !!}
                            </div>
                        </div>
                    @endif

                    <div class="form-group" id="quantity" style="display: none;">
                        <label class="col-sm-4 control-label">
                            {{trans('apply.third.quantity.title')}}
                        </label>
                            <div class="col-sm-3">
                                {!! Form::text('quantity', $payment->quantity, ['class'=>'form-control', 'id'=>'quantity_amount']) !!}
                            </div>

                        <a href="#" data-toggle="modal" class="btn btn-primary" data-target="#guide"
                           id="daftarTiang">{{trans('apply.third.quantity.button')}}</a>
                    </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                                {{trans('apply.third.payment.title')}}
                            </label>
                            <div class="col-sm-4">
                                @foreach(trans('apply.third.payment.method') as $type => $name)
                                    <div class="radio">
                                        {!! Form::radio('pay', $type, $payment->pay, ['id' => 'payment-'.$type]) !!}
                                        <label for="payment-{{$type}}">
                                            {{$name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <p>{{ trans('apply.third.payment.note') }}</p>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                                {{trans('apply.third.slip_num')}}
                            </label>
                            <div class="col-sm-3">
                                {!! Form::text('slip_num', $payment->slip_num, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{trans('apply.third.total')}}</label>
                            <div class="col-sm-3">
                                {!! Form::text('sum', $payment->sum, ['class'=>'form-control', 'id' => 'total_amount']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{trans('apply.third.payment.date')}}</label>
                            <div class="col-sm-3" id="">
                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                    <input type="text" id="datepicker" name="payment_date"
                                           value="{{old('payment_date')}}">
								    {{--<span class="input-group-addon btn btn-default btn-file text-400">--}}
								    	{{--<span class="fileinput-new">Kalendar</span>--}}

								    {{--</span>--}}
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">{{trans('apply.third.picker')}}</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{trans('apply.third.bank')}}</label>
                            <div class="col-sm-3">
                                <div class="form-control-select">
                                    {!! Form::select('bank', trans('apply.third.banks'), $payment->bank, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">{{trans('apply.third.payment.slip_attachment')}}</label>
                            <div class="col-sm-8">
                                @include('partials/multi-files')
                                {{--<div class="fileinput fileinput-new input-group" data-provides="fileinput">--}}
                                    {{--<div class="form-control" data-trigger="fileinput">--}}
                                        {{--<i class="glyphicon glyphicon-file fileinput-exists"></i>--}}
                                        {{--<span class="fileinput-filename"></span>--}}
                                    {{--</div>--}}

								    {{--<span class="input-group-addon btn btn-default btn-file text-400">--}}
								    	{{--<span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>--}}
								    	{{--<span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>--}}
                                        {{--{!! Form::file('payment_slip') !!}--}}
								    {{--</span>--}}
                                    {{--<a href="#" class="input-group-addon btn btn-default fileinput-exists"--}}
                                       {{--data-dismiss="fileinput">--}}
                                        {{--{{trans('apply.files.buttons.remove')}}--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4"></label>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success btn-block-responsive pl-20 pr-20 pt-10 pb-10 mt-10 text-uppercase">
                                    {{trans('general.continue')}}
                                    <i class="zmdi zmdi-arrow-right ml-20"></i>
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div><!--end.row-->
        </div>
    </div>

    <div class="modal fade" id="guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row-table">
                        <b class="col-cell">
                            Pillar Registration Form
                        </b>

                        <div class="col-cell cell-tight"data-dismiss="modal" >
                            <i class="zmdi zmdi-close text-muted size-20" style="vertical-align: middle; cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="mt-15">
                                <table class="table table-bordered mt-20 mb-20">
                                    <thead>
                                    <tr>
                                        <td>Bil</td>
                                        <td>Kod Tiang</td>
                                        <td>Dari (KM)</td>
                                        <td>Hingga (KM)</td>
                                    </tr>
                                    </thead>
                                    <tbody id="tiangRow">

                                    </tbody>
                                </table>
                                <p></p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="pillar-register-but" type="button" class="btn btn-default"
                                data-dismiss="modal" data-applicationid="{{$application->id}}">{{trans('general.save')}}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection

@section('script')
    <script>
        var each_amount = 0;
        function initialize(){
            var height = 0.0;
            var width = 0.0;
            var total = 0.0;
            $('#height').val(height);
            $('#width').val(width);
            $('#total').val(total);
        };

        $(document).ready(function() {
            $('#height').keyup(function () {
                var height = $(this).val();
                var width = $('#width').val();
                var total = height * width;
                total = Math.round(total * 10) / 10;
                $('#total').val(total);
            });

            $('#width').keyup(function(){
                var height = $('#height').val();
                var width = $(this).val();
                var total = height * width;
                total = Math.round(total * 100) / 100;
                $('#total').val(total);
            });
            $('#quantity_amount').keyup(function(){
                var quantity = $(this).val();
                var total = each_amount * quantity;
                $('#total_amount').val(total);
            });
        });

        $( function() {
            // Initialize the datePicker
            $("#datepicker").pickadate({
                format: 'dd-mm-yyyy',
                formatSubmit: 'yyyy-mm-dd',
                hiddenName: true,
                datepicker: true
            });

            $('#daftarTiang').click(function() {
                var rows = $( "input[name='quantity']" ).val();
                // Create rows and append
                var container = $('#tiangRow');
                container.empty();
                for (i=0; i< rows; i++) {
                    container.append(generateRows(i+1));
                }
            });
            var generateRows = function(bil) {
                var el = '<tr> \
                        <td>' + bil  + '</td> \
                        <td><input name="columns[]" type="text" class="form-control"></td> \
                        <td><input name="froms[]" type="text" class="form-control"></td> \
                        <td><input name="ups[]" type="text" class="form-control"></td> \
                        </tr>';
                return el;
            };

            $('#development_type').on('change', function () {

                var $feesContainer = $('#feesContainer');
                $feesContainer.addClass('hide');
                var $development_type = $(this).val();
                $.ajax({method: "GET", url: "{{route('apply.fees')}}/" + $development_type})
                        .done(function (msg) {
                            var $element = $('#processing_fees');
                            $element.find('option').remove();
                            console.log(msg);
                            $element.append('<option>' + "{{trans('apply.please_select')}}" + '</option>');
                            for (var item in msg) {
                                $element.append('<option value="' + item + '">' + msg[item] + '</option>');
                            }
                            $feesContainer.removeClass('hide');
                        });


                // var processing_fee = $('#processing_fees').val();
                // var development_type_id = $('#development_type').val();
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': "{{ csrf_token() }}"
                //     }
                // });

                // var posting = $.post('/apply/total-amount', { pro_fee: processing_fee, development_type_id: development_type_id });
                // posting.done(function(total_amount){
                //     $('#total_amount').val(total_amount);    
                // });
            });

            // TODO check after structure type added
            $('#ad_processing_fees').on('change', function () {
                var count = $(this).find('option').size() - 1;
                var index = $(this).find('option:selected').index();
                if (
                       ((count - index) == 0 || (count - index - 1) == 0 )
                       /*&& ( {{($type == 'billboard' ? 'true' : false)}} )*/
                ) {
                     $('#quantity').fadeIn();
                } else {
                     $('#quantity').hide();
                }
                var processing_fee = $(this).val();
                var development_type_id = $('#development_type').val();



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                var posting = $.post('/apply/total-amount', { pro_fee: processing_fee, development_type_id: development_type_id });
                posting.done(function(total_amount){
                    $('#total_amount').val(total_amount);
                    each_amount = total_amount;
                });
                initialize();

            });
            $('#processing_fees').change(function () {

                var processing_fee = $(this).val();
                var development_type_id = $('#development_type').val();



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                var posting = $.post('/apply/total-amount', { pro_fee: processing_fee, development_type_id: development_type_id });
                posting.done(function(total_amount){
                    $('#total_amount').val(total_amount);

                });
                initialize();
                return false;
            });
            $('#pillar-register-but').on('click', function() {

                var columns = [], froms = [], ups = [];
                var application_id = $(this).data('applicationid');
                $('#guide input[name="columns\\[\\]"]').each(function () {
                    columns.push($(this).val());
                });
                $('#guide input[name="froms\\[\\]"]').each(function () {
                    froms.push($(this).val());
                });
                $('#guide input[name="ups\\[\\]"]').each(function () {
                    ups.push($(this).val());
                });

                $.post("{{ URL::route('pillar-register') }}", {columns: columns, froms: froms, ups: ups, application_id: application_id}, function(data){
                    if (data['status'] == 'success') {
                        alert('success');
                    }
                });
            });
        } );
    </script>

    <script src="{{asset('js/multi-files.js')}}"></script>
@endsection