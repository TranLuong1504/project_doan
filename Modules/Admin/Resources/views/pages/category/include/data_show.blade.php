<div class="card">
    <div class="card-header">
        <h3 class="card-title">Category</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover" id="category">
            <thead>
            <tr>
                <th style="width: 30px">Action</th>
                <th style="width: 50px">ID</th>
                <th>Name</th>
                <th>Created at</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_category as $c)
                <tr>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu" style="min-width: auto">
                                <li>
                                    <a class="dropdown-item edit" href="javascript:void(0)" data-id="{{ $c['id'] }}"><i class="fas fa-pencil-alt text-success mr-2"></i>Sửa</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete" href="javascript:void(0)" data-id="{{ $c['id'] }}"><i class="fas fa-trash-alt text-danger mr-2"></i>Xóa</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td>{{ $c['id'] }}</td>
                    <td><span class="text-danger font-weight-bold">{{ $c['name'] }}</span></td>
                    <td>{{ $c['created_at'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="right">
            @include('admin::components.paginate.paginate', [
                'uri' => route('get.brands.index')
            ])
        </div>
    </div>
</div>
