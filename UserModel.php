<?php 

namespace hj\phpmvc;

use hj\phpmvc\db\DbModel;

abstract class UserModel extends DbModel{
    abstract public function getDisplayName(): string;
}
