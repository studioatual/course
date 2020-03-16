<?php

namespace Course\Controllers;

class CustomerController extends Controller
{
    public function index($request)
    {
        return $this->view('customer', ['title' => 'Customers', 'customers' => []]);
    }

    public function show()
    {
        return 'ok';
    }
}
