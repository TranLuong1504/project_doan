<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 22/06/2020
 * Time: 22:42
 */

namespace Modules\Admin\Repository\User;


use App\Core123\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getList($filter = [], $columns = null, $paginate = null);

    public function findOneBy($filter = [], $fields = null);
}
