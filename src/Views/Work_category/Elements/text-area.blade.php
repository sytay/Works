<!-- work NAME -->
<div class="form-group">
   <?php $description = empty($work->$name) ? null:$work->$name?>
    {!! Form::label($name, trans('work::work_admin.'.$name).':') !!}
    {!! Form::textarea($name, $description, ['class' => 'form-control my-editor']) !!}
    
</div>
<!-- /work NAME -->