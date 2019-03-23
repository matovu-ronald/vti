<?php

namespace App\Traits;

trait CrudFieldsTrait
{
    //text field
    public function text($name, $label, $placeholder = '', $hint = '')
    {
        $text = [
            'name' => $name,
            'label' => $label,
            'type' => 'text',
            'attributes' => [
                'placeholder' => $placeholder,
            ],
            'hint' => $hint,
        ];

        return $text;
    }

    //slug field
    public function slug()
    {
        $slug = [
            'name' => 'slug',
            'label' => 'Slug',
            'type' => 'text',
            'hint' => 'Will be automatically generated from your title, if left empty.',
        ];

        return $slug;
    }

    //CKEditor
    public function ckeditor($name, $label, $placeholder = '', $hint = '')
    {
        $editor = [
            'name' => $name,
            'label' => $label,
            'type' => 'wysiwyg',
            'attributes' => [
                'placeholder' => $placeholder,
            ],
            'hint' => $hint,
        ];

        return $editor;
    }

    //one to many select2
    public function oneMany($name, $label, $entity, $attribute, $model, $hint = '')
    {
        $select = [  // Select2
            'label' => $label,
            'type' => 'select2',
            'name' => $name, // the db column for the foreign key
            'entity' => $entity, // the method that defines the relationship in your Model
            'attribute' => $attribute, // foreign key attribute that is shown to user
            'model' => $model, // foreign key model
            'hint' => $hint,
        ];

        return $select;
    }

    //image field
    public function imageField($name, $label, $hint = '')
    {
        $image = [   // Browse
            'name' => $name,
            'label' => $label,
            'type' => 'browse',
            'hint' => $hint,
        ];

        return $image;
    }

    //upload multiple images by browsing the file manager
    public function multipleImage($name, $label, $hint = '')
    {
        $images = [   // Browse multiple
            'name' => $name,
            'label' => $label,
            'type' => 'browse_multiple',
            'multiple' => true, // enable/disable the multiple selection functionality
            // 'mime_types' => null, // visible mime prefixes; ex. ['image'] or ['application/pdf']
            'hint' => $hint,
        ];

        return $images;
    }

    //checkbox field
    public function checkbox($name, $label, $hint = '', $default = '')
    {
        $check = [   // Checkbox
            'name' => $name,
            'label' => $label,
            'type' => 'checkbox',
            'hint' => $hint,
            'default' => $default,
        ];

        return $check;
    }

    //icon field
    public function icon($name, $label, $hint = '')
    {
        $icon = [
            'name' => $name,
            'label' => $label,
            'type' => 'icon_picker',
            'icon_set' => 'fontawesome',
            'hint' => $hint,
        ];

        return $icon;
    }

    //video field
    public function video($name, $label, $hint = '')
    {
        $video = [
            'name' => $name,
            'label' => $label,
            'type' => 'video',
            'hint' => $hint,
        ];

        return $video;
    }

    //textare field
    public function textarea($name, $label, $hint = '', $placeholder = '')
    {
        $textarea = [
            'name' => $name,
            'label' => $label,
            'type' => 'textarea',
            'attributes' => [
                'placeholder' => $placeholder,
            ],
        ];

        return $textarea;
    }

    //number fields
    public function numberField($name, $label, $hint = '', $prefix = '', $suffix = '')
    {
        $number = [
            'name' => $name,
            'label' => $label,
            'hint' => $hint,
            'type' => 'number',
            'prefix' => $prefix,
            'suffix' => $suffix,
        ];

        return $number;
    }

    //table
    public function tableField($name, $label, $entity, $cols, $max)
    {
        $table = [ // Table
            'name' => $name,
            'label' => $label,
            'type' => 'table',
            'entity_singular' => $entity, // used on the "Add X" button
            'columns' => $cols,
            'max' => $max, // maximum rows allowed in the table
            'min' => 1, // minimum rows allowed in the table
        ];

        return $table;
    }

    //location
    public function location($name, $label)
    {
        $location = [
            'name' => $name,
            'label' => $label,
            'type' => 'address',
        ];

        return $location;
    }

    //date field
    public function dateField($name, $label, $hint = '')
    {
        $date = [
            'name' => $name,
            'label' => $label,
            'type' => 'date_picker',
            'hint' => $hint,
        ];

        return $date;
    }

    //date picker
    public function datePicker()
    {
        $datepicker = [
            'name' => 'event_date_range', // a unique name for this field
            'start_name' => 'start_date', // the db column that holds the start_date
            'end_name' => 'end_date', // the db column that holds the end_date
            'label' => 'Event Date Range',
            'type' => 'date_range',
            // OPTIONALS
            'start_default' => '2018-03-28 01:01', // default value for start_date
            'end_default' => '3000-04-05 02:00', // default value for end_date
            'date_range_options' => [ // options sent to daterangepicker.js
                'timePicker' => true,
                'locale' => ['format' => 'DD/MM/YYYY HH:mm'],
            ],
        ];

        return $datepicker;
    }

    //hidden field
    public function hidden($name)
    {
        $hidden = [
            'name' => $name,
            'type' => 'hidden',
        ];

        return $hidden;
    }

    //many to many
    public function selectMany($name, $label, $entity, $attribute, $model)
    {
        $many = [       // Select2Multiple = n-n relationship (with pivot table)
            'label' => $label,
            'type' => 'select2_multiple',
            'name' => $name, // the method that defines the relationship in your Model
            'entity' => $entity, // the method that defines the relationship in your Model
            'attribute' => $attribute, // foreign key attribute that is shown to user
            'model' => $model, // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'select_all' => true, // show Select All and Clear buttons?
        ];

        return $many;
    }

    //time field
    public function timeField($name, $label)
    {
        $time = [   // Time
            'name' => $name,
            'label' => $label,
            'type' => 'time',
        ];

        return $time;
    }
}
