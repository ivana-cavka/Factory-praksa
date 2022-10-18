<?php 
require "C:\\xampp\\carbon\\vendor\\autoload.php";
use Carbon\Carbon;

trait Timestamp  {

    public function save() {
        $this->created_at = $this->updated_at = Carbon::now('Europe/Zagreb');
        $this->save();
    }

    public function update() {
        $this->updated_at = Carbon::now('Europe/Zagreb');
        $this->update();
    }
    
    public function delete() {
        $this->deleted_at = Carbon::now('Europe/Zagreb');
        $this->update();
    }

    public function isDeleted() {
        return $this->deleted_at == null;
    }
}