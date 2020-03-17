<?php

namespace Course\Controllers;

use Course\Core\Contracts\ContainerInterface;
use Course\Core\Contracts\RequestInterface;
use Course\Models\Customer;

class CustomerController extends Controller
{
    protected $model;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->model = new Customer();
    }

    public function index(RequestInterface $request)
    {
        $customers = $this->model->all();
        return $this->view('customer', ['title' => 'Customers', 'customers' => $customers]);
    }

    public function show(RequestInterface $request)
    {
        $params = $request->getParams();
        echo '<h1>Show Customer ' . $params['id'] . '</h1>';
    }
}
