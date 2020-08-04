<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 22/06/2020
 * Time: 22:44
 */

namespace Modules\Admin\Repository\BillDetail;


use App\Core123\EloquentRepository;
use App\Models\BillDetail;

class BillDetailRepository extends EloquentRepository implements BillDetailRepositoryInterface
{
    public function __construct(BillDetail $billDetail)
    {
        $this->model = $billDetail;
    }
}
