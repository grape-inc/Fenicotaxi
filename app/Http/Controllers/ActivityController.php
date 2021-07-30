<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;


class ActivityController extends Controller
{
    public function index() {
        $activities = Activity::all();
        return view('Activity.index', ["records" => $activities]);
    }

    public static function urlPath($log) {
        switch ($log->subject_type) {
            case "App\Producto":
                echo "<a href='Inventario/Productos/$log->subject_id/edit'>$log->subject_id </a>";
                break;
            case "App\Arqueo":
                echo "<a href='Facturacion/Arqueo/$log->subject_id/edit'>$log->subject_id </a>";
                break;
            case "App\FacturaVenta":
                echo "<a href='Facturacion/Venta/$log->subject_id/edit'>$log->subject_id </a>";
                break;
            case "App\Ingreso":
                echo "<a href='Inventario/Ingresos/$log->subject_id/edit'>$log->subject_id </a>";
                break;
            default:
                echo $log->subject_id;
                break;
        }
    }
}
