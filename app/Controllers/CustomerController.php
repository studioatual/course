<?php

namespace Course\Controllers;

use Course\Core\Contracts\RequestInterface;

class CustomerController extends Controller
{
    public function index(RequestInterface $request)
    {
        return $this->view('customer', ['title' => 'Customers', 'customers' => []]);
    }

    public function show(RequestInterface $request)
    {
        $params = $request->getParams();
        echo '<h1>Show Customer ' . $params['id'] . '</h1>';
    }
}
