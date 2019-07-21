<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDbooster;

class AdminCmsUsersController extends \crocodicstudio\crudbooster\controllers\CBController {


	public function cbInit() {
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table               = 'users';
		$this->primary_key         = 'id';
		$this->title_field         = "name";
		$this->button_action_style = 'button_icon';	
		$this->button_import 	   = TRUE;	
		$this->button_export 	   = FALSE;	
		# END CONFIGURATION DO NOT REMOVE THIS LINE
	
		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = array();
		$this->col[] = array("label"=>"NIP","name"=>"nip");
		$this->col[] = array("label"=>"Nama","name"=>"name");
		$this->col[] = array("label"=>"Username","name"=>"username");
		$this->col[] = array("label"=>"Email","name"=>"email");
		$this->col[] = array("label"=>"No. HP","name"=>"no_hp");
		$this->col[] = array("label"=>"Unit","name"=>"idunit","join"=>"unit,direktorat");
		$this->col[] = array("label"=>"Role","name"=>"id_cms_privileges","join"=>"cms_privileges,name");
		$this->col[] = array("label"=>"Foto","name"=>"photo","image"=>1);		
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = array();
		$this->form[] = array("label"=>"NIP","name"=>"nip",'validation'=>'nullable|regex:/^[0-9]+$/i');
		$this->form[] = array("label"=>"Nama","name"=>"name",'required'=>true,'validation'=>'required|alpha_spaces|min:3');
		$this->form[] = array("label"=>"Username","name"=>"username",'required'=>true,'validation'=>'required|alpha_dash|unique:users,username,'.CRUDBooster::getCurrentId());		
		$this->form[] = array("label"=>"Email","name"=>"email",'required'=>true,'type'=>'email','validation'=>'required|email|unique:users,email,'.CRUDBooster::getCurrentId());
		$this->form[] = array("label"=>"No. HP (Whatsapp)","name"=>"no_hp",'validation'=>'alpha_num|regex:/^[0-9]+$/i|min:11|max:15');
		$this->form[] = array("label"=>"Unit","name"=>"idunit","type"=>"select","datatable"=>"unit,direktorat",'nullable'=>true);
		$this->form[] = array("label"=>"Role","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name",'required'=>true);						
		$this->form[] = array("label"=>"Foto","name"=>"photo","type"=>"upload","help"=>"Resolusi yang dianjurkan 200x200px",'validation'=>'image|max:1000','resize_width'=>90,'resize_height'=>90);											
		// $this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Please leave empty if not change");
		$this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Biarkan kosong jika tak berubah");
		$this->form[] = array("label"=>"Konfirmasi Password","name"=>"password_confirmation","type"=>"password","help"=>"Biarkan kosong jika tak berubah");
		# END FORM DO NOT REMOVE THIS LINE
				
	}

	public function getProfile() {			

		$this->button_addmore = FALSE;
		$this->button_cancel  = FALSE;
		$this->button_show    = FALSE;			
		$this->button_add     = FALSE;
		$this->button_delete  = FALSE;	
		$this->hide_form 	  = ['id_cms_privileges'];

		$data['page_title'] = trans("crudbooster.label_button_profile");
		$data['row']        = CRUDBooster::first('users',CRUDBooster::myId());		
		$this->cbView('crudbooster::default.form',$data);				
	}
	public function hook_before_edit(&$postdata,$id) { 
		unset($postdata['password_confirmation']);
	}
	public function hook_before_add(&$postdata) {      
	    unset($postdata['password_confirmation']);
	}
}
