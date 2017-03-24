

<div role="tabpanel" class="tab-pane" id="project">

    <div class="form-title row-table text-500">
        <div class="col-cell cell-icon">
            <i class="zmdi zmdi-n-1-square text-muted mr-5"></i>
        </div>
        <div class="col-cell pl-10">
            Perincian Projek
        </div>
    </div>

    <hr class="mt-10 mb-30">

    <div class="row row-10">
        <div class="column col-sm-10 col-sm-offset-1">
            <div class="form-horizontal">

                <div class="form-group">

                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.project.highway')}}</label>

                    <div class="col-sm-6">
                        <div class="form-control-static text-muted">
                            <div class="form-control-icon form-control-locked">
                                <i class="zmdi zmdi-lock text-muted pull-right" data-toggle="tooltip"
                                   data-placement="top" data-original-title="Dikunci &amp; ditetapkan"></i>
                                <div class="form-control">{{$application->highway->name}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($application->user->details->concessionaires)
                    <div class="form-group">

                        <label class="col-sm-4 control-label">{{trans('bpo.application.info.project.concession')}}</label>

                        <div class="col-sm-6">
                            <div class="form-control-static text-muted">
                                <div class="form-control-icon form-control-locked">
                                    <i class="zmdi zmdi-lock text-muted pull-right" data-toggle="tooltip"
                                       data-placement="top" data-original-title="Dikunci &amp; ditetapkan"></i>
                                    <div class="form-control">{{trans('register.concessionaires')[$application->user->details->concessionaires]}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                            <!--
                <div class="form-group">
                    <label class="col-sm-4 control-label">No. Lebuhraya</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control">
                    </div>
                </div>-->

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.project.location')}}</label>
                    <div class="col-sm-3">
                        <i class="zmdi text-muted pull-right"></i>
                        <div class="form-control">{{$application->location}}</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.project.direction')}}</label>
                    <div class="col-sm-4">
                        <i class="zmdi text-muted pull-right"></i>
                        <div class="form-control">{{$application->direction}}</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.project.from_city')}}</label>
                    <div class="col-sm-3">
                        <i class="zmdi text-muted pull-right"></i>
                        <div class="form-control">{{$application->from_city}}</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.project.to_city')}}</label>
                    <div class="col-sm-3">
                        <i class="zmdi text-muted pull-right"></i>
                        <div class="form-control">{{$application->to_city}}</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{trans('bpo.application.info.project.coordinates')}}</label>
                    <div class="col-sm-6">
                        <a href="#" data-toggle="modal" data-target="#guide"
                           class="btn btn-success btn-block-responsive pl-20 pr-20 pt-10 pb-10 mt-10 text-uppercase"><font><font>
                                    {{trans('apply.second.map')}}
                                </font></font><i class="zmdi zmdi-arrow-right ml-20"></i>
                        </a>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{trans('bkpa.development_structure_details')}}</label>
                    <div class="col-sm-3">
                        @if ($application->type == 'highway')
                            <div class="form-control">{{trans('bkpa.roadside')}} - {{$application->payment->development_detail->name}}</div>
                        @else
                            <div class="form-control">{{trans('bkpa.billboard')}} - {{$application->payment->processing_fee->name}}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{trans('bkpa.development_structure_details')}}</label>
                    <div class="col-sm-3">
                        @if ($application->payment->pay == 'check')
                            <div class="form-control">{{trans('apply.third.payment.method.check')}}</div>
                        @else
                            <div class="form-control">{{trans('apply.third.payment.method.bank')}}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{trans('bkpa.bank')}}</label>
                    <div class="col-sm-3">
                        <div class="form-control">{{ trans('apply.third.banks.'.$application->payment->bank)}}</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{trans('bkpa.payment_slip_number')}}</label>
                    <div class="col-sm-3">
                        <div class="form-control">{{$application->payment->slip_num}}</div>
                    </div>
                </div>
                    <!--
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Zon</label>
                        <div class="col-sm-3">
                            <div class="form-control-select">
                                <select class="form-control">
                                    <option>Pilih Zon</option>>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pihak berkuasa Tempatan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                -->
            </div>
        </div>
    </div><!--end.row-->

    <div class="form-title row-table text-500 mt-30">
        <div class="col-cell cell-icon">
            <i class="zmdi zmdi-n-2-square text-muted mr-5"></i>
        </div>
        <div class="col-cell pl-10">
            {{trans('bpo.application.info.project.documents')}}
        </div>
    </div>

    <hr class="mt-10 mb-30">

    <div class="panel panel-table mb-30 mt-10">
        <table class="datatabless td-middle table ma-0">
            <thead>
            <tr>
                <th class="tight">Bil</th>
                <th width="300">Butiran</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @php ($i = 1)
            @foreach($application->documentsApplication as $name => $document)
                <tr>
                    <td class="tight">{{$i}}</td>
                    <td>{{trans('apply.files.attachment_label.'.$name)}}</td>
                    <td>
{{--                        <a href="#" data-url="{{url('documents/'.$application->id.'/'.$document)}}" class="documentModal">{{trans('bpo.document')}}</a>--}}
                        <a href="#" data-name="{{$name}}" data-review_letter="{{ $review_letter }}" data-structure="{{ $structure }}"  data-image_location="{{ $image_location }}" data-designs="{{ $designs }}" data-pays="{{$pays}}" data-basic="{{url('documents/'.$application->id)}}" class="documentModal">{{trans('bpo.document')}}</a>
                    </td>
                </tr>
                @php ($i++)
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row-table">
                    <b class="col-cell">
                        {{trans('apply.second.map')}}
                    </b>
                </div>
            </div>
            <div class="modal-body">
                <input id="pac-input" class="controls" type="text" placeholder="Search Box">

                <div id="map_canvas" style="width: 720px; height: 400px;"></div>
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.ok')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript"
        src='https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&ext=.js&key=AIzaSyCwSQeFz3AjZXx73jZz0NsLRdsJZSgA86Y'></script>
<script>
    var geocoder;
    var map;
    var overlay;
    


    function initialize() {

        var latlng_str = '{!! $application->coordinates !!}';
        var obj = jQuery.parseJSON(latlng_str);

        if (typeof window.marker !== 'object') {
            var map = new google.maps.Map(
                    document.getElementById("map_canvas"), {
                        center: new google.maps.LatLng(
                                parseFloat(obj['lat']),
                                parseFloat(obj['lng'])
                        ),
                        zoom: 4,
                        mapTypeId: google.maps.MapTypeId.HYBRID
                    });
            var marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: map.getCenter()
            });
            window.marker = marker;
            // google.maps.event.addListener(map, 'projection_changed', function () {
            //     overlay = new google.maps.OverlayView();
            //     overlay.draw = function () {
            //     };
            //     overlay.setMap(map);

            //     var info = document.getElementById('myinfo');
            //     google.maps.event.addListener(marker, 'click', function (e) {
            //         setCoordinates(marker.getPosition());
            //     });
            //     google.maps.event.addListener(map, 'center_changed', function (e) {
            //         setCoordinates(marker.getPosition());
            //     });
            //     google.maps.event.addListener(marker, 'drag', function (e) {
            //         setCoordinates(marker.getPosition());
            //     });

            // });


            // var input = document.getElementById('pac-input');
            // var searchBox = new google.maps.places.SearchBox(input);
            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // map.controls[google.maps.LatLngBounds].push(input);

            // map.addListener('bounds_changed', function () {
            //     searchBox.setBounds(map.getBounds());
            // });

            // var markers = [];
            // searchBox.addListener('places_changed', function () {
            //     var places = searchBox.getla();

            //     if (places.length == 0) {
            //         return;
            //     }

            //     markers.forEach(function (marker) {
            //         marker.setMap(null);
            //     });
            //     markers = [];

            //     var bounds = new google.maps.LatLngBounds();
            //     places.forEach(function (place) {
            //         var icon = {
            //             url: place.icon,
            //             size: new google.maps.Size(71, 71),
            //             origin: new google.maps.Point(0, 0),
            //             anchor: new google.maps.Point(17, 34),
            //             scaledSize: new google.maps.Size(25, 25)
            //         };

            //         marker.setPosition(place.geometry.location);
            //         setCoordinates(place.geometry.location);

            //         if (place.geometry.viewport) {
            //             bounds.union(place.geometry.viewport);
            //         } else {
            //             bounds.extend(place.geometry.location);
            //         }
            //     });
            //     map.fitBounds(bounds);
            // });
        }
    }
    ;

    $(document).ready(function() {
        $('#pac-input').keyup(function () {
            var latlng_str = $(this).val(), array_latlng = latlng_str.split(',');
            
            if (array_latlng.length > 1) {

                var map = new google.maps.Map(
                        document.getElementById("map_canvas"), {
                            center: new google.maps.LatLng(
                                    parseFloat(array_latlng[0]),
                                    parseFloat(array_latlng[1])
                            ),
                            zoom: 4,
                            mapTypeId: google.maps.MapTypeId.HYBRID
                        });
                var marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    position: map.getCenter()
                });
                document.getElementById('lat').value = parseFloat(array_latlng[0]);
                document.getElementById('lng').value = parseFloat(array_latlng[1]);
                
                window.marker = marker;
            }
            // google.maps.event.addListener(map, 'projection_changed', function () {
            //     overlay = new google.maps.OverlayView();
            //     overlay.draw = function () {
            //     };
            //     overlay.setMap(map);

            //     var info = document.getElementById('myinfo');
            //     google.maps.event.addListener(marker, 'click', function (e) {
            //         setCoordinates(marker.getPosition());
            //     });
            //     google.maps.event.addListener(map, 'center_changed', function (e) {
            //         setCoordinates(marker.getPosition());
            //     });
            //     google.maps.event.addListener(marker, 'drag', function (e) {
            //         setCoordinates(marker.getPosition());
            //     });

            // });
        });
    });


    $('#guide').on('shown.bs.modal', function (e) {
        initialize();

    });
    $('#highway').on('change', function () {
        var highway_id = $(this).val();
        var position = coordinates[highway_id];
        setCoordinates(position);
    });
</script>


@endpush

@push('styles')
<style>
    .controls {
        position: absolute;
        z-index: 99;
        left: 20%;
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 31px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    .pac-container {
        font-family: Roboto;
        z-index: 9999;
    }

    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }
</style>
@endpush