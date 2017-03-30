<div class="form-group">
    <?php 
        if(!isset($work->work_category)){
            $current_category = 0;
        } else {
            $current_category = $work->work_category;
        }
    ?>
    {!! Form::label($name, trans('work::work_admin.'.$name).':') !!}
    {!! Form::select($name, $category_parent, $current_category, ['class' => 'form-control']); !!}
</div>