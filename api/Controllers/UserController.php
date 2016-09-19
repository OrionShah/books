<?php 

namespace Controllers;

class UserController extends BaseController
{

    public function getInfo($id)
    {
        $id = intval($id);
        return [
            'id' => $id,
            'name' => 'some name'
        ];
    }

    public function postInfo($id)
    {
        $id = intval($id);
        return [
            'id' => $id,
            'name' => 'some name',
            'post' => true
        ];
    }
}