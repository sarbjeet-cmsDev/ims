<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderPracticeController extends Controller
{
    public function index()
    {
        $data = DB::table('users')
            ->select('id', 'name', 'email')
           //->orderBy('name', 'asc')  // ascending order
            //->orderBy('name', 'desc')  // descending order
            //->where('name', 'sam') // where condition
            //->whereBetween('id', [1, 10]) // where between condition
            //->whereNotBetween('id', [1, 10]) // where not between condition
            //->whereIn('id', [1, 2, 3]) // where in condition
            //->whereNotIn('id', [1, 2, 3]) // where not in condition
           //->orderBy('name', 'desc') desc order
           //->where('name','=','sam') accoring condition
           // ->take(1) //if only show one record
            ->get();
        
        return view('qb.index', compact('data'));
    }
}

