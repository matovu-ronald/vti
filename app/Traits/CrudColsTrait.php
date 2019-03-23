<?php

namespace App\Traits;

trait CrudColsTrait
{
    //text field
    public function textCol($name, $label, $limit = 150)
    {
        $text = [
            'name' => $name,
            'label' => $label,
            'type' => 'text',
            'limit' => $limit,
        ];

        return $text;
    }

    //model function
    public function modelFunction($name, $label, $func)
    {
        $func = [
            // run a function on the CRUD model and show its return value
            'name' => $name,
            'label' => $label, // Table column heading
            'type' => "model_function",
            'function_name' => $func, // the method in your Model
            // 'limit' => 100, // Limit the number of characters shown
        ];

        return $func;
    }

    //relationship select
    public function select($name, $label, $entity, $attribute, $model)
    {
        $select = [  // Select2
            'label' => $label,
            'type' => 'select',
            'name' => $name, // the db column for the foreign key
            'entity' => $entity, // the method that defines the relationship in your Model
            'attribute' => $attribute, // foreign key attribute that is shown to user
            'model' => $model, // foreign key model
        ];
        return $select;

    }

    //image col
    public function imageCol($name, $label, $height = '100px', $width = '100px')
    {
        $image = [
            'label' => $label,
            'type' => 'image',
            'name' => $name,
            'height' => $height,
            'width' => $width,
        ];

        return $image;
    }

    //checkCol
    public function checkCol($name, $label)
    {
        $check = [
            'name' => $name,
            'type' => 'check',
            'label' => $label
        ];

        return $check;
    }

    //video col
    public function videoCol($name, $label)
    {
        $vid = [
            'name' => $name,
            'type' => 'video',
            'label' => $label
        ];

        return $vid;
    }

    //table col
    public function tableCol($name, $label, $cols)
    {
        $table = [
            'name' => $name,
            'label' => $label,
            'type' => 'table',
            'columns' => $cols,
        ];
        return $table;
    }



}