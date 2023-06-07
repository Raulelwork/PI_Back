<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PDFController extends Controller
{
    public function pdfreserva($id_reserva)
    {
        $reserva = FiestaController::pdfreserva($id_reserva);
        $usuario = User::find($reserva->id_cliente);

        // Generar el contenido HTML del PDF
        // dd($reserva);
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                }
                h1{
                    color: blue;
                }    
                table {
                    width: 50%;
                    margin-left: auto;
                    margin-right: auto;
                }
                img {
                    width: 300px;
                    height: 300px;
                }

                td {
                    padding: 5px;
                    border: none;
                    vertical-align: top;
                }
                
                .left {
                    text-align: left;
                }
            </style>
        </head>
        <body>
            <h1 style="text-align: center">' . $reserva->nombreempresa . '</h1>

            <h2>Datos de la reserva:</h2>
            <table>
            <tr>
                <td  class="left"><h3>Fecha:</h3></td>
                <td> <h3>' .  Carbon::parse($reserva->fecha)->format('d-m-Y') . '</h3></td>
            </tr>
            <tr>
                <td class="left">Consumiciones:</td>
                <td>' . $reserva->consumiciones . '</td>
            </tr>
            <tr>
                <td class="left">Precio:</td>
                <td>' . $reserva->precio . '€</td>
            </tr>
            <tr>
                <td class="left">Música:</td>
                <td>' . $reserva->musica . '</td>
            </tr>
            <tr>
                <td class="left">Temática:</td>
                <td>' . $reserva->tematica . '</td>
            </tr>
        </table>
          
        
        <h2>Datos del cliente:</h2>
            <table>
            <tr>
                <td class="left"><h3>DNI:</h3></td>
                <td><h3>' . $usuario->dni . '</h3></td>
            </tr>
            <tr>
                <td class="left">Nombre:</td>
                <td>' .  $usuario->nombre . '</td>
            </tr>
            <tr>
                <td class="left">Apellidos:</td>
                <td>' . $usuario->apellidos . '</td>
            </tr>
            
            <tr>
                <td class="left">Telefono:</td>
                <td>' . $usuario->telefono . '</td>
            </tr>

        </table>
        </body>
        </html>';
        if ($reserva->id_cliente == Auth::id()){
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->render();
            $pdfContent = $dompdf->output();
    
            return new Response($pdfContent, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="reservaPartyTime.pdf"'
            ]);
        }
    }
}
