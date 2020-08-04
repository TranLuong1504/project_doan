<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Tìm kiếm Module Group</h3>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <div class="form-group col-lg-2">
                    <input type="text" class="form-control" name="id" placeholder="ID" value="{{ $_GET['id'] ?? '' }}">
                </div>
                <div class="form-group col-lg-3">
                    <input type="text" class="form-control" name="mog_name" placeholder="Name" value="{{ $_GET['mog_name'] ?? '' }}">
                </div>
                <div class="form-group col-lg-2">
                    <input type="number" class="form-control" name="mog_order" placeholder="Order" value="{{ $_GET['mog_order'] ?? '' }}">
                </div>
                <div class="form-group col-lg-3">
                    <input type="text" class="form-control float-right" name="date_range" autocomplete="off" placeholder="Date range" id="reservation" value="{{ $_GET['date_range'] ?? '' }}">
                </div>
                <div class="form-group col-lg-1">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search mr-2"></i>Tìm kiếm</button>
                </div>
                <div class="form-group col-lg-1">
                    <a href="{{ route('get.module_group.index') }}" class="btn btn-icon btn-secondary d-block">
                        <i class="fas fa-sync-alt mr-2"></i>Làm mới
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
