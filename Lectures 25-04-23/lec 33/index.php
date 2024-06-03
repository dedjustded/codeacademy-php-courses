<?php
class parentclass {
    public function test1(){
        echo "test1";
    }
}
interface parentinterface {
    public function test2();
}
$obj = new class() extends parentclass implements parentinterface {
    public function test2(){
        echo "test 2";
    }
};
$obj->test1();
$obj->test2();
?>
