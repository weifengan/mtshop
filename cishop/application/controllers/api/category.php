<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		 echo 'category api';
	}


  public function GetAll(){
     $catelist=$this->db->query("select * from category where cat_pid=0 order by 'desc'")->result();
     foreach($catelist as $k=>$v){
          $subs=$this->db->query("select * from category where cat_pid=".$v->id." order by 'desc'")->result();
          $v->children=$subs;
          if(count($subs)>0){
                $v->ishaveChild=TRUE;
            }else{
              $v->ishaveChild=FALSE;
          }

     }
    echo json_encode($catelist,JSON_UNESCAPED_UNICODE);
  }
}
