<?php

namespace App\Http\Controllers\Admin;

use App\FuneralHome;
use App\MapPin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

class FuneralHomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('filter')) {
            if ($request->get('filter') === 'partners') {
                $items = FuneralHome::whereNotNull('user_id')->paginate(20);
            }
        }else {
            $items = FuneralHome::paginate(20);
        }
        
        return view('admin.funeral-home.index', compact('items'));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }
    
    public function saveImportFile(Request $request)
    {
        $file = $request->file('file');
        $filename = uniqid('fh-import_') . '.' . $file->getClientOriginalExtension();
        $path = public_path('/uploads/fh-imports');
        
        $file->move($path, $filename);
        
        return $filename;
    }
    
    public function importExcel(Request $request)
    {
        $takeRows = $request->takeRows != 0 ? $request->takeRows : 20;
        $skipRows = $request->skipRows;
        
        ini_set('max_execution_time', 0);
        Excel::load('public/uploads/fh-imports/' . $request->path, function ($reader) use ($takeRows, $skipRows){
            $rows = $reader->skipRows($skipRows)->takeRows($takeRows);
            
            foreach ($rows->toArray() as $key => $row) {
                
                $funeralHome = new FuneralHome();
                $funeralHome->name = $row['fh_business_name'];
                $funeralHome->contact_name = 'N/A';
                $funeralHome->communities_served = 'N/A';
                $funeralHome->email = is_null($row['email']) ? 'N/A' : $row['email'];
                $funeralHome->phone_number = is_null($row['fh_phone_number']) ? 'N/A' : $row['fh_phone_number'];
                $funeralHome->address = $row['address'];
                $funeralHome->zip_code = $row['zip_code'];
                
                $funeralHome->save();
                $mapPin = new MapPin();
                
                $address = $funeralHome->address;
                
                $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyB3q8fmSh03BBRo1v7xBbq85zMrUeSCkpY&address=' . $address . '&sensor=false');
                $output = json_decode($geocode);
                $latitude = $output->results[0]->geometry->location->lat;
                $longitude = $output->results[0]->geometry->location->lng;
                
                $mapPin->entity_id = $funeralHome->id;
                $mapPin->entity = FuneralHome::class;
                $mapPin->longitude = $longitude;
                $mapPin->latitude = $latitude;
                
                $mapPin->save();
            }
        });
        
        return response()->json([
            'takeRows' => $takeRows,
            'skipRows' => $skipRows
        ]);
    }
}
