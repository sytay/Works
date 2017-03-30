
@if( ! $works->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('work::work_admin.order') }}</td>
            
              <th style='width:20%'>Title</th>
              <th style='width:20%'>Category</th>
             <th style='width:10%'>Salary</th>
            <th style='width:5%'>{{ trans('work::work_admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $works->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($works as $work)
        <tr>
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
           
            <td>{!! $work->work_name !!}</td>
            <td>{!! $work->category_name !!}</td>
            <td>{!! $work->work_salary !!}</td>
            
            <td>
                <a href="{!! URL::route('admin_work.edit', ['id' => $work->work_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_work.delete',['id' =>  $work->work_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
 <span class="text-warning">
	<h5>
		{{ trans('work::work_admin.message_find_failed') }}
	</h5>
 </span>
@endif
<div class="paginator">
    {!! $works->appends($request->except(['page']) )->render() !!}
</div>