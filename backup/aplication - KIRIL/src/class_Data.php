<?php

class Data {

    private $carInfo;

    private $refuel_events;

    private $DataDirectory = "./config_data/";

    private $FileName = "datafile.json";

    private $driving_type = [
        "na" => "Без значение вид на шофиране",
        "city" => "Градско",
        "intercity" => "Извънградско",
        "mixed" => "Смесено"
    ];

    private $DataName = [
        "date" => "Дата",
        "distance" => "Изминато разстояние",
        "total_odo" => "Общо изминато разстояние",
        "fuel_quantity" => "Заредени литри",
        "fuel_amount" => "Цена на литър",
        "total_price" => "Обща сума",
        "gas_station_name" => "Марка гориво",
        "gas_station_product" => "Бензиностанция",
        "driving_type" => "Вид на шофиране"
    ];

    public function __construct() {
        $this->importData();
    }

    public function cheker( $Option ) : string {
        $AlowedActions = [
            "loadData",
            "interactData",
            "addData",
            "editData",
            "removeData"
        ];

        if ( in_array( $Option, $AlowedActions ) ) {
            return $this->$Option();
        } else {
            return $this->getNoFoundContent();
        }
    }
    
    public function addData() : string {

        $id = ( $_POST["id"] != "" ) ? $_POST["id"] : null;
        unset( $_POST["id"] );

        $Error = "";
        $Data = [];

        foreach ( $_POST as $Key=>$Value ) {
            // echo "<br>" . $Key . " = " . $Value;
            $Data[ $Key ] = $Value;
            if ( empty( $Value ) ) {
                $Error .= "; ".$this->DataName[$Key];
            }
        }

        $checkFUEL = [ "fuel_quantity", "fuel_amount", "total_price" ];

        // echo "<br><br>checkFUEL<br>";
        // print_r( $checkFUEL );
        

        $DataCheck = array_intersect_key($Data, array_flip($checkFUEL));
        // echo "<br><br>DataCheck<br>";
        // print_r( $DataCheck );
        $DataCheckExist = count( array_filter( $DataCheck ) );
        // echo "<br><br>DataCheckExist : ".$DataCheckExist."<br>";

        if ( $DataCheckExist < 2 ) {
            // echo "<br>Error not enought data to calculate.<br>";
            $Error .= "; Липсват стойностите на Заредени литри, Цена на литър и Обща сума за автоматично изчисление";
            $Error = substr($Error, 2);
            return $this->interactData( $Data, $Error );

        } elseif ( $DataCheckExist == 2 ) {
            // echo "<br>calculation<br>";
            if ( empty( $Data["fuel_quantity"] ) ) {
                $Data["fuel_quantity"] = $Data["total_price"] / $Data["fuel_amount"];
            }
            if ( empty( $Data["fuel_amount"] ) ) {
                $Data["fuel_amount"] = $Data["total_price"] / $Data["fuel_quantity"];
            }
            if ( empty( $Data["total_price"] ) ) {
                $Data["total_price"] = $Data["fuel_amount"] * $Data["fuel_quantity"];
            }

        } else {
            // echo "<br>checking price check<br>";
            if (
                $Data["fuel_quantity"] == ($Data["total_price"] / $Data["fuel_amount"]) &&
                $Data["fuel_amount"] == ($Data["total_price"] / $Data["fuel_quantity"]) &&
                $Data["total_price"] == ($Data["fuel_amount"] * $Data["fuel_quantity"])
            ) {
                // echo "<br>checking price check = ok <br>";
            } else {
                // echo "<br>checking price check = wrong <br>";
                $Error .= "; Стойностите за Заредени литри, Цена на литър и Обща сума са некоретни";
                $Error = substr($Error, 2);
                return $this->interactData( $Data, $Error, $id );
            }
        }

        if ( count( array_filter( $Data ) ) != count( $Data ) ) {
            $Error = substr($Error, 2);
            return $this->interactData( $Data, $Error, $id );
        } else {

            if ( $id != null ) {
                $this->refuel_events[$id] = (object)$Data;
            } else {
                $this->refuel_events[] = (object)$Data;
            }
            $this->exportData();
        }

    }

    public function editData() : string {
        // echo "<br>editData to BD<br>";
        // echo "<br>edit id = ".$_GET["id"]."<br>";
        $id = $_GET["id"];
        foreach ( $this->refuel_events[$id] as $Key=>$Value ) {
            // echo "<br>" . $Key . " = " . $Value;
            $Data[ $Key ] = $Value;
            if ( empty( $Value ) ) {
                $Error .= "; ".$this->DataName[$Key];
            }
        }
        $Error = substr($Error, 2);
        return $this->interactData( $Data, $Error, $id );
    }

    public function removeData() : void {
        // echo "<br>removeData to BD<br>";
        // echo "<br>remove id = ".$_GET["id"]."<br>";
        $id = $_GET["id"];
        // var_dump($this->refuel_events[$_GET["id"]]);
        unset($this->refuel_events[$id]);
        $this->refuel_events = array_values($this->refuel_events);

        $this->exportData();
    }

    public function importData() : void {
        $file = $this->DataDirectory . $this->FileName;
        if ( file_exists( $file ) ) {
            $json = file_get_contents( $file );
            $json_data = json_decode( $json );
            $this->carInfo = $json_data->carInfo;
            $this->refuel_events = $json_data->refuel_events;
        } else {
            echo "file nor found\n";
        }
    }
    
    public function exportData() : void {
        $file = $this->DataDirectory . $this->FileName;
        $Data = array( "carInfo" => $this->carInfo, "refuel_events" => $this->refuel_events );
        $JsonData = json_encode($Data, JSON_PRETTY_PRINT );
        if ( file_put_contents( $file, $JsonData ) ) {
            header('Location: index.php');
        } else {
            header('Location: index.php?error');
        }
    }

    public function interactData(array $DATA=[], string $Error="", int|null $id=null) : string {
        $result = "<section id=\"refuel_add\">
        <form method=\"POST\" action=\"?action=addData\">
        <input type=\"hidden\" name=\"id\" value=\"".$id."\"/>
            <table border=\"1\">
            <tr>
                <th>Дата</th>
                <td><input type=\"date\" name=\"date\" value=\"".$DATA["date"]."\" placeholder=\"Дата\"/></th>
            </tr>
            <tr>
                <th>Изминато разстояние</th>
                <td><input type=\"number\" name=\"distance\" value=\"".$DATA["distance"]."\" placeholder=\"километри\"/></th>
            </tr>
            <tr>
                <th>Общо изминато разстояние</th>
                <td><input type=\"number\" name=\"total_odo\" placeholder=\"километри\" /></th>
            </tr>
            <tr>
                <th>Заредени литри</th>
                <td><input type=\"number\" step=\"0.01\"  value=\"".$DATA["fuel_quantity"]."\" name=\"fuel_quantity\" placeholder=\"литри\" /></th>
            </tr>
            <tr>
                <th>Цена на литър</th>
                <td><input type=\"number\" step=\"0.01\"  value=\"".$DATA["fuel_amount"]."\" name=\"fuel_amount\" placeholder=\"цена\" /></th>
            </tr>
            <tr>
                <th>Обща сума</th>
                <td><input type=\"number\" step=\"0.01\"  value=\"".$DATA["total_price"]."\" name=\"total_price\" placeholder=\"Обща сума\" /></th>
            </tr>
            <tr>
                <th>Марка гориво</th>
                <td><input type=\"text\" name=\"gas_station_product\" placeholder=\"Марка гориво\" /></th>
            </tr>
            <tr>
                <th>Бензиностанция</th>
                <td><input type=\"text\" name=\"gas_station_name\" placeholder=\"Бензиностанция\" /></th>
            </tr>
            <tr>
                <th>Вид на шофиране</th>
                <td>
                    <select name=\"driving_type\">
                        <option value=\"\">Без значение</option>
                        <option value=\"city\">Градско</option>
                        <option value=\"intercity\">Извънградско</option>
                        <option value=\"mixed\">Смесено</option>
                        ".$this->fetchData()."
                    </select>
                </td>
            </tr>
        </table>
        <input type=\"submit\" value=\"Запази\" />
        </form>
        </section>";
        return $result;
            if ( !empty( $Data ) ) {
        
                $Data = (object) $Data;
        
            }
        
            ob_start();
            include 'views/interact.php';
            return ob_get_clean();
        
        }
    }
     
    private function fetchData() {
        $Data = array();
        $Error = '';
        if ($success) {
            $Data = $fetchedData;
        } else {
            $Error = 'Failed to fetch data';
            var_dump($Error);
        }
     
        var_dump($Data);
     
        return $Data;
    }
        foreach( $this->driving_type as $type=>$value ) {
            $result .= "<option value=\"".$type."\">".$value."</option>";
        }
                        $result .= "</select>
                </td>
            </tr>
            <tr>
                <td colspan=\"2\" align=\"right\">
                    <input type=\"submit\" value=\"Запис\" /> 
                </td>
            </tr>
            </table>";

            $result .= "<p style='color:red;'>".$Error."</p>";

            $result .= "</form>
    </section>";
        return $result;
    

    public function reportData() : string {
        return"reportData";
    }
    
    public function loadData() : string {
        $result = "<section id=\"refuel\">
        <a href=\"?action=interactData\">Добави</a><br/>
        </section><table border=\"1\">
        <tr>
            <th>Дата</th>
            <th>Изминато разстояние</th>
            <th>Общи километри</th>
            <th>Заредени литри</th>
            <th>Цена на литър</th>
            <th>Обща сума</th>
            <th>Бензиностанция</th>
            <th>Марка гориво</th>
            <th>Вид на шофиране</th>
            <th>Действие</th>
        </tr>";
        foreach ( $this->refuel_events as $id=>$row ) {
            $result .= "<tr>
            <td>" . $row->date . "</td>
            <td>" . $row->distance . "</td>
            <td>" . $row->total_odo . "</td>
            <td>" . $row->fuel_quantity . "</td>
            <td>" . $row->fuel_amount . "</td>
            <td>" . $row->total_price . "</td>
            <td>" . $row->gas_station_name . "</td>
            <td>" . $row->gas_station_product . "</td>
            <td>" . $this->driving_type[ $row->driving_type ] . "</td>
            <td><a href=\"?action=editData&id=" . $id . "\">Редактирай<a> | <a href=\"?action=removeData&id="  . $id . "\" onclick=\"return confirm('Сигурни ли сте че желаете да изтриете записа?') === true\">Изтрий</a></td>
        </tr>";

        }

        $result .= "</table>";
        return $result;
    }

    public function getNoFoundContent() : string {
        return "<br/><br/><div>Content not found</div>";
    }

    public function getHTML( $Content ) : string {
        $Title = "Разход на гориво.";
        $HTML_SOURCE = <<<HTML_SOURCE
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>$Title</title>
</head>
<body>
<section id="menu">
<a href="?action=loadData">Зареждане</a> | <a href="?action=reportData">Справка</a>
</section>
<hr/>
$Content
</body>
</html>
HTML_SOURCE;

    return $HTML_SOURCE;
    }

    public function getContent( string $Option = "loadData" ) : string {
        $Content = $this->cheker( $Option );
        return $this->getHTML( $Content );
    }
}