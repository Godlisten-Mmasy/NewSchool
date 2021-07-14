<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportStudents;

class ImportStudentsExcelController extends Controller
{
    // function index()
    // {
    //     $data =DB::table('students')->orderBy('fname', 'sname', 'tname', 'class', 'phone')
    //     ->get();
    //     return view('import_excel', compact('data'));
    // }

    function import(request $request)
    {
        // $this->validate($request, [
        //     'select_file'       =>  'required|mines:xls,xlsx'
        // ]);

     
        $data =Excel::toArray( new ImportStudents,$request->file('select_file'));
         Excel::import(new importStudents, $request->file('select_file'));

    

        // if($data->count() > 0)
        // {
        //     foreach($data->toArray() as $key => $value)
        //     {
        //         foreach($value as $row)
        //         {
        //             $insert_data[] = array(
        //                 'firstName'     =>  $row['fname'],
        //                 'secondName'    =>  $row['sname'],
        //                 'lastName'      =>  $row['tname'],
        //                 'Class'         =>  $row['class'],
        //                 'Phone'         =>  $row['phone'],
        //             );
        //         }
        //     }

        //     if(!empty($insert_data))
        //     {
        //         DB::table('student')->insert($insert_data);
        //     }
        // }
        return back()->with('success', 'Excel Data Imported successfully.');
    }
}
