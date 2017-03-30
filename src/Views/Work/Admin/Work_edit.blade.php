@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: {{ trans('work::work_admin.page_edit') }}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        <!-- TITLE -->
                        {!! !empty($work->work_id) ? '<i class="fa fa-pencil"></i>'.trans('work::work_admin.form_edit') : '<i class="fa fa-users"></i>'.trans('work::work_admin.form_add') !!}
                    </h3>
                </div>

                {{-- model general errors from the form --}}
                @if($errors->has('work_name') )
                <div class="alert alert-danger">{!! $errors->first('work_name') !!}</div>
                @endif

                @if($errors->has('name_unvalid_length') )
                <div class="alert alert-danger">{!! $errors->first('name_unvalid_length') !!}</div>
                @endif

                {{-- successful message --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{{$message}}</div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <h4>{!! trans('work::work_admin.form_heading') !!}</h4>
                            <!-- FORM -->
                            {!! Form::open(['route'=>['admin_work.post', 'id' => @$work->work_id],  'files'=>true, 'method' => 'post'])  !!}
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        {!! trans('work::work_admin.tab_overview') !!}
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#menu1">
                                        {!! trans('work::work_admin.tab_attributes') !!}
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- OVERVIEW -->
                                <div id="home" class="tab-pane fade in active">
                                    <!-- WORK  NAME TEXT-->
                                    @include('work::work.elements.text', ['name' => 'work_name'])
                                    <!-- /END WORK NAME TEXT -->
                                    
                                    <!-- WORK  CATEGORY SELECT-->
                                    @include('work::work.elements.select', ['name' => 'work_category'])
                                    <!-- /END WORK CATEGORY SELECT -->
                                    
                                    <!-- WORK  SALARY TEXT-->
                                    @include('work::work.elements.text', ['name' => 'work_salary'])
                                    <!-- /END WORK SALARY TEXT -->
                                    
                                    <!-- WORK  DESCRIPTION TEXT-->
                                     @include('work::work.elements.text-area', ['name' => 'work_description'])
                                    <!-- /END WORK DESCRIPTION TEXT -->   
                                </div>
                                <br>
                         
                                <!-- /OVERVIEW -->

                                <!-- ATTRIBUTES-->
                                <div id="menu1" class="tab-pane fade">
                                </div>
                                <!-- ATTRIBUTES -->

                            </div>

                            {!! Form::hidden('id',@$work->work_id) !!}
                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_work.delete',['id' => @$work->work_id, '_token' => csrf_token()]) !!}"
                               class="btn btn-danger pull-right margin-left-5 delete">
                                Delete
                            </a>
                            <!-- DELETE BUTTON -->
                            <!-- SAVE BUTTON -->
                            {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                            <!-- /SAVE BUTTON -->
                            {!! Form::close() !!}
                            <!-- /FORM -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='col-md-4'>
            @include('work::work.admin.work_search')
        </div>

    </div>
</div>
@stop