<html>
<body>
<?php
class Radio {
    private $volume = 50;
    private $station = "FM 100.5";
  
    public function volume_up() {
      $this->volume += 10;
      return $this;
    }
  
    public function volume_down() {
      $this->volume -= 10;
      return $this;
    }
  
    public function tune($station) {
      $this->station = $station;
      return $this;
    }
  
    public function get_volume() {
      return $this->volume;
    }
  
    public function get_station() {
      return $this->station;
    }
  }
  
  class Car {
    private $radio;
  
    public function set_radio(Radio $radio) {
      $this->radio = $radio;
      return $this;
    }
  
    public function radio_volume_up() {
      $this->radio->volume_up();
      return $this;
    }
  
    public function radio_volume_down() {
      $this->radio->volume_down();
      return $this;
    }
  
    public function radio_tune($station) {
      $this->radio->tune($station);
      return $this;
    }
  
    public function get_radio_volume() {
      return $this->radio->get_volume();
    }
  
    public function get_radio_station() {
      return $this->radio->get_station();
    }
  }
  $car = new Car();
  $radio = new Radio();
  $car->set_radio($radio)->radio_tune("FM 98.9")->radio_volume_up()->radio_volume_up();
  echo "Volume: " . $car->get_radio_volume() . "<br>";
  echo "Station: " . $car->get_radio_station();
?>
</body>
</html>