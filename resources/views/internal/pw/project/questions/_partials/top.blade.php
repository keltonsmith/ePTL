@include('partials.errors')
{!! Form::open(['route' => ['internal.pw.project.questionsStore', $project->id], 'files'=>true]) !!}
<div class="form-title row-table text-500">
    <div class="col-cell cell-icon">
        <i class="zmdi zmdi-n-1-square text-muted mr-5"></i>
    </div>
    <div class="col-cell pl-10">
        Site Inspection Details
    </div>
</div>

<hr class="mt-10 mb-30">

<div class="row row-10">
    <div class="column col-sm-10 col-sm-offset-1">
        <div class="form-horizontal">
            @if (!empty($inspection))
            <div class="form-group">
                <label class="col-sm-4 control-label">Site Visit Date</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    {!! Form::date('visit', old('visit', $inspection->visit), ['id' => 'datepicker']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Current Location at Site (KM)</label>
                <div class="col-sm-6">
                    {!! Form::text('location', old('location', $inspection->location), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Direction</label>
                <div class="col-sm-6">
                    {{--{!! Form::text('direction', old('direction'), ['class' => 'form-control']) !!}--}}
                    {!! Form::select('direction', trans('apply.second.fields.direction.items'), old($inspection->direction), ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Applicant's Representative Names</label>
                <div class="col-sm-6">
                    {!! Form::text('applicant', old('applicant', $inspection->applicant), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Concessionaires Representative Names</label>
                <div class="col-sm-6">
                    {!! Form::text('concessionaire', old('concessionaire', $inspection->concessionaire), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Other Officer Names</label>
                <div class="col-sm-6">
                    {!! Form::text('officer', old('officer', $inspection->officer), ['class' => 'form-control']) !!}
                </div>
            </div>
            @else
            <div class="form-group">
                <label class="col-sm-4 control-label">Site Visit Date</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    {!! Form::date('visit', old('visit'), ['id' => 'datepicker']) !!}
                    {{--<input type="text" id="datepicker" name="visit"--}}
                           {{--value="{{old('visit')}}">--}}
                    {{--<span class="input-group-addon btn btn-default btn-file text-400">--}}
                        {{--<span class="fileinput-new">Kalendar</span>--}}

                    {{--</span>--}}
                    {{--<a href="#" class="input-group-addon btn btn-default fileinput-exists"--}}
                       {{--data-dismiss="fileinput">{{trans('apply.third.picker')}}</a>--}}
                </div>
                {{--<div class="col-sm-3">--}}
                    {{--{!! Form::text('visit', old('visit'), ['class' => 'form-control']) !!}--}}
                {{--</div>--}}
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Current Location at Site (KM)</label>
                <div class="col-sm-6">
                    {!! Form::text('location', old('location'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Direction</label>
                <div class="col-sm-6">
                    {{--{!! Form::text('direction', old('direction'), ['class' => 'form-control']) !!}--}}
                    {!! Form::select('direction', trans('apply.second.fields.direction.items'), old('direction'), ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Applicant's Representative Names</label>
                <div class="col-sm-6">
                    {!! Form::text('applicant', old('applicant'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Concessionaires Representative Names</label>
                <div class="col-sm-6">
                    {!! Form::text('concessionaire', old('concessionaire'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Other Officer Names</label>
                <div class="col-sm-6">
                    {!! Form::text('officer', old('officer'), ['class' => 'form-control']) !!}
                </div>
            </div>
            @endif
        </div>
    </div>
</div><!--end.row-->