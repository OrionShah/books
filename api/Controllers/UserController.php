<?php 

namespace Controllers;

class UserController extends BaseController
{

    /**
     * GET запрос на получение инфы
     *
     * @param int $id идентификатор пользователя
     *
     * @return array данные
     */
    public function getInfo($id)
    {
        $id = intval($id);
        return [
            'id' => $id,
            'name' => 'some name'
        ];
    }

    /**
     * POST запрос на получение инфы
     *
     * @param int $id идентификатор пользователя
     *
     * @return array данные
     */
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