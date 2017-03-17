
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('work::work_category_admin.search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_work_category','method' => 'get']) !!}

        <!--TITLE-->
		<div class="form-group">
            {!! Form::label('category_name',trans('work::work_category_admin.category_name')) !!}
            {!! Form::text('category_name', @$params['sample_category_name'], ['class' => 'form-control', 'placeholder' => trans('work::work_category_admin.category_name')]) !!}
        </div>

        {!! Form::submit(trans('work::work_category_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>




