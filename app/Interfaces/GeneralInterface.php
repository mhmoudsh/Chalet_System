<?php

namespace App\Interfaces;

interface GeneralInterface
{
    public function getData();

    public function findById($id);

    public function saveData($data);

    public function deleteData($data);
}
