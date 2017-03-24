<div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row-table">
                    <b class="col-cell">
                        {{trans('payment.payment_confirmation')}}
                    </b>

                    <div class="col-cell cell-tight"data-dismiss="modal" >
                        <i class="zmdi zmdi-close text-muted size-20" style="vertical-align: middle; cursor: pointer;"></i>
                    </div>
                </div>
            </div>
            {!! Form::model($payment, [
                    'route' => ['internal.bkpa.receipt.actionPost', $payment],
                    'files' => true,
                    'id' => 'actionForm'
                    ]) !!}
            <div class="modal-body">
                <div class="errors"></div>

                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            {{trans('dash.columns.app_id')}}
                        </label>
                        <div class="col-sm-7">
                            <div class="form-control-static">
                                {{$payment->application->app_id}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">{{trans('register.second.details.company_name')}}</label>
                        <div class="col-sm-7">
                            <div class="form-control-static">
                                {{$payment->application->user->details->name}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            {{trans('dash.columns.fee_category')}}
                        </label>
                        <div class="col-sm-7">
                            <div class="form-control-static">
                                @if($payment->application->type == 'highway') 
                                    {{$payment->development_detail->name}}
                                @else
                                    {{$payment->processing_fee->name}}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            {{trans('payment.total_processing_fee')}}
                        </label>
                        <div class="col-sm-7">
                            <div class="form-control-static">
                                {{Helper::priceFormat($payment->sum)}}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            {{trans('bkpa.no_payment_slip')}}
                        </label>
                        <div class="col-sm-7">
                            {{--{!! Form::text('slip_num', '', ['id' => 'slip_num', 'class' => 'slip_num']) !!}--}}
                            {{--<div class="form-control-static">--}}
                                {!! Form::text('official_receipt_no','', ['id' => 'official_receipt_no', 'name' => 'official_receipt_no', 'class' => 'official_receipt_no']) !!}
                                {{--{{$payment->application->slug}}--}}
                            {{--</div>--}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            {{trans('bkpa.official_slip')}}
                        </label>
                        <div class="col-sm-7">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i>
                                    <span class="fileinput-filename"></span>
                                </div>

                                <a class="input-group-addon btn btn-default fileinput-exists preview-image-a">{{trans('apply.files.buttons.preview')}}</a>

                                <span class="input-group-addon btn btn-default btn-file text-400">
                                    <span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>
                                    <span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>
                                    {!! Form::file('official_payment_slip') !!}
                                </span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                   data-dismiss="fileinput">{{trans('apply.files.buttons.remove')}}</a>
                            </div>
                            <div class="row preview-embed-div" style="margin-top: 40px; display: none;">
                                <div class="col-md-12">
                                    <img id="preview-modal-img" src="#" alt="preview image" style="width: 100%; height: auto;"/>
                                </div>
                                <div class="col-md-12">
                                    <p id="preview-modal-img-description">This is not Image File.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">{{trans('general.review')}}</label>
                        <div class="col-sm-7">
                            {!! Form::textarea('review', null, ['rows' => 5, 'id' => 'review', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">{{trans('payment.status')}}</label>
                        <div class="col-sm-7">
                            <div class="radio">
                                {!! Form::radio('status', 'accepted', false, ['id' => 'status-1']) !!}
                                <label for="status-1">
                                    {{trans('general.accepted')}}
                                </label>
                            </div>

                            <div class="radio">
                                {!! Form::radio('status', 'not accepted', false, ['id' => 'status-2']) !!}
                                <label for="status-2">
                                    {{trans('general.not_accepted')}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group hidden">
                        <label class="col-sm-5 control-label">{{trans('general.action')}}</label>
                        <div class="col-sm-7">
                            <div class="radio">
                                {!! Form::radio('act', 'next', false, ['id' => 'act-1']) !!}
                                <label for="act-1">
                                    {{trans('bkpa.to_land')}}
                                </label>
                            </div>

                            <div class="radio">
                                {!! Form::radio('act', 'back', false, ['id' => 'act-2']) !!}
                                <label for="act-2">
                                    {{trans('bkpa.back_to_applicant')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.close')}}</button>
                <button type="submit" class="btn btn-primary">{{trans('general.submit')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>