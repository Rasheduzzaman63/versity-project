@extends('adminlte.app')

@section('content')

<div class="inner_body">
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <strong> Category List</strong>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">SL.</th>
                                        <th>Name</th>
<th>Created By</th>
<th>Updated By</th>

                                        <th width="13%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $key => $Category)
                                        <tr data-entry-id="{{ $Category->id }}">
                                            <td>
                                                {{ $loop->index+1 }}
                                            </td>
                                            <td>{{ $Category->name }}</td>
<td>{{ $Category->created_by }}</td>
<td>{{ $Category->updated_by }}</td>

                                            <td>                                               
                                                <a class="btn btn-xs btn-primary" href="{{ route('categories.show', $Category->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            
                                                <a class="btn btn-xs btn-info" href="{{ route('categories.edit', $Category->id) }}">
                                                    
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <form class="delete_form" action="{{ route('categories.destroy', $Category->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-xs btn-danger delete_row">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('.delete_row').click(function(event) {
                event.preventDefault();
                if ( confirm('Are you sure? Data will be deleted!')) {
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
</div>

@endsection