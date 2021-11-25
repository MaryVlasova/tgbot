<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BotSettings;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBotSettingsRequest;

class BotSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $settings = BotSettings::all();   
        return view('backend.settings.index', compact('settings'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BotSettings  $botSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(BotSettings $botSettings)
    {            
        return view('backend.settings.edit',compact('botSettings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateBotSettingsRequest  $request
     * @param  \App\Models\BotSettings  $botSettings
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBotSettingsRequest $request, BotSettings $botSettings)
    {

         $botSettings->update($request->only([
             'name', 
             'description',
             'info', 
             'token', 
             'link'
             ])) ;
      
        if ($request->file('img') !== null) {
            $botSettings->img = $request->file('img')->store('avatar', 'public');
        }

        $botSettings->save();

        return redirect()->route('admin.settings.edit', $botSettings)->with('success','Данные успешно обновлены');
    }


}
