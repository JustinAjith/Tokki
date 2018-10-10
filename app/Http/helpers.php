<?php

if(!function_exists('discountType')) {
    function discountType() {
        return [
            'LKR' => 'LKR',
            '%' => '%'
        ];
    }
}

if(!function_exists('city')) {
    function city() {
        return [
            'All Srilanka' => 'All Srilanka',
            'Jaffna' => 'Jaffna',
            'Kilinochchi' => 'Kilinochchi',
            'Mannar' => 'Mannar',
            'Mullaitivu' => 'Mullaitivu',
            'Vavuniya' => 'Vavuniya',
            'Puttalam' => 'Puttalam',
            'Kurunegala' => 'Kurunegala',
            'Gampaha' => 'Gampaha',
            'Colombo' => 'Colombo',
            'Kalutara' => 'Kalutara',
            'Anuradhapura' => 'Anuradhapura',
            'Polonnaruwa' => 'Polonnaruwa',
            'Matale' => 'Matale',
            'Kandy' => 'Kandy',
            'Nuwara Eliya' => 'Nuwara Eliya',
            'Kegalle' => 'Kegalle',
            'Ratnapura' => 'Ratnapura',
            'Trincomalee' => 'Trincomalee',
            'Batticaloa' => 'Batticaloa',
            'Ampara' => 'Ampara',
            'Badulla' => 'Badulla',
            'Monaragala' => 'Monaragala',
            'Hambantota' => 'Hambantota',
            'Matara' => 'Matara',
            'Galle' => 'Galle'
        ];
    }
}

if(!function_exists('categories')) {
    function categories() {
        $categories = \App\Category::all();
        return $categories;
    }
}

if(!function_exists('deliveryDuration')) {
    function deliveryDuration() {
        return [
            "1 Day" => "1 Day",
            "1 to 3 Days" => "1 to 3 Days",
            "1 Week" => "1 Week",
            "10 to 20 Days" => "10 to 20 Days",
            "1 Month" => "1 Month",
            "1 to 3 Month" => "1 to 3 Month",
            "1 Month to 45 Days" => "1 Month to 45 Days",
        ];
    }
}