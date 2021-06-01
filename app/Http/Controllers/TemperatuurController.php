<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dagmeting;
use App\Models\Maanden;
use Illuminate\Http\Request;
use resources\views\overzicht;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Nieuwsbrief;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class TemperatuurController extends Controller
{


   public function index()
   {
       return view('selecteer');
   }
   public function detail(Request $request)
   {



       $maand = $request->input("maand",1);
       $cf = $request->input("Temperature", "C");
       // haalt op of het celsius of farenheit is.



       $metingen = Dagmeting::where('maandnr', $maand)->orderBy('dagnr', 'asc')->get();


       //dd($metingen);

       // pas de metingen op basis van C of F.
        $collection = collect();
       if ($cf == "F"){
           $metingen->map(function ($item, $key) {
               $item->minimum = (($item->minumum*9)/5)+32;
               $item->maximum = (($item->maximum*9)/5)+32;
               //dd($item);
               return $item;

           });
       }
       if ($cf == "K"){
           $metingen->map(function ($item, $key) {
               $item->minimum = $item->minumum+273.15;
               $item->maximum = $item->maximum+273.15;
               //dd($item);
               return $item;

           });
       }
       if ($cf == "Rankine"){
           $metingen->map(function ($item, $key) {
               $item->minimum = $item->minumum*1.8 + 32 + 459.67;
               $item->maximum = $item->maximum*1.8 + 32 + 459.67;
               //dd($item);
               return $item;

           });
       }
       if ($cf == "Réaumur"){
           $metingen->map(function ($item, $key) {
               $item->minimum = $item->minumum*0.8;
               $item->maximum = $item->maximum*0.8;
               //dd($item);
               return $item;

           });
       }

       //dd($multiplied);


       return view('overzicht',array('maand'=>$maand,'metingen'=>$metingen, 'Temperature'=>$cf, 'maandnamen'=>Maanden::namen()));
   }



    public function nieuwsbrief(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emailadres' => 'required|email'
        ]);
        if ($validator->fails()) {
            Log::error ('validatie fout: ', $request->all());
            return redirect('/');
        }
        $request->validate([
            'emailadres' => 'required|email'
        ]);
        $nieuwsbrief = new Nieuwsbrief();
        $nieuwsbrief->mailadres = $request->input('emailadres');
        $nieuwsbrief->save();
        return view('bedankt');
    }
}
