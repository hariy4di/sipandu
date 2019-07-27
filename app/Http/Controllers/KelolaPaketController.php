<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Jenssegers\Date\Date;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Console\Logger\ConsoleLogger;

class KelolaPaketController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "ket_paket";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "paket";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"ID Paket","name"=>"id"];
			$this->col[] = ["label"=>"Paket","name"=>"ket_paket"];
			$this->col[] = ["label"=>"Tanggal Terima","name"=>"wkt_terima"];
			$this->col[] = ["label"=>"Petugas Penerima","name"=>"idUser_petugas_terima","join"=>"users,name"];
			$this->col[] = ["label"=>"Pegawai Tujuan","name"=>"idUser_pegawai_terima","join"=>"users,name"];
			//$this->col[] = ["label"=>"Unit Tujuan","name"=>"idUser_pegawai_terima","join"=>"unit,direktorat"];
			$this->col[] = ["label"=>"Tanggal Penyerahan","name"=>"wkt_serah"];
			$this->col[] = ["label"=>"Petugas Penyerahan","name"=>"idUser_petugas_serah","join"=>"users,name"];
			$this->col[] = ["label"=>"Diterima oleh","name"=>"idUser_pegawai_serah","join"=>"users,name"];
			//$this->col[] = ["label"=>"Unit Penerima","name"=>"idUser_pegawai_serah","join"=>"unit,direktorat"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Paket','name'=>'ket_paket','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Terima','name'=>'wkt_terima','type'=>'date','validation'=>'required','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Petugas Penerima','name'=>'idUser_petugas_terima','type'=>'hidden','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Pegawai Tujuan','name'=>'idUser_pegawai_terima','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Penyerahan','name'=>'wkt_serah','type'=>'date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Petugas Penyerahan','name'=>'idUser_petugas_serah','type'=>'hidden','validation'=>'integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Diterima oleh','name'=>'idUser_pegawai_serah','type'=>'select','validation'=>'integer|min:0','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Paket','name'=>'ket_paket','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Tanggal Terima','name'=>'wkt_terima','type'=>'date','validation'=>'required','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Petugas Penerima','name'=>'idUser_petugas_terima','type'=>'hidden','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Pegawai Tujuan','name'=>'idUser_pegawai_terima','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Tanggal Penyerahan','name'=>'wkt_serah','type'=>'date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Petugas Penyerahan','name'=>'idUser_petugas_serah','type'=>'hidden','validation'=>'integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Diterima oleh','name'=>'idUser_pegawai_serah','type'=>'select','validation'=>'integer|min:0','width'=>'col-sm-10'];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
		}
		public function getIndex() {
			//First, Add an auth
			 if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
			 
			 //Create your own query 
			 $data = [];
			 $data['page_title'] = 'Kelola Paket';
			 $data['result'] = DB::table('paket')->orderby('id','desc')->paginate(20);
			  
			 //Create a view. Please use `cbView` method instead of view method from laravel.
			 $this->cbView('kelolaPaket',$data);
		  }

		public function getAdd(){
			if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {    
				CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
			  }
			  
			  $data = [];
			$data['page_title'] = "Terima Paket";
			$data['idUser_pegawai_terima'] = DB::table('users')
					  ->leftjoin('unit','users.idunit','=','unit.id')
					  ->select('users.id','users.name','users.no_hp','unit.direktorat')
					  ->where('id_cms_privileges',2)
					  ->get();
			$this->cbView('terimaPaket',$data);
		}

		public function getEdit($id){
			//Create an Auth
  			if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {    
    			CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
 			 }		
			  $data = [];
			$data['page_title'] = "Serah Paket";
			$data['row']        = DB::table('paket')->where('id',$id)->first();
			$data['idUser_pegawai_serah'] = DB::table('users')
					  ->leftjoin('unit','users.idunit','=','unit.id')
					  ->select('users.id','users.name','users.no_hp','unit.direktorat')
					  ->where('id_cms_privileges',2)
					  ->get();
			$this->cbView('serahPaket',$data);
		}

		public function getDetail($id){
			//Create an Auth
			if(!CRUDBooster::isView() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {    
    			CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
 			 }		
			  $data = [];
			$data['page_title'] = "Kelola Paket";
			$data['row']        = DB::table('paket')->where('id',$id)->first();		
			$this->cbView('detilPaket',$data);
		}

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        $config['content'] = "Ada sebuah paket untuk Anda dengan ID: $id";
			$config['to'] = CRUDBooster::adminPath('paketku');
			$config['id_cms_users'] = [DB::table('paket')->where('id',$id)->value('idUser_pegawai_terima')]; //The Id of the user that is going to receive notification. This could be an array of id users [1,2,3,4,5]
			CRUDBooster::sendNotification($config);

			$data= DB::table('paket')
						->join('users','paket.idUser_pegawai_terima','=','users.id')
						->join('unit','users.idunit','=','unit.id')
						->select('paket.id as id','paket.ket_paket as ket_paket','users.id as idUser','unit.id as unitId','users.name as name','unit.direktorat as direktorat','users.email as email')
						->where('paket.id',$id)
						->first();

				CRUDBooster::sendEmail(['to'=>$data->email,'data'=>$data,'template'=>'paket-baru','attachments'=>[]]);
				//dd($datas);

			
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
			//Your code here

	    }



	    //By the way, you can still create your own method in here... :) 


	}