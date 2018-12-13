<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ixudra\Curl\Facades\Curl;
use \Chumper\Zipper\Facades\Zipper;

class GonvernmentPurchasesController extends Controller
{
    public function download()
    {
        echo '<pre>';
        print_r('Iniciando o processo de download.<br />');
        print_r('Criado o diretório.<br />');
        $directory = Storage::makeDirectory('public/201801');
        $directory = Storage::directories('');


        $response = Curl::to('http://www.portaltransparencia.gov.br/download-de-dados/compras/201801')
            ->withContentType('application/zip')
            ->download(storage_path('app/public/201801/201801.zip'));
        print_r('Download do arquivo ok.<br />');

        $patch  = storage_path('app/public/201801/201801.zip');

        print_r('Extraíndo o arquivo.<br />');
        Zipper::make($patch)->extractTo(storage_path('app/public/201801'));

        unlink($patch);
        print_r('Arquivo .zip deletado.<br />');


        print_r('Processo finalizado.<br />');
        echo '</pre>';
    }
}
