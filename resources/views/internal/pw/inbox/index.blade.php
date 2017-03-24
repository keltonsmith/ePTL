@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container mt-30 mb-30">
            <div class="panel panel-table pt-20 pb-20">
                <table class="datatables table-action table" id="datatable">
                    <thead>
                    <tr>
                        {{--<th></th>--}}
                        <th>{{trans('dash.columns.no')}}</th>
                        <th>{{trans('dash.columns.info')}}</th>
                        <th>{{trans('dash.columns.date_notification')}}</th>
                        <th>{{trans('dash.columns.status')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        var t = $datatables('#datatable', '{!! route('internal.pw.inbox.data') !!}', {
            columns: [
//                {data: 1 },
                {data: 'id'},
                {data: 'info'},
                {data: 'date'},
                {data: 'status', name: 'status'}
            ],
            order: [[0, 'asc']]
        });

        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });
</script>
@endpush