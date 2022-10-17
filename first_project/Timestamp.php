<?php 
require "C:\\xampp\\carbon\\vendor\\autoload.php";
use Carbon\Carbon;

trait Timestamp  {

    public function save() {
        $this->created_at = $this->updated_at = Carbon::now('Europe/Zagreb');
        parent::save();
    }

    public function update() {
        $this->updated_at = Carbon::now('Europe/Zagreb');
        parent::save();
    }
    
    public function delete() {
        $this->delted_at = Carbon::now('Europe/Zagreb');
        parent::update();
    }
}