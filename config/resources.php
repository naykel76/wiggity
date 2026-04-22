<?php

use App\Models\Widget;

return [

    'widget' => [
        'model' => Widget::class,
        'routePrefix' => 'admin.widgets',

        'index' => [
            'columns' => ['name', 'code', 'status', 'is_active'],
            'buttons' => ['create', 'create-modal', 'edit', 'edit-modal'],
            'sortColumn' => 'name',
        ],

        'form' => [
            'fields' => ['name', 'code', 'headline', 'overview', 'is_active', 'status'],
            'buttons' => ['save', 'cancel'],
        ],

        'form-modal' => [
            'fields' => ['name', 'code', 'image_name'],
            'buttons' => ['save', 'save-and-close', 'cancel'],
        ],
    ],

];
