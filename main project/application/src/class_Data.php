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
        "gas_station_name" => "Бензиностанция",
        "gas_station_product" => "Марка гориво",
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
            "removeData",
            "loadingReport"
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
            $Data[ $Key ] = $Value;
            if ( empty( $Value ) ) {
                $Error .= "; ".$this->DataName[$Key];
            }
        }
        $checkFUEL = [ "fuel_quantity", "fuel_amount", "total_price" ];
        $DataCheck = array_intersect_key($Data, array_flip($checkFUEL));
        $DataCheckExist = count( array_filter( $DataCheck ) );
        if ( $DataCheckExist < 2 ) {
            $Error .= "; Липсват стойностите на Заредени литри, Цена на литър и Обща сума за автоматично изчисление";
            $Error = substr($Error, 2);
            return $this->interactData( $Data, $Error );
        } elseif ( $DataCheckExist == 2 ) {
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
            if (
                $Data["fuel_quantity"] == ($Data["total_price"] / $Data["fuel_amount"]) &&
                $Data["fuel_amount"] == ($Data["total_price"] / $Data["fuel_quantity"]) &&
                $Data["total_price"] == ($Data["fuel_amount"] * $Data["fuel_quantity"])
            ) {
            } else {
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
        $id = $_GET["id"];
        foreach ( $this->refuel_events[$id] as $Key=>$Value ) {
            $Data[ $Key ] = $Value;
            if ( empty( $Value ) ) {
                $Error .= "; ".$this->DataName[$Key];
            }
        }
        $Error = substr($Error, 2);
        return $this->interactData( $Data, $Error, $id );
    }

    public function removeData() : void {
        $id = $_GET["id"];
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
            usort($this->refuel_events, function($a, $b) {
                return $a->date > $b->date ? 1 : -1;
            }); 
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
            <table border=\"1\" width=\"350\">
            <tr>
                <th>";                
                if (str_contains( $Error, $this->DataName["date"])) {
                    $result .= "<span style=\"color: red;\">".$this->DataName["date"]."</span>";
                } else {
                    $result .= $this->DataName["date"];
                }
                $result .= "</th>
                <td><input type=\"date\" name=\"date\" value=\"".$DATA["date"]."\" placeholder=\"Дата\"/></th>
            </tr>
            <tr>
                <th>";                
                if (str_contains( $Error, $this->DataName["distance"])) {
                    $result .= "<span style=\"color: red;\">".$this->DataName["distance"]."</span>";
                } else {
                    $result .= $this->DataName["distance"];
                }
                $result .= "</th>
                <td><input type=\"number\" name=\"distance\" value=\"".$DATA["distance"]."\" placeholder=\"километри\"/></th>
            </tr>
            <tr>
                <th>";
                if (str_contains( $Error, $this->DataName["total_odo"])) {
                    $result .= "<span style=\"color: red;\">".$this->DataName["total_odo"]."</span>";
                } else {
                    $result .= $this->DataName["total_odo"];
                }
                $result .= "</th>
                <td><input type=\"number\" name=\"total_odo\" value=\"".$DATA["total_odo"]."\" placeholder=\"километри\" /></th>
            </tr>
            <tr>
                <th>";
                if (str_contains( $Error, $this->DataName["fuel_quantity"])) {
                    $result .= "<span style=\"color: red;\">".$this->DataName["fuel_quantity"]."</span>";
                } else {
                    $result .= $this->DataName["fuel_quantity"];
                }
                $result .= "</th>
                <td><input type=\"number\" step=\"0.01\"  value=\"".$DATA["fuel_quantity"]."\" name=\"fuel_quantity\" placeholder=\"литри\" /></th>
            </tr>
            <tr>
                <th>";
                if (str_contains( $Error, $this->DataName["fuel_amount"])) {
                    $result .= "<span style=\"color: red;\">".$this->DataName["fuel_amount"]."</span>";
                } else {
                    $result .= $this->DataName["fuel_amount"];
                }
                $result .= "</th>
                <td><input type=\"number\" step=\"0.01\"  value=\"".$DATA["fuel_amount"]."\" name=\"fuel_amount\" placeholder=\"цена\" /></th>
            </tr>
            <tr>
                <th>";
                if (str_contains( $Error, $this->DataName["total_price"])) {
                    $result .= "<span style=\"color: red;\">".$this->DataName["total_price"]."</span>";
                } else {
                    $result .= $this->DataName["total_price"];
                }
                $result .= "</th>
                <td><input type=\"number\" step=\"0.01\"  value=\"".$DATA["total_price"]."\" name=\"total_price\" placeholder=\"Обща сума\" /></th>
            </tr>
            <tr>
                <th>";
                if (str_contains( $Error, $this->DataName["gas_station_product"])) {
                    $result .= "<span style=\"color: red;\">".$this->DataName["gas_station_product"]."</span>";
                } else {
                    $result .= $this->DataName["gas_station_product"];
                }
                $result .= "</th>
                <td><input type=\"text\" name=\"gas_station_product\" value=\"".$DATA["gas_station_product"]."\" placeholder=\"Марка гориво\" /></th>
            </tr>
            <tr>
                <th>";
                if (str_contains( $Error, $this->DataName["gas_station_name"])) {
                    $result .= "<span style=\"color: red;\">".$this->DataName["gas_station_name"]."</span>";
                } else {
                    $result .= $this->DataName["gas_station_name"];
                }
                $result .= "</th>
                <td><input type=\"text\" name=\"gas_station_name\" value=\"".$DATA["gas_station_name"]."\" placeholder=\"Бензиностанция\" /></th>
            </tr>
            <tr>
                <th>";
                
                $result .= $this->DataName["driving_type"];
                $result .= "</th>
                <td>
                    <select name=\"driving_type\">
                        <option value=\"na\"";
                        $result .= ($DATA["driving_type"]=="na") ? " selected" : NULL; 
                        $result .= ">Без значение</option>
                        <option value=\"city\"";
                        $result .= ($DATA["driving_type"]=="city") ? " selected" : NULL;
                        $result .= ">Градско</option>
                        <option value=\"intercity\"";
                        $result .= ($DATA["driving_type"]=="intercity") ? " selected" : NULL;
                        $result .= ">Извънградско</option>
                        <option value=\"mixed\"";
                        $result .= ($DATA["driving_type"]=="mixed") ? " selected" : NULL;
                        $result .= ">Смесено</option>
                    </select>
                </td>
            </tr>
            <tr>
            <td colspan=\"2\" align=\"right\">
                <input type=\"submit\" value=\"Запис\" /> 
            </td>
        </tr>";
        if ( !empty( $Error ) ) {
            $result .= "<tr><td colspan=\"2\" align=\"center\">Откири са следните непопълнени полета :<br><span style=\"color: red;\">$Error</span></td></tr>";
        } 
        $result .= "</table></form>
        </section>";
        return $result;
    }

    public function dataModel() {
        $ProcessingData = $this->refuel_events;
        $obj = new stdClass();
        $LastEvent = end( $this->refuel_events );
        $LastDistance = $LastEvent->distance;
        $LastFuelCharging = $LastEvent->fuel_quantity;
        $LastTotalPrice = $LastEvent->total_price;
        $obj->LastDistance = $LastDistance;
        $obj->LastEventConsumntion = round( ( ( $LastFuelCharging  / $LastDistance ) * 100 ), 2 );
        $obj->LastPricePerDistance = round( ( $LastTotalPrice / $LastDistance ), 2 );
        $AllMonths = array();
        $AllTotalPrices = array();
        $AllFuelQuantity = array();
        $DaysTimeStamp = array();
        $SumDistance = array();
        $AllStationNames = array();
        $AllStationProducts = array();
        $AllDrivingType = array();
        foreach ( $this->refuel_events as $Event ) {
            array_push( $AllMonths, date('m', strtotime( $Event->date ) ) );
            array_push( $AllTotalPrices, $Event->total_price );
            array_push( $AllFuelQuantity, $Event->fuel_quantity );
            array_push( $DaysTimeStamp, strtotime( $Event->date ) );
            array_push( $SumDistance, $Event->distance );
            if ( !in_array( $Event->driving_type , $AllDrivingType ) ) {
                $AllDrivingType[] = $Event->driving_type;
            }
            if ( !in_array( $Event->gas_station_name , $AllStationNames ) ) {
                $AllStationNames[] = $Event->gas_station_name;
            }
            $NameProduct = $Event->gas_station_product;
            $KeyOfGropuId = array_search( $Event->gas_station_name , $AllStationNames );
            if ( isset( $AllStationProducts[ $KeyOfGropuId ] ) ) {
                if ( !in_array( $NameProduct, $AllStationProducts[ $KeyOfGropuId ] ) ) {
                    $AllStationProducts[ $KeyOfGropuId ][] = $NameProduct;
                }
            } else {
                $AllStationProducts[ $KeyOfGropuId ] = array();
                $AllStationProducts[ $KeyOfGropuId ][] = $NameProduct;
            }
        }
        $AllMonths = array_unique( $AllMonths );
        $InitDay = $DaysTimeStamp[ 0 ];
        $PeriodsOfRefuel = array();
        for($i = 1; $i < count( $DaysTimeStamp ); $i++){
            $ThisPeriod = $DaysTimeStamp[$i] - $InitDay;
            $InitDay = $DaysTimeStamp[$i];
            $PeriodsOfRefuel[] = $ThisPeriod / 86400;
        }
        unset($InitDay);
        $obj->AvgCharging = round( count( $this->refuel_events ) / count( $AllMonths ) , 0) ;
        $obj->AvgSumAmount = round( array_sum( $AllTotalPrices ) / count( $AllMonths ) , 2 );
        $obj->AvgSumFuel = round( array_sum( $AllFuelQuantity ) / count( $AllMonths ) , 2 );
        $obj->AvgPeriodCharging = round( array_sum( $PeriodsOfRefuel ) / count( $PeriodsOfRefuel ) , 0 );
        $obj->AvgEventConsumntion = round( array_sum( $AllFuelQuantity ) / array_sum( $SumDistance ) * 100, 2 );
        $obj->AvgPricePerDistance = round( array_sum( $AllTotalPrices ) / array_sum( $SumDistance ), 2 );
        $obj->AllStationNames = $AllStationNames;
        $obj->AllStationProducts =  $AllStationProducts;
        $obj->AllDrivingType = $AllDrivingType;
        if ( isset( $_POST[ "gas_station_product_id" ] ) && ( $_POST[ "gas_station_product_id" ] ) != "" ) {
            $TEMP = explode("-", $_POST[ "gas_station_product_id" ]);
            $FilterStationId = $TEMP[0];
            $FilterStationProductId = $TEMP[1];
            unset($TEMP);
            $FilterStationProductName = $AllStationProducts[ $FilterStationId ][ $FilterStationProductId ];
            $ProcessingData = array_filter( $ProcessingData, function( $obj ) use ( $FilterStationProductName ) {
                return $obj->gas_station_product == $FilterStationProductName;
            });
        }
        if ( ( isset( $_POST[ "gas_station_id" ] ) && ( $_POST[ "gas_station_id" ] ) != "" ) || isset( $FilterStationId ) ) {
            $FilterStationName = isset( $FilterStationId ) ? $AllStationNames[ $FilterStationId ] : $AllStationNames[ $_POST[ "gas_station_id" ] ];
            $ProcessingData = array_filter( $ProcessingData, function( $obj ) use ( $FilterStationName ) {
                return $obj->gas_station_name == $FilterStationName;
            });
        }
        
        // if ( isset( $_POST[ "driving_type" ] ) && ( $_POST[ "driving_type" ] != "na" ) ) {
        //     $FilterDrivingType = $_POST[ "driving_type" ];
        //     $ProcessingData = array_filter( $ProcessingData, function( $obj ) use ( $FilterDrivingType ) {
        //         return $obj->driving_type == $FilterDrivingType;
        //     });
        // }
        
        if ( !empty( $ProcessingData ) ) {
            $FilterDistance = array();
            $FilterFuelQuantity = array();
            $FilterTotalPrices = array();
            $FilterFuelConsumption = array();
            $FilterPricePerDistance = array();
            foreach ( $ProcessingData as $Event ) {
                array_push( $FilterDistance, $Event->distance );
                array_push( $FilterFuelQuantity, $Event->fuel_quantity );
                array_push( $FilterTotalPrices, $Event->total_price );
                $EventConsumption = ( $Event->fuel_quantity / $Event->distance ) * 100;
                array_push( $FilterFuelConsumption, $EventConsumption );
                $EventPricePerDistance = ( $Event->total_price / $Event->distance );
                array_push( $FilterPricePerDistance, $EventPricePerDistance );
            }
            $obj->FilterData = "";
            $obj->FilterFuelConsumption = round( array_sum( $FilterFuelQuantity ) / array_sum( $FilterDistance ) * 100, 2 );
            $obj->FilterPricePerDistance = round( array_sum( $FilterTotalPrices ) / array_sum( $FilterDistance ), 2 );
            $obj->FilterLowestFuelConsumption =  round( min( $FilterFuelConsumption ), 2 );
            $obj->FilterLowestPricePerDistance = round( min( $FilterPricePerDistance ), 2 );
        } else {
            $obj->FilterData = "Няма информация по зададените критерии.";
        }
        return $obj;
    }

    public function dataView( $DATA ){
        $result = "<h2>Справка за последен период на зареждане</h2>";
            $result .= "<table><tr>
            <td><b>Изминато разстояние</b></td>
            <td>" . $DATA->LastDistance . " километра</td>
            </tr>
            <td><b>Разход на гориво</b></td>
            <td>" . $DATA->LastEventConsumntion . " литра / 100 километра</td>
            </tr>
            <tr>
            <td><b>Цена за разстояние</b></td>
            <td>" . $DATA->LastPricePerDistance . " лева / километър</td>
            </tr>
            </table>";
            $result .= "<hr>
            <h2>Справка средни стойности</h2>
            <table>
            <tr>
                <td>Среден брой зареждания в месец</td>
                <td>" . $DATA->AvgCharging . " броя</td>
            </tr>
            <tr>
                <td>Средна цена на месец</td>
                <td>" . $DATA->AvgSumAmount . " лева</td>
            </tr>
            <tr>
                <td>Средно количество гориво на месец</td>
                <td>" . $DATA->AvgSumFuel . " литра</td>
            </tr>
            <tr>
                <td>Среден период на зареждане</td>
                <td>" . $DATA->AvgPeriodCharging . " дни</td>
            </tr>
            <tr>
                <td>Среден разход на гориво</td>
                <td>" . $DATA->AvgEventConsumntion . " литра / 100 километра</td>
            </tr>
            <tr>
                <td>Средна цена на разстояние</td>
                <td>" . $DATA->AvgPricePerDistance . " лева / километър</td>
            </tr>
            </table>";
            $result .="<hr/><section id=\"report-best-option\">
            <h2>Справка най-добра опция</h2>
            <form method=\"POST\">
            <table><tr><td><select name=\"gas_station_id\">
            <option value=\"\">Без значение бензиностанция</option>"; 
            if ( isset( $_POST[ "gas_station_product_id" ] ) && $_POST[ "gas_station_product_id" ] != "" ) {
                $TEMP = explode("-", $_POST[ "gas_station_product_id" ]);
                $StationIdPassed = $TEMP[0];
                unset($TEMP);
            } else {
                $StationIdPassed = "";
            }
            foreach($DATA->AllStationNames as $Key => $Val){
                $result .= "\n<option value='$Key'";
                if ( isset( $_POST[ "gas_station_id" ] ) || $StationIdPassed != "" ) {
                    if ( $_POST[ "gas_station_id" ] == $Key || $StationIdPassed == $Key) {
                        $result .= " selected";
                    }
                }
                
                $result .= ">$Val</option>";
            }
            
            $result .= "</select>";
            $result .= "</td>
            <td><select name=\"gas_station_product_id\">
            <option value=\"\">Без значение марка гориво</option>";
            if ( ( isset( $_POST[ "gas_station_id" ] ) &&  $_POST[ "gas_station_id" ] != "" ) || $StationIdPassed != "" ) {
                $StationIdProcessing = ( $StationIdPassed != "" ) ? $StationIdPassed : $_POST[ "gas_station_id" ];
                $result .= "\n<optgroup label='" . $DATA->AllStationNames[ $StationIdProcessing ] . "'>";
                    foreach ( $DATA->AllStationProducts[ $StationIdProcessing ] as $ProductKey => $ProductName ) {
                        $result .= "\n<option value='$StationIdProcessing-$ProductKey'";
                        if ( isset( $_POST[ "gas_station_product_id" ] ) && $_POST[ "gas_station_product_id" ] == $StationIdProcessing."-".$ProductKey ) {
                            $result .= " selected";
                        }
                        $result .= ">$ProductName</option>";
                    }
                    $result .= "</optgroup>";
            } else {
                foreach($DATA->AllStationProducts as $StationId => $Product){
                    $result .= "\n<optgroup label='".$DATA->AllStationNames[$StationId]."'>";
                    foreach ( $Product as $ProductKey => $ProductName ) {
                        $result .= "\n<option value='$StationId-$ProductKey'>$ProductName</option>";
                    }
                    $result .= "</optgroup>";
                }
            }
            $result .= "</select></td>\n";
            $result .= "<td><select name=\"driving_type\">";
            foreach($DATA->AllDrivingType as $key => $val){
                $result .= "\n<option value='$val'";
                if ( isset( $_POST[ "driving_type" ] ) ) {
                    $result .= ( $val == $_POST[ "driving_type" ] ) ? " selected" : null;
                } else {
                    $result .= ( $val=="na" ) ? " selected" : null;
                }
                $result .= ">".$this->driving_type[$val]."</option>";
            }
            $result .= "</select></td>
            <td><input type=\"submit\" value=\"Преизчисли\" name=\"submit\"></td></tr></table></form><br/>";
            if ( $DATA->FilterData == "" ) {
            $result .= "<table>
            <tr>
			<td>Среден разход на гориво</td>
			<td>$DATA->FilterFuelConsumption литра / 100 километра</th>
            </tr>
            <tr>
			<td>Средна цена за разстояние</td>
			<td>$DATA->FilterPricePerDistance лева/километър</td>
            </tr>
            <tr>
			<td>Най-нисък разход на гориво</td>
			<td>$DATA->FilterLowestFuelConsumption литри/100 километра</td>
            </tr>
            <tr>
			<td>Най-ниска цена за разстояние</td>
			<td>$DATA->FilterLowestPricePerDistance лева/километър</td>
            </tr>
            </table></section>";
            } else {
                $result .= $DATA->FilterData;
            }
        return $result;
    }

    public function loadingReport(){
            $output = $this->dataModel();
            return $this->dataView($output);
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
<center>
<section id="menu">
<a href="?action=loadData">Зареждане</a> | <a href="?action=loadingReport">Справка</a>
</section>
<hr/>
$Content
</center>
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