<!-- NUMBER -->
<div class="form-group">
    <?php $number = @$work->$name ? @$work->$name : NULL?>
    {!! Form::label($name, trans('work::work_admin.'.$name).':') !!}
    {!! Form::number($name, $number, ['class' => 'form-control', 'placeholder' => trans('work::work_admin.'.$name).'']) !!}
</div>
<!-- /NUMBER -->