{!! HTML::style('packages/jacopo/laravel-authentication-acl/css/bootstrap.min.css') !!}
{!! HTML::style('packages/jacopo/laravel-authentication-acl/css/style.css') !!}
{!! HTML::style('packages/jacopo/laravel-authentication-acl/css/baselayout.css') !!}
{!! HTML::style('packages/jacopo/laravel-authentication-acl/css/fonts.css') !!}
{!! HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') !!}





<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i></h3>
                </div>

                <div class="panel-body">


                    @if( ! $templates->isEmpty() )
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style='width:20%'>Template name</th>
                                <th style='width:60%'>Template content</th>

                                <th style='width:40%'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($templates as $template)
                            <tr>

                                <td>{!! $template->template_name !!}</td>
                                <td>{!! $template->template_content !!}</td>

                                <td>
                                    <button class="btn btn-link"><i class="fa fa-check fa-2x"></i></button>
                                    <button class="btn btn-link"><i class="fa fa-trash-o fa-2x"></i></button>
                                    
                              
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif



                </div>
            </div>
        </div>

    </div>
</div>

