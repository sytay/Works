<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_work_category.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('work::work_category_admin.work_category_add_button')}}
        </a>
    </div>
</div>

<ul class="tree">
    @foreach($categories as $category)
    <li>
        <p>{{ $category->category_name }}
            @if(count($category->childs))
            <span>
                <a href="{!! URL::route('admin_work_category.edit', ['id' => $category->category_id]) !!}">
                    <i class="fa fa-pencil"></i>
                </a>
            </span>
            </p>
        @include('work::work_category.admin.work_category_child',['childs' => $category->childs])
        @else
            <span>
                <a href="{!! URL::route('admin_work_category.edit', ['id' => $category->category_id]) !!}">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="{!! URL::route('admin_work_category.delete',['id' =>  $category->category_id, '_token' => csrf_token()]) !!}"
                   class="margin-left-5 delete">
                    <i class="fa fa-trash-o"></i>
                </a>
            </span>
            </p>
        @endif

    </li>
    @endforeach
</ul>