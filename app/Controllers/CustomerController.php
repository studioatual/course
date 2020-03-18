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
        return $this->view('customers.index', [
            'title' => 'Customers',
            'customers' => $customers
        ]);
    }

    public function create(RequestInterface $request)
    {
        return $this->view('customers.form', [
            'title' => 'New Customer'
        ]);
    }

    public function store(RequestInterface $request)
    {
        $params = $request->getParams();
        $customer = $this->model->create($params);
    }

    public function show(RequestInterface $request)
    {
        $params = $request->getParams();
        $customer = $this->model->first($params['id']);
        return $this->view('customers.form', [
            'title' => 'New Customer',
            'data' => $customer
        ]);
    }
}
