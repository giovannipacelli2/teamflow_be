<?php

namespace App\Include;

use Illuminate\Http\Request;
use App\Include\ApiFunctions;

class SortFilter
{

    /**
     * Sort and filter fields based on the provided actions.
     *
     * @param Request $request is the current request
     * @param object $model is the current model
     *         
     * @param array $actions An associative array that contains:
     *     - 'sort' (bool): Whether the field should be sorted.
     *     - 'filter' (bool): Whether the field should be filtered.
     *     - 'data' (array): An associative array that contains:
     *         - 'field' (string): The name of the field to operate on.
     *
     * @return void
     */
    public static function sortFilter(Request $request, &$model, array $actions = [
        'sort' => true,
        'filter' => true,
        'date' => [
            'field' => ''
        ],
    ])
    {

        $params = self::getParams($request);
        // sorting
        $sortBy = $params['sortBy'];
        $sortValue = $params['sortValue'];

        // filtering
        $filterBy = $params['filterBy'];
        $filterValue = $params['filterValue'];

        // data filter
        $start = $request->query('start') ?? '';
        $end = $request->query('end') ?? '';


        // sorting data

        if ($actions['sort']) {            
            $sortingObj = ApiFunctions::getSorting($sortBy, $sortValue, $model);
            $model = $sortingObj['isSorted'] ? $sortingObj['instance'] : $model;
        }

        // filtering Data

        if ($actions['filter']) {            
            $filterObj = ApiFunctions::fiterInstance($filterBy, $filterValue, $model);
            $model = $filterObj['isFiltered'] ? $filterObj['instance'] : $model;
        }


        // filtering DATE

        if ($actions['date'] && $actions['date']['field'] !== '') {

            $date = null;

            if ($start !== '' || $end !== '') {
                $date = ApiFunctions::checkCorrectDates([
                    'start' => $start,
                    'end' => $end
                ]);

                $start = $date['start']->format('Y-m-d H:i:s');
                $end = $date['end']->format('Y-m-d H:i:s');
            }

            if ($date){
                $field = $actions['date']['field'];
                $model = $model->whereBetween($field, [$start, $end]);
            }
        }
    }

    public static function getParams(Request $request)
    {
        // sorting
        $sortBy = explode('|', $request->query('sortBy')) ?? '';
        $sortValue = explode('|', $request->query('sortValue')) ?? '';

        // filtering
        $filterBy = explode('|', $request->query('filterBy')) ?? '';
        $filterValue = explode('|', $request->query('filterValue')) ?? '';


        //adjust order values
        
        $sortValue = array_map(function($value){
            if ($value === 'ascend') {
                return 'asc';
            } else if ($value === 'descend') {
                return 'desc';
            }
            else {
                return $value;
            }
        }, $sortValue);

        return [
            'sortBy' => $sortBy,
            'sortValue' => $sortValue,
            'filterBy' => $filterBy,
            'filterValue' => $filterValue,
        ];

    }
}
