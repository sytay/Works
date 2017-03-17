<!--ADD SAMPLE CATEGORY ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_work_category.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('work::work_category_admin.work_category_add_button')}}
        </a>
    </div>
</div>
<!--/END ADD SAMPLE CATEGORY ITEM-->

@if( ! $works_categories->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>
                {{ trans('work::work_category_admin.order') }}
            </td>

            <th style='width:5%'>
                {{ trans('work::work_category_admin.category_id') }}
            </th>

            <th style='width:30%'>
                {{ trans('work::work_category_admin.category_name') }}
            </th>

            <th style='width:30%'>
                {{ trans('work::work_category_admin.category_parent') }}
            </th>

            <th style='width:15%'>
                {{ trans('work::work_category_admin.operations') }}
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nav = $works_categories->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($works_categories as $work_category)
        <tr>
            <!--COUNTER-->
            <td>
                <?php echo $counter;
                $counter++;
                ?>
            </td>
            <!--/END COUNTER-->

            <!--SAMPLE CATEGORY ID-->
            <td>
                {!! $work_category->category_id !!}
            </td>
            <!--/END SAMPLE CATEGORY ID-->

            <!--SAMPLE CATEGORY NAME-->
            <td>
                {!! $work_category->category_name !!}
            </td>
            <!--/END SAMPLE CATEGORY NAME-->
            <td>
                {!! $work_category->category_parent_name !!}
            </td>
            <!--OPERATOR-->
            <td>
                <a href="{!! URL::route('admin_work_category.edit', ['id' => $work_category->category_id]) !!}">
                    <i class="fa fa-edit fa-2x"></i>
                </a>
                <a href="{!! URL::route('admin_work_category.delete',['id' =>  $work_category->category_id, '_token' => csrf_token()]) !!}"
                   class="margin-left-5 delete">
                    <i class="fa fa-trash-o fa-2x"></i>
                </a>
                <span class="clearfix"></span>
            </td>
            <!--/END OPERATOR-->
        </tr>
        @endforeach
    </tbody>
</table>
@else
<!-- FIND MESSAGE -->
<span class="text-warning">
    <h5>
        {{ trans('work::work_category_admin.message_find_failed') }}
    </h5>
</span>
<!-- /END FIND MESSAGE -->
@endif
<div class="paginator">
    {!! $works_categories->appends($request->except(['page']) )->render() !!}
</div>