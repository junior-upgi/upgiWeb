<?php
//
namespace App\Http\Controllers;

use App\Service\GlassService;

//
class GlassController
{
    private $glass;

    //
    public function __construct(
        GlassService $glass
    ) {
        //
        $this->glass = $glass;
    }

    //
    public function info()
    {
        return view('production.info')
            ->with('auth', true);
    }

    //
    public function importGlass()
    {
        return view('production.importGlass')
            ->with('auth', true);
    }

    //
    public function importGlassData()
    {
        return $this->glass->importGlass(request()->file('glassFile'));
    }

    //
    public function getGlassProductionInfo($search = null)
    {
        return $this->glass->getGlass($search);
    }

    //
    public function getTodayImportGlassData()
    {
        return $this->glass->getTodayImportGlassData();
    }
}
