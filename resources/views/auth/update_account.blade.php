@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container mt-30 mb-30 tab-content">
            <div role="tabpanel" class="tab-pane active" id="company">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/updateprofile') }}">
                    {{ csrf_field() }}
                    <div class="form-title row-table text-500">
                        <div class="col-cell cell-icon">
                            <i class="zmdi zmdi-n-1-square text-muted mr-5"></i>
                        </div>
                        <div class="col-cell pl-10">{{trans('bpo.application.info.company.applicant_info')}}</div>
                    </div>

                    <hr class="mt-10 mb-30">

                    <div class="row row-10">
                        <div class="column col-sm-10 col-sm-offset-1">
                            <div class="form-horizontal">
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-sm-4 control-label">{{trans('bpo.application.info.company.applicant_category')}}</label>--}}
                                    {{--<div class="col-sm-4">--}}
                                        {{--<div class="form-control-icon">--}}
                                            {{--<i class="zmdi text-muted pull-right"></i>--}}
                                            {{--<input name="type" class="form-control" value="{{$user->type}}"></input>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.company.name')}}</label>
                                    <div class="col-sm-4">
                                        <i class="zmdi text-muted pull-right"></i>
                                        <input name="username" class="form-control" value="{{$user->details->name}}"></input>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.company.number_registration')}}</label>
                                    <div class="col-sm-4">
                                        <i class="zmdi text-muted pull-right"></i>
                                        <input name="registration_number" class="form-control" value="{{$user->details->registration_number}}"></input>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.company.address')}}</label>
                                    <div class="col-sm-4">
                                        <i class="zmdi text-muted pull-right"></i>
                                        <input name="address" class="form-control" value="{{$user->details->address}}"></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.company.post_address')}}</label>
                                    <div class="col-sm-4">
                                        <i class="zmdi text-muted pull-right"></i>
                                        <input name="post_address" class="form-control" value="{{$user->details->post_address}}"></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.company.postcode_country')}}</label>
                                    <div class="col-sm-4">
                                        <div class="row row-5">
                                            <div class="column col-sm-3">
                                                <input name="postcode" class="form-control" value="{{$user->details->postcode}}"></input>
                                            </div>

                                            <div class="column col-sm-5">
                                                <input name="country" class="form-control" value="{{$user->details->country}}"></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.company.phone_office')}}</label>
                                    <div class="col-sm-4">
                                        <i class="zmdi text-muted pull-right"></i>
                                        <input name="phone_office" class="form-control" value="{{$user->details->phone_office}}"></input>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.company.phone_fax')}}</label>
                                    <div class="col-sm-4">
                                        <i class="zmdi text-muted pull-right"></i>
                                        <input name="fax_office" class="form-control" value="{{$user->details->fax_office}}"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end.row-->

                    <div class="form-title row-table text-500">
                        <div class="col-cell cell-icon">
                            <i class="zmdi zmdi-n-2-square text-muted mr-5"></i>
                        </div>
                        <div class="col-cell pl-10">{{trans('bpo.application.info.company.owner')}}</div>
                    </div>

                    <hr class="mt-10 mb-30">

                    <div class="row row-10">
                        <div class="column col-sm-10 col-sm-offset-1">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.company.name_account')}}</label>
                                    <div class="col-sm-4">
                                        <i class="zmdi text-muted pull-right"></i>
                                        <input name="name" class="form-control" value="{{$user->name}}"></input>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.company.email')}}</label>
                                    <div class="col-sm-4">
                                        <i class="zmdi text-muted pull-right"></i>
                                        <input name="email" class="form-control" value="{{$user->email}}"></input>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.company.cell_phone')}}</label>
                                    <div class="col-sm-4">
                                        <i class="zmdi text-muted pull-right"></i>
                                        <input name="phone" class="form-control" value="{{$user->phone}}"></input>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!--end.row-->
                    <hr class="mt-10 mb-30">
                    <div class="row row-10">
                        <div class="column col-sm-10 col-sm-offset-1">

                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection