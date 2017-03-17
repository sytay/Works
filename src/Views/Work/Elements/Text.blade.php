<!-- work NAME -->
<div class="form-group">
    <?php $work_name = $request->get($name) ? $request->get('$name') : @$work->$name ?>
    {!! Form::label($name, trans('work::work_admin.'.$name).':') !!}
    {!! Form::text($name, $work_name, ['class' => 'form-control', 'placeholder' => trans('work::work_admin.'.$name).'']) !!}
</div>
<!-- /work NAME -->