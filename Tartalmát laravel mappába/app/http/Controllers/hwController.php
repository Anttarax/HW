<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hwController extends Controller {
      //Összeköti a két táblát, lekérdezi az összes adatot
      //Neveket külön tároljuk
    public function index() {

        $adatok = DB::table('ugyintezo')
        ->join('feladatok', 'ugyintezo.azonosito', '=', 'feladatok.ugy_id')
        ->select('*')
        ->paginate(10);

        $nevek = DB::select('SELECT nev FROM ugyintezo');

        return view('hw', ['html' => $adatok], ['nevek' => $nevek]);
    }
      //URL-ben megkapja a kijelölt feladatok azonosítóit vesszővel elválasztva, ezért feldarabolja az URL-t
      //Áthelyezi a törölni kívánt azonosítókat a $darab tömbbe, kitörli az összes törölni kívánt feladatot.
    public function delete($id) {

        $darab = explode(",", $id);

        foreach ($darab as $key) {
            DB::insert('DELETE FROM feladatok WHERE azonosito = ?', [$key]);
        }

        return redirect('hw');
    }

    public function add(Request $req) {
      //Név alapján beazonosítjuk az ügyintéző azonosítóját.
        $idkeres = DB::select('SELECT azonosito FROM ugyintezo WHERE nev = ?', [$req->nevek]);
      //Lekérdezzük a feladatok legnagyobb azonosítóját, később ehhez hozzáadunk egyet.
      //Auto independent az azonosito oszlop az adatbázisban, de sajnos nem találtam más megoldást, másképpen nem szerette volna insertálni a sort.
        $id = DB::select('SELECT MAX(azonosito) as azonosito FROM feladatok');
      //Jelenlegi dátum
        $date = date("Y-m-d");
      //Adatok insertálása.
        DB::table('feladatok')
        ->insert([['azonosito' => $id[0]->azonosito + 1, 'ugy_id' => $idkeres[0]->azonosito, 'datum' => $date, 'leiras' => $req->leiras], ]);

        return redirect('hw');
    }

    public function edit(Request $req) {
        $idkeres = DB::select('SELECT azonosito FROM ugyintezo WHERE nev = ?', [$req->nevek]);

        DB::table('feladatok')
        ->where('azonosito', $req->azonosito)
        ->update(['ugy_id' => $idkeres[0]->azonosito, 'leiras' => $req->leirass]);

        return redirect('hw');
    }

    public function keres(Request $req) {
        $nevek = DB::select('SELECT nev FROM ugyintezo');

        if ($req->nev != "" && $req->leiras != "") {
            $adatok = DB::table('ugyintezo')
            ->join('feladatok', 'ugyintezo.azonosito', '=', 'feladatok.ugy_id')
            ->select('*')
            ->where('ugyintezo.nev', 'LIKE', '%' . $req->nev . '%')
            ->orwhere('feladatok.leiras', ' LIKE', '%' . $req->leiras . '%')
            ->paginate(10);
        }
        if ($req->nev != "") {
            $adatok = DB::table('ugyintezo')
            ->join('feladatok', 'ugyintezo.azonosito', '=', 'feladatok.ugy_id')
            ->select('*')
            ->where('ugyintezo.nev', 'LIKE', '%' . $req->nev . '%')
            ->paginate(10);
        }
        if ($req->leiras != "") {
            $adatok = DB::table('ugyintezo')
            ->join('feladatok', 'ugyintezo.azonosito', '=', 'feladatok.ugy_id')
            ->select('*')
            ->where('feladatok.leiras', 'LIKE', '%' . $req->leiras . '%')
            ->paginate(10);
        }
        if ($req->datum != "") {
            $adatok = DB::table('ugyintezo')
            ->join('feladatok', 'ugyintezo.azonosito', '=', 'feladatok.ugy_id')
            ->select('*')
            ->where('feladatok.datum', '=', $req->datum)
            ->paginate(10);
        }

        return view('hw', ['html' => $adatok], ['nevek' => $nevek]);
    }
}
