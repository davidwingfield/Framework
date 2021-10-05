<?php
    /**
     * CustomerController.php
     *
     * @return
     */

    namespace Src\App\Controllers;

    use Src\Core\Controller;

    class CustomersController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $customers = [
                [
                    'name' => 'Tester',
                    'balance' => 120.00,
                ],
                [
                    'name' => 'Another Tester',
                    'balance' => 100.00,
                ],
            ];

            //echo "" . var_export($customers, 1) . "</pre>";
        }

    }
