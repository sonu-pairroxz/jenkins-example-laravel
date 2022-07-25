<?php

return [
  'status' => [
      'Pending',
      'Processing',
      'Shipped',
      'Out for Delivery',
      'Delivered',
      'Cancelled',
      'Returned'
  ],
    'option_types' => [
        "" => "Choose Options Type",
        "select" => "Select Box",
        "radio" => "Radio",
        "checkbox" => "CheckBox"
    ],
    'project_types' =>[
        ""=>"Choose project type",
        "residential"=>"Residential",
        "commercial" => "Commercial"
    ],
    'promocode_types' => [
        ""=>"Choose Promocode type",
        "f"=>"Fixed",
        "p"=>"Percentage"
    ],
    'sortby'=>[
        [
            "sort"=>"newest",
            "sort_order"=>"DESC",
            "sort_text"=>"Newest"
        ],
        [
            "sort"=>"name",
            "sort_order"=>"ASC",
            "sort_text"=>"Name A-Z"
        ],
        [
            "sort"=>"name",
            "sort_order"=>"DESC",
            "sort_text"=>"Name Z-A"
        ],
        [
            "sort"=>"price",
            "sort_order"=>"ASC",
            "sort_text"=>"Price Low to High"
        ],
        [
            "sort"=>"price",
            "sort_order"=>"DESC",
            "sort_text"=>"Price High to Low"
        ],
    ]
];
