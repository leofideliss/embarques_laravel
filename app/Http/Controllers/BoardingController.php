<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\BoardingModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use PhpParser\Node\Expr\FuncCall;

class BoardingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->updateStatus();
        $boarding = DB::table('boarding_models')->orderBy('date_prod')->where(['status' => 0])->get();
        return view('index', compact('boarding'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boarding');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['fat' => 'required|unique:boarding_models']);
        BoardingModel::create($request->all());
        return redirect()->route('boarding.index')->with('message', 'Embarque cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fat)
    {
        $fat_serach = str_replace('-', '/', $fat);
        $fat_serach = str_replace('*', '-', $fat_serach);
        $board = DB::table('boarding_models')->where('fat', '=', $fat_serach)->first();

        if (Auth::check() === true)
            return view('boarding', compact('board'));
        else
            return view('boarding_user', compact('board'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fat)
    {
        $fat_serach = str_replace('-', '/', $fat);
        $fat_serach = str_replace('*', '-', $fat_serach);
        if (Auth::check() === true) {
            $request->validate(['fat' => 'required']);
            BoardingModel::where(['fat' => $fat_serach])->update([
                'fat' => $request->fat,
                'client' => $request->client,
                'agent' => $request->agent,
                'date_doc' => $request->date_doc,
                'date_delivery' => $request->date_delivery,
                'date_loading' => $request->date_loading,
                'date_boarding' => $request->date_boarding,
                'date_prod' => $request->date_prod,
                'obs' => $request->obs,
                'status' => 0,

            ]);
        }
        else
        {
            BoardingModel::where(['fat' => $fat_serach])->update([
                'obs' => $request->obs,
            ]);
        }
        return redirect()->route('boarding.index')->with('message', 'Embarque Atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($fat)
    {
        DB::table('boarding_models')->where('fat', '=', $fat)->delete();
        return redirect()->route('boarding.index')->with('message', 'Apagado com sucesso');
    }


    public function updateStatus(){
        $boards = BoardingModel::all();
        
        foreach($boards as $board)
        {
            if(isset($board->date_doc) && isset($board->date_delivery) && isset($board->date_loading) && isset($board->date_boarding) && isset($board->date_prod))
            {
                BoardingModel::where(['fat' => $board->fat])->update([
                    'status' => 1,    
                ]);
            }
        }
    }

    public function boardingFinish(){
        $this->updateStatus();
        $boarding = DB::table('boarding_models')->orderBy('date_prod')->where(['status' => 1])->get();
        return view('index', compact('boarding'));
    }
}
