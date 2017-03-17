<ul>
    @foreach($childs as $child)
    <li>
        <p>{{ $child->category_name }}

            @if(count($child->childs))
            <span>
                <a href="{!! URL::route('admin_work_category.edit', ['id' => $child->category_id]) !!}">
                    <i class="fa fa-pencil"></i>
                </a>
            </span></p>
            @include('work::work_category.admin.work_category_child',['childs' => $child->childs])
            @else
            <span>
                <a href="{!! URL::route('admin_work_category.edit', ['id' => $child->category_id]) !!}">
                    <i class="fa fa-pencil"></i>
                </a>

                <a href="{!! URL::route('admin_work_category.delete',['id' =>  $child->category_id, '_token' => csrf_token()]) !!}"
                   class="margin-left-5 delete">
                    <i class="fa fa-trash-o"></i>
                </a>
            </span></p>
            @endif

    </li>
    @endforeach
</ul>