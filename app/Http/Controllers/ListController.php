<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;
use App\Models\Customer;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class ListController extends Controller
{
    /**
   * Create a new controller instance
   *
   * @return void
   */
  public function __construct()
  {
      parent::__construct();
  }

  


   /**
   * Sample data table view 
   * 
   * @return void
   * @author Lemonkazi <lemonpstu09@gmail.com>
   * @version 0.1 written in 2021-11-09
  */
  public function index(Request $request, Customer $customer){
      
      
      //All users
      $result = [];
      $params = $request->all();
      $seconds = 60;
      $paginate = 20;
      if (isset($params['paginate']) && !empty($params['paginate'])) { 
        $paginate = $params['paginate'];
      }
      $page = request()->get('page', 1);

      

      if ($request->get('birth_year')) {
        
        
        $birth_year = $request->get('birth_year');
        $birth_month = $request->get('birth_month');

        // Check cache first
        $cacheKey = 'customers-' . $birth_year.'-' . $birth_month.'-'.$page.'-'.$paginate;
        $catchPage = Cache::get($cacheKey);
        if ($catchPage != null) {
            $result = $catchPage;
            
        }
        else {
          // Clear caches:
          $this->forgetCaches('customers-');
          $result = Cache::remember($cacheKey, $seconds, function () use ($paginate,$customer,$params) {
            $query = $customer->filter($params);
            return $query->paginate($paginate);
            
            
          });
          
        }
        $totalCustomer = Cache::remember('count-' . $birth_year.'-' . $birth_month, $seconds, function() use ($result){
            
          return $result->total();
        });

        
      }

      

      if(empty($result)) {
        // Clear caches:
        $this->forgetCaches('customers-');
        $query = $customer->filter($params);
      
        $result = $query->paginate($paginate);

        $totalCustomer = Cache::remember('count-', $seconds, function() use ($query){
          return $query->count();
        });
        
      }
    

      $birth_years = collect(range(121, 0))->map(function ($item) {
        return (string) date('Y') - $item;
      });

      $birth_months = [];
      foreach (range(1, 12) as $m) {
          $birth_months[] = date('m', mktime(0, 0, 0, $m, 1));
      }

      return view('customers.index', [
        'allcustomers' => $result,
        'totalCustomer'   => $totalCustomer,
        'birth_years' => $birth_years,
        'birth_months' => $birth_months,
        'data'        => $params,
        'paginate'        => $paginate
      ]);
  }


   /**
   * flash cache
   * 
   * @return void
   * @author Lemonkazi <lemonpstu09@gmail.com>
   * @version 0.1 written in 2021-11-09
  */
    
  public static function forgetCaches($prefix)
  {
    
    Cache::flush();
  }

}