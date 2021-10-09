<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;


class ParseFileController extends Controller
{
    public function index() {
        return view('sendfile');
    }

    public function getDataFile() {
        $filename = 'parseText.txt';
        $filePath = public_path('/uploads/' . $filename);

        $longitudDeLinea = 1000;
        $delimitador = ",";
        $caracterCircundante = '"';

        $gestor = fopen($filePath, "r");
        if (!$gestor) {
            dd("No se puede abrir el archivo $filePath");
        }

        $numeroDeFila = 1;
        $Columns = array();
        $Rows = array();
        $temps = array();

        $client = new Client();
        while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
            foreach ($fila as $numeroDeColumna => $columna) {
                if ($numeroDeFila === 1) {
                        array_push($Columns, $columna);
                }
            }
            if($numeroDeFila > 1) {
                array_push($Rows, $fila);

                $url = "https://api.openweathermap.org/data/2.5/weather?q=".$fila[1]."&units=metric&appid=e63a92d64a9294491e83e0b589f334fc";
                $response = $client->request('GET', $url, [
                    'verify'  => false,
                ]);
                $responseBody = json_decode($response->getBody());
                array_push($temps, $responseBody->main->temp);
            }

            $numeroDeFila++;
        }
        array_push($Columns, 'Temperatura');
        fclose($gestor);


        $html = view("table-sendfile",compact('Columns', 'Rows','temps'))->render();

        return json_encode(array('html' => $html));
    }

    public function uploadToServer(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $name = 'parseText.'.request()->file->getClientOriginalExtension();
        $request->file->move(public_path('uploads'), $name);
        return view('sendfile');
    }
}
