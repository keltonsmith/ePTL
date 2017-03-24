<div role="tabpanel" class="tab-pane" id="report">
    <div class="container mt-30 mb-30">
        <div class="form-title row-table text-500">
            <div class="col-cell cell-icon">
                <i class="zmdi zmdi-n-1-square text-muted mr-5"></i>
            </div>
            <div class="col-cell pl-10">
                Site Inspection Report by Regional Office (PW)
            </div>
        </div>

        <hr class="mt-10 mb-30">

        <div class="row row-10">
            <div class="column col-sm-10 col-sm-offset-1">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Status</label>
                        <div class="col-sm-5">
                        <div class="form-control-static text-muted">
                            <div class="form-control-icon form-control-locked">
                                <i class="zmdi zmdi-lock text-muted pull-right" data-toggle="tooltip" data-placement="top" data-original-title="Dikunci & ditetapkan"></i>
                                <div class="form-control" style="text-transform: uppercase;">
                                    {{ $project->status }}`s action
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Director's Review</label>
                        <div class="col-sm-5">
                            <textarea class="form-control" rows="5" readonly>{{ $project->inspection->feedback }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Site Inspection File Attachments</label>
                        <div class="col-sm-5">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#inspectionModal">Inspection Form</a>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#imageModal">Images</a>
                        {{--<a href="#" class="btn btn-primary">Inspection Report</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end.row-->
    </div>

    <div class="container mt-30 mb-30">
        <div class="form-title row-table text-500">
            <div class="col-cell cell-icon">
                <i class="zmdi zmdi-n-2-square text-muted mr-5"></i>
            </div>
            <div class="col-cell pl-10">
                Site Inspection Report by Consessionaires
            </div>
        </div>

        <hr class="mt-10 mb-30">

        <div class="row row-10">
            <div class="column col-sm-10 col-sm-offset-1">
                <div class="form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Status</label>
                        <div class="col-sm-5">
                        <div class="form-control-static text-muted">
                            <div class="form-control-icon form-control-locked">
                                <i class="zmdi zmdi-lock text-muted pull-right" data-toggle="tooltip" data-placement="top" data-original-title="Dikunci & ditetapkan"></i>
                                <div class="form-control">
                                    No objection to proceed
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Director's Review</label>
                        <div class="col-sm-5">
                            <textarea class="form-control" rows="5" readonly>{{ $project->inspection->feedback }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Site Inspection File Attachments</label>
                        <div class="col-sm-5">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#inspectionModal">Inspection Form</a>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#imageModal">Images</a>
                        {{--<a href="#" class="btn btn-primary">Inspection Report</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end.row-->
    </div>
</div>