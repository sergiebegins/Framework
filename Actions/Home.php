<?php
require_once '../public/System/DBase.php';
class Home extends Base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($params)
    {
        $caller =  Caller::Add(DB);
        $mysql = Caller::get('DB');

        
        $cariCek=$mysql->query("select cariler.cari_ad,cariler.cari_soyad,cariler.cari_telefon,cariler.cari_eposta from cariler where  cariler.cari_no=2 limit 1")->fetch(PDO::FETCH_ASSOC);  
        
  
     
         // phpinfo();
        $this->smarty->assign('cari', $cariCek);
       $this->smarty->display('../public/View/child.html');
      

    }


}