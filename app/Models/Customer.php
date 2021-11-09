<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sample_data';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'ip',
        'phone',
        'country',
        'birthday'
    ];

    /**
     * The attributes that are partially match filterable.
     *
     * @var array
     */
    protected $partialFilterable = [
        'name'

    ];

    /**
     * The attributes that are exact match filterable.
     *
     * @var array
     */
    protected $exactFilterable = [
        'id'
    ];



     /**
     * filter data based request parameters
     * 
     * @param array $params
     * @return $query
     */
    public function filter($params)
    {
        $query = $this->newQuery();
        $request = request();
        if (empty($params) || !is_array($params)) {
            return $query;
        }

        $fromFilterDate = null;
        $toFilterDate = null;
        $sortingParams = [];
        if ($request->get('birth_year')) {
      
            if(!empty($request->get('birth_year')) && !empty($params['birth_month'])) {
              $query->whereMonth('birthday', '<=', $params['birth_month'])
                ->whereMonth('birthday', '>=', $params['birth_month'])
                ->whereYear('birthday', $params['birth_year'])
                      ->orWhere(function($query) use ($params) {
                          $query->whereMonth('birthday', '=', null)
                            ->whereYear('birthday', '=', null);
                      })
                      ->orWhere(function($query) use ($params) {
                          $query->whereMonth('birthday', '=', null)
                            ->whereMonth('birthday', '>=', $params['birth_month'])
                            ->whereYear('birthday', '=', $params['birth_year']);
                      })
                      ->orWhere(function($query) use ($params) {
                          $query->whereMonth('birthday', '<=', $params['birth_month'])
                            ->whereMonth('birthday', '=', null)
                            ->whereYear('birthday', '=', $params['birth_year']);
                      });
            }
            if(!empty($request->get('birth_year')) && empty($params['birth_month'])) {
              $query->whereYear('birthday', $params['birth_year'])
                      ->orWhere(function($query) use ($params) {
                          $query->whereMonth('birthday', '=', null)
                            ->whereYear('birthday', '=', null);
                      })
                      ->orWhere(function($query) use ($params) {
                          $query->whereMonth('birthday', '=', null)
                            ->whereYear('birthday', '=', $params['birth_year']);
                      })
                      ->orWhere(function($query) use ($params) {
                          $query->whereMonth('birthday', '=', null)
                            ->whereYear('birthday', '=', $params['birth_year']);
                      });
            }
            if(!empty($request->get('birth_month')) && empty($params['birth_year'])) {
              $query->whereMonth('birthday', '<=', $params['birth_month'])
                ->whereMonth('birthday', '>=', $params['birth_month'])
                      ->orWhere(function($query) use ($params) {
                          $query->whereMonth('birthday', '=', null)
                            ->whereYear('birthday', '=', null);
                      })
                      ->orWhere(function($query) use ($params) {
                          $query->whereMonth('birthday', '=', null)
                            ->whereMonth('birthday', '>=', $params['birth_month']);
                      })
                      ->orWhere(function($query) use ($params) {
                          $query->whereMonth('birthday', '<=', $params['birth_month'])
                            ->whereMonth('birthday', '=', null);
                      });
            }
        }

        if (isset($params['sort'])) { 
            $sortingParams = explode(',', $params['sort']);
            unset($params['sort']);
        }
        

        foreach ($params as $key => $value) { 
            if (in_array($key, $this->partialFilterable)) { 
                $query->where($key, 'LIKE', "%{$value}%");
            } elseif (in_array($key, $this->exactFilterable)) {
                $query->where($key, '=', $value);
            } 
        }

        if (!empty($sortingParams)) { 
            
            $column = null;
            $direction = null;

            foreach ($sortingParams as $sortingParam) {
                $columnAndDirection = explode(':', str_replace(' ', '', $sortingParam));

                if (!empty($columnAndDirection[0])) {
                    $column = $columnAndDirection[0];
                } else {
                    continue;
                }

                if (!empty($columnAndDirection[1])) {
                    $direction = $columnAndDirection[1];
                } else {
                    $direction = 'asc';
                }

                if (in_array($column, $this->fillable)) {
                    $query->orderBy($column, $direction);
                }
            }

        } 
        return $query;
    }

}
