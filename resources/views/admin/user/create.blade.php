@extends('layouts.admin_user_create')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::crud.add') }} <span class="text-lowercase">{{ $crud->entity_name }}</span>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
        <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
        <li class="active">{{ trans('backpack::crud.add') }}</li>
      </ol>
    </section>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <!-- Default box -->
        @if ($crud->hasAccess('list'))
            <a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span class="text-lowercase">{{ $crud->entity_name_plural }}</span></a><br><br>
        @endif

          {!! Form::open(array('url' => 'user-ad/search', 'method' => 'post', 'id' => 'search_form')) !!}
          <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">Search from</h3>
            </div>
            <div class="box-body row" >
              <div class="form-group col-md-12">
                <label style = "display: inline-block; max-width: 100%; margin-bottom: 5px; font-weight: 700;">Name</label>
                {{Form::text('username', null, array('class'=>'form-control', 'id'=>'name', 'name'=>'name'))}}
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" id="ua_search_button" class="btn btn-success search-button" data-style="zoom-in" ><span class="ladda-label"><i class="fa fa-search"></i> Search </span></button>
            </div><!-- /.box-footer-->

          </div><!-- /.box -->
          {!! Form::close() !!}

          <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">Search Results</h3>
            </div>
            <div id="search-result-table" class="user-ad-search-result box-body" style="overflow: auto;">
                
            </div><!-- /.box-body -->


          </div><!-- /.box -->
          <br>
          {!! Form::open(array('url' => $crud->route, 'method' => 'post', 'id'=>'add_user_form')) !!}
          <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('backpack::crud.add_a_new') }} {{ $crud->entity_name }}</h3>
            </div>
            <div class="box-body row">
              <!-- load the view from the application if it exists, otherwise load the one in the package -->
              @if(view()->exists('vendor.backpack.crud.form_content'))
                @include('vendor.backpack.crud.form_content', ['fields' => $crud->getFields('create')])
              @else
                @include('crud::form_content', ['fields' => $crud->getFields('create')])
              @endif
            </div><!-- /.box-body -->
            <div class="box-footer">
                <div class="form-group">
                  <span>{{ trans('backpack::crud.after_saving') }}:</span>
                  <div class="radio">
                    <label>
                      <input type="radio" name="redirect_after_save" value="{{ $crud->route }}" checked="">
                      {{ trans('backpack::crud.go_to_the_table_view') }}
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="redirect_after_save" value="{{ $crud->route.'/create' }}">
                      {{ trans('backpack::crud.let_me_add_another_item') }}
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="redirect_after_save" value="current_item_edit">
                      {{ trans('backpack::crud.edit_the_new_item') }}
                    </label>
                  </div>
                </div>

              <button type="submit" class="btn btn-success ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-save"></i> {{ trans('backpack::crud.add') }}</span></button>
              <a href="{{ url($crud->route) }}" class="btn btn-default ladda-button" data-style="zoom-in"><span class="ladda-label">{{ trans('backpack::crud.cancel') }}</span></a>
            </div><!-- /.box-footer-->

          </div><!-- /.box -->
          {!! Form::close() !!}
    </div>
</div>

@endsection

@section('search_scripts')
<script>
(function ($) {
$(document).ready(function(){
    $("#ua_search_button").click(function(){

      var $form = $("#search_form"),
        term = $form.find( "input[id='name']" ).val(),
        url = '/user-ad/search';
        
      var posting = $.post( url, { name: term } );
      
      posting.done(function( data ) {
        $( "#search-result-table" ).html(data);
      });

      return false;
    });
    $( "#search-result-table" ).on('click', '.lf-select-button', function() {
      var $_form = $('#add_user_form');

      var cn = $(this).closest('tr').find('.lf-cn').html();
      var email = $(this).closest('tr').find('.lf-email').html();
      var phone = $(this).closest('tr').find('.lf-phonenumber').html();
      var password = $(this).closest('tr').find('.lf-pwd').html();

      $_form.find("input[name='name']").val(cn);
      $_form.find("input[name='email']").val(email);
      $_form.find("input[name='phone']").val(phone);
      $_form.find("input[name='password']").val(password);
      $_form.find("input[name='password_confirmation']").val(password);

    });

    var hiddenIptArr = [2, 3, 4, 5, 7, 8, 9, 10, 12, 13, 14, 15, 17, 18, 19, 20, 22, 23, 24, 25, 27, 28, 29, 32, 35];

    $('.checklist_dependency input[type=checkbox]').each(function(index, elem) {
        if (jQuery.inArray(index, hiddenIptArr) > -1) {
            if (index == 32) {
                $(elem).parent().parent().parent().css('display', 'none');
            } else if (index == 35) {
                $(elem).parent().parent().parent().prev().css('display', 'none');
                $(elem).parent().parent().parent().css('display', 'none');
            } else {
                $(elem).parent().parent().css('display', 'none');
            }
        }
    });

    $('#s2id_autogen1').parent().css('display', 'none');
    $('#s2id_autogen3').parent().css('display', 'none');

    function hsSpecSelectionBoxByArray(hiddenSpecCheckboxArr, status) {
        $('.checklist_dependency input[type=checkbox]').each(function(index, elem) {
            if (jQuery.inArray(index, hiddenSpecCheckboxArr) > -1) {
                if (status == 1) {
                    $(elem).parent().parent().css('display', 'block');
                } else {
                    $(elem).parent().parent().css('display', 'none');
                }
            }
        });
    }

    $('.checklist_dependency input:checkbox').change(function() {
        if ($(this).val() == 2) {
            if ($(this).prop('checked') == true) {
                $('#s2id_autogen1').parent().css('display', 'block');
            } else {
                $('#s2id_autogen1').parent().css('display', 'none');
            }
        } else if ($(this).val() == 22) {
            var conArray = [22, 23, 24, 25];
            if ($(this).prop('checked') == true) {
                hsSpecSelectionBoxByArray(conArray, 1);
            } else {
                hsSpecSelectionBoxByArray(conArray, 0);
            }
        } else if ($(this).val() == 31) {
             if ($(this).prop('checked') == true) {
                 $('#s2id_autogen3').parent().css('display', 'block');
             } else {
                 $('#s2id_autogen3').parent().css('display', 'none');
             }
         }
    });
});
} (jQuery));
</script>
@endsection