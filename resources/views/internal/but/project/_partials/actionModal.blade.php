<div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['route' => ['internal.but.project.postModal', $project], 'id' => 'actionForm']) !!}
            <div class="modal-header">
                <div class="row-table">
                    <b class="col-cell">
                        Penghantaran ke Bahagian Pejabat Wilayah / Konsesi
                    </b>

                    <div class="col-cell cell-tight" data-dismiss="modal">
                        <i class="zmdi zmdi-close text-muted size-20"
                           style="vertical-align: middle; cursor: pointer;"></i>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">No Fail Projek</label>
                        <div class="col-sm-7">
                            <div class="form-control-static">
                                {{$project->num}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Nama Syarikat</label>
                        <div class="col-sm-7">
                            <div class="form-control-static">
                                {{$project->application->user->details->name}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">Jenis Pembangunan</label>
                        <div class="col-sm-7">
                            <div class="form-control-static">
                                {{$project->application->payment->fee->development_type->name}}
                            </div>
                        </div>
                    </div>

                    <hr style="margin: 15px -15px; border-color: #eee;">

                    <div class="form-group">
                        <label class="col-sm-5 control-label">Pejabat Wilayah</label>
                        <div class="col-sm-7">
                            <div class="form-control-static">
                                {{$offices[$project->application->highway->office_id]}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">{{trans('general.concessionaire')}}</label>
                        <div class="col-sm-7">
                            <div class="form-control-static">
                                {{$concessionaires[$project->application->highway->concessionaire_id]->name}}
                            </div>
                        </div>
                    </div>

                    <hr style="margin: 15px -15px; border-color: #eee;">

                    <div class="form-group">
                        <label class="col-sm-5 control-label">Tindakan</label>
                        <div class="col-sm-7">
                            <div class="checkbox">
                                <input type="checkbox" name="status" id="status">
                                <label for="status">
                                    Hantar fail projek kepada Pejabat Wilayah dan Syarikat Konsesi yang diplih
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary">Hantar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>