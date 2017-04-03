<!-- work NAME -->
<div class="form-group">
   
    <?php $description = $request->get($name) ? $request->get('$name') : @$category->$name ?>
    {!! Form::label($name, trans('work::work_category_admin.'.$name).':') !!}
    {!! Form::textarea($name, $description, ['class' => 'form-control my-editor']) !!}
    
</div>
<!-- /work NAME -->