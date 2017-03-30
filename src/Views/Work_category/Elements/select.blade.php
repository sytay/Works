<!-- SITE LIST -->
<div class="form-group">
    <?php 
        if(!isset($category->category_parent)){
            $current_parent = 0;
        } else {
            $current_parent = $category->category_parent;
        }
    ?>
    {!! Form::label($name, trans('work::work_category_admin.'.$name).':') !!}
    {!! Form::select($name, $category_parent, $current_parent, ['class' => 'form-control']); !!}
</div>
<!-- /SITE LIST -->