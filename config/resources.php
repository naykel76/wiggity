<?php

use App\Models\Widget;

return [

    'widget' => [
        'model' => Widget::class,
        'routePrefix' => 'admin.widgets',

        'index' => [
            'columns' => ['name', 'code', 'status', 'is_active'],
            'buttons' => ['create', 'edit'],
            'sortColumn' => 'name',
        ],

        'form' => [
            'fields' => ['name', 'code', 'headline', 'overview', 'is_active', 'status'],
            'buttons' => ['save', 'cancel'],
        ],
    ],

];
