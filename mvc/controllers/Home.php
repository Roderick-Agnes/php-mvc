<?php

// http://localhost/live/Home/Show/1/2

class Home extends Controller{

    // Must have SayHi()
    function SayHi(){
        $teo = $this->model("SinhVienModel");
        echo $teo->GetSV();

    }

    function Index(){        
        // Call Models
        //$teo = $this->model("SinhVienModel");
        //$tong = $teo->Tong($a, $b); // 3

        // Call Views
        $this->view("layoutRoot", [
            "Header" => "header",
            "Navbar" => "navbar",
            "Footer" => "footer"
        ]);
    }
}
?>