<!doctype html>
<html lang="en">

<head>
    <script src="main.js" charset="utf-8"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>title</title>
    <script>
        //A Módosítás fülre kattintva aktiválódik
        //Megszámolja hány checkbox lett bejelölve
        //Ha pontosan 1 lett bejelölve, akkor a checkbox id alapján kitölti a Módosítás form input értékeit. Ellenkező esetben "hibaüzetet".
        //Minden sor checkbox id-je egyenlő az azonosítóval, és minden sor mezőértéke class-ban tartalmazza a sor azonosítóját.
        function edit() {
            var checkBox = document.getElementsByClassName("myCheck");
            var azonosito = 0;
            var selected_szamlalo = 0;
            for (var i = 0; i < checkBox.length; i++) {
                if (checkBox[i].checked == true) {
                    selected_szamlalo++;
                    azonosito = checkBox[i].id;
                }

            }
            if (selected_szamlalo == 1) {
                var sor = document.getElementsByClassName(azonosito);
                document.getElementById("edit_nevek").value = sor[1].innerHTML;
                document.getElementById("edit_leiras").value = sor[4].innerHTML;
                document.getElementById("edit_jelenleg").value = sor[0].innerHTML;
                filterSelection('modosit');

            }
            if (selected_szamlalo > 1) {
                return alert("Nem volt kikötve a feladatban, hogy egyszerre többet is lehessen szerkeszteni.");
            }
            if (selected_szamlalo == 0) {
                return alert("Nincs kiválasztva semmi!");
            }
        }
        //A torles metódus a törlés gombra kattintva lép működésbe, ami egyébként egy href
        //For ciklus megszámolja hány checkbox van bejelölve, ezt számolja is a selected_szamlalo változó
        //Mivel minden checkbox id-je megegyezik az adott feladat, tehát a sor azonosítójával, így az azonosito nevű tömbbe tárolásra kerülnek a checkbox id-k.
        //Ha a selected_szamlalo egyenlő nullával, akkor a törlés gomb linkjét "deaktiváljuk"
        //Ha a selected_szamlalo nem egyenlő nulla, akkor confirm után az URL delete/bejelölt checkbox id-k, tehát sorok azonosítói ,-vel elválasztva.
        //Később a controller az URL-t fogja feldarabolni megtudva abból hány és mely feladatokat kell törölni.
        function torles() {
            var selected_szamlalo = 0;
            var checkBox = document.getElementsByClassName("myCheck");
            var azonosito = [];
            for (var i = 0; i < checkBox.length; i++) {
                if (checkBox[i].checked == true) {
                    azonosito[i] = checkBox[i].id
                    selected_szamlalo++;
                };
            }
            if (selected_szamlalo == 0) {
                document.getElementById("delete").href = "#";
            } else {
                var r = confirm('Megerősíti?');
                if (r == true) {
                    document.getElementById("delete").href = "delete/" + azonosito;
                }
            }
        }
        //Új feladat vagy Módosítás fülre kattintva hozzáadja a lista típusú inputokhoz a patter attribútumokat,
        //hogy csak a listában szereplő dolgokat lehessen kiválasztani.
        //A $nevek egy tömb, a controller küldi, tartalmazza az összes ügyintéző nevét.
        function add() {
            var feltetel = @json($nevek);
            var feltetelek = "";
            for (var i = 0; i < feltetel.length; i++) {
                feltetelek += feltetel[i].nev + "|";
            }
            document.getElementsByClassName("add")[0].pattern = feltetelek;
            document.getElementsByClassName("add")[1].pattern = feltetelek;
        }
        //Ez a Módosítás / Mentés gombra kattintva lép érvénybe.
        //Leveszi a disable attribútumot a "Jelenleg ezt a sorszámú feladatot szerkeszted:" inputjáról.
        //Ez azért szükséges, mert a disabled input nem küldi el POST üzenetként az input értékét. (VALUE)
        //Ami pedig kell, hogy beazonosítsuk, hogy mely feladatot szerkeszti a felhasználó.
        //Disable pedig azért szükséged, hogy ne tudjon beírni olyan azonosítót a Módosítás fülnél, ami nem is létezik.
        function removedisable() {
            document.getElementById("edit_jelenleg").removeAttribute("disabled");
        }
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style media="screen">
        table {
            width: 100%;
        }

        .card {
            width: 140%;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        .column {
            display: none;
        }

        .show {
            display: block;
        }

        #page {
            min-height: 396px;
        }

        @media screen and (max-width: 800px) {
            .card {
                width: 200%;
            }
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/hw') }}">Feladatok</a>
        </div>
    </nav>
    <main>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn active" onclick="filterSelection('feladat');add();">Új feladat</button>
                            <button class="btn active" onclick="edit();add();">Módosítás</button>
                            <a id="delete" href="#">
                                <button class="btn active" onclick="torles();">Törlés</button>
                            </a>
                            <button class="btn active" onclick="filterSelection('keres');kereses();">Keresés</button>

                        </div>

                        <div class="card-body">
                            <div id="page">
                                <table>
                                    <tr>
                                        <th>Kijelölés</th>
                                        <th>Azonosító</th>
                                        <th>Ügyintéző neve</th>
                                        <th>Ügyintéző email</th>
                                        <th>Létrehozás dátuma</th>
                                        <th>Leírás</th>
                                    </tr>
                                    <!-- Táblázat feltöltése -->
                                    @foreach ($html as $sorok)
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="{{$html[$loop->index]->azonosito}}" class="myCheck">
                                        </td>
                                        <td class="{{$html[$loop->index]->azonosito}}">{{$html[$loop->index]->azonosito}}</a>
                                        </td>
                                        <td class="{{$html[$loop->index]->azonosito}}">{{$html[$loop->index]->nev}}</td>
                                        <td class="{{$html[$loop->index]->azonosito}}">{{$html[$loop->index]->email}}</td>
                                        <td class="{{$html[$loop->index]->azonosito}}">{{$html[$loop->index]->datum}}</td>
                                        <td class="{{$html[$loop->index]->azonosito}}">{{$html[$loop->index]->leiras}}</td>
                                    </tr>

                                    @endforeach

                                </table>
                            </div>
                            <!--Oldal lapozás-->
                            {{ $html->appends(request()->except('page'))->links() }}

                            <!-- Új feladat form -->
                            <form id="action" class="column feladat" action="/add" method="post">
                                @csrf
                                <label class="">Ügyintéző neve</label>
                                <input class="add" list="nevek" name="nevek" pattern="" required>
                                <datalist id="nevek">
                                    @foreach ($nevek as $film)
                                    <option value="{{$nevek[$loop->index]->nev}}">
                                        @endforeach
                                </datalist>

                                <label>Leírás</label>
                                <textarea name="leiras" required></textarea>

                                <button type="submit">Mentés</button>
                            </form>
                            </table>

                            <!-- Módosítás form -->
                            <form id="action" class="column modosit" action="/edit" method="post">
                                @csrf
                                <label>Jelenleg ezt a sorszámú feladatot szerkeszted:</label>
                                <br>
                                <input id="edit_jelenleg" name="azonosito" disabled required>
                                <label>Ügyintéző neve</label>
                                <input id="edit_nevek" class="add" list="nevek" name="nevek" pattern="" required>
                                <datalist id="nevek">
                                    @foreach ($nevek as $film)
                                    <option value="{{$nevek[$loop->index]->nev}}">
                                        @endforeach
                                </datalist>
                                <label>Leírás</label>
                                <textarea id="edit_leiras" name="leirass" required></textarea>

                                <button onclick="removedisable();" type="submit">Mentés</button>

                                <!-- Keresés form -->
                            </form>
                            <form class="column keres" action="/keres" method="get">

                                <label>Ügyintéző neve:</label>
                                <br>
                                <input name="nev">
                                <label>Leírás</label>
                                <input name="leiras">
                                <label>Létrehozás dátuma</label>
                                <input type="date" name="datum">
                                <button type="submit">Keresés</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </main>

    </div>
</body>

</html>
