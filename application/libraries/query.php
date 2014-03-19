<?php/* #  INITIALIZE  : INCLUDE FILE IN YOUR CLASSES OR LIBRARIES FOLDER AND FILL IN THE CONNECTION DETAILS AND YOU'RE GOOD TO GO (PDO CONNECTION).  #                AS AN EXTENSION FOR CODEIGNITER, PLACE THE FILE ON THE [LIBRARIES] DIRECTORY.  #  USAGE       : CREATE AND INSTANCE OF THE CLASS AND PASS THE FOLLOWING ATTRIBUTES IN AN ARRAY                   THE FOLLOWING ARE THE ACCEPTED KEYS FOR INITIALIZATION: _______________________________________________________________________________________________________________________________________'TABLE' = String. The Table name. also accepts an alias after table nameExample: 'TABLE'=>'person'        | will point to person table'TABLE'=>'employee emp'  | will point to employee table with emp as an alias_______________________________________________________________________________________________________________________________________'COLS'  = Array or String. The columns to be fetched. To CONCAT 2 or more columns, specify an asscociative array that will become the alias. ***You can also fetch the columns and do a formatting (see the MySQL )documentation for formatting 					Example: 							  'COLS'=>'first_name'                                        | will return | SELECT first_name ...'COLS'=>'first_name,last_name'                              | will return | SELECT first_name, last_name ...'COLS'=>array('fist_name','last_name')                      | will return | SELECT first_name, last_name ...'COLS'=>array('name'=>'first_name,last_name')               | will return | SELECT CONCAT(first_name,last_name) AS name ...'COLS'=>array('date'=>'DATE_FORMAT(date_added,"%M %d %Y")') | will return  a formatted date _______________________________________________________________________________________________________________________________________ 'JOIN' = Array. The JOIN clause. Array keys :                                                     'TABLE' : String. The table name to be passed. Set 'TABLE'=>'Person p' to specify 'p' as alias for table    'TYPE'  : String. (Optional, INNER by default). The type of join 'INNER','LEFT','RIGHT','FULL'    'ON'    : String. The ON clause for Join.                                                                    Example: 'JOIN'=>array('TABLE'=>'task t','ON'=>'t.id = p.id')'JOIN'=>array('TABLE'=>'tak t','TYPE'=>'LEFT','ON'=>'t.id = p.id')_______________________________________________________________________________________________________________________________________				 'KEY'  =Array or 1. The identifiers to be used on the query. Multiple condition is set with mulitple keys.         *** To fetch all the records on the table without an identifier set KEY to 1 							 Example: 							  'KEY'=>1                                        | will return | WHERE 1'KEY'=>array('user_id'=>1)                      | will return | WHERE user_id = :user_id 'KEY'=>array('name'=>'elizar','gender'=>'male') | will return | WHERE name=:name AND gender=:gender  								  * Notice that the values are not binded right away to take advantage of PDO's BIND capabilites. The values are later on binded upon execute when the values are fetched._______________________________________________________________________________________________________________________________________'SUB_KEY' = String. Specifies an additional SUB CLAUSE to the KEY CLAUSE _______________________________________________________________________________________________________________________________________'GROUP' = String. The GROUP BY ClauseExample:'GROUP'=>'name' | will return | GROUP BY name'GROUP'=>'person.name' | will return | GROUP BY person.name'GROUP'=>'CONCAT(date,time)' | will return | GROUP BY CONCAT(date,time)    _______________________________________________________________________________________________________________________________________ 					  'DESC' = Array or string. The 'ORDER BY' of the fetch in descending order. specify an array or string for CONCAT.					  Example: 							   'DESC'=>'user_id'          | will produce | ORDER BY user_id DESC...'DESC'=>'date,time'        | will produce | ORDER BY CONCAT(date,time)...'DESC'=>array('date,time') | will produce | ORDER BY CONCAT(date,time)..._______________________________________________________________________________________________________________________________________									'ASC'   = Array or string. The 'ORDER BY' of the fetch in ascneding order. Works the same as the 'DESC' declaration_______________________________________________________________________________________________________________________________________					  'LIMIT' =String. Creates the LIMIT of the query.  Pass a string value Example: 							   'LIMIT'=>'10'   | will produce | LIMIT 10'LIMIT'=>'0,10' | will produce | LIMIT 0,10    				_______________________________________________________________________________________________________________________________________ 'FORMAT' = Array. Passes a formatting function to be applied to the result of the query call. The index must correspond to the columns of the table.           Pass a < $value > variable as the replacement for the column variable to be processed.            The function call will be passed as a string in quotes ['']Example: 'FORMAT'=>array('date_added'=>'date("M-d-Y, strtotime($value)")') | will format the date_added fetched result        'FORMAT'=>array('name'=>'strtolower($value)') | will format the name with strtolower function_______________________________________________________________________________________________________________________________________ 					  									      				 #  LIMITATION : THE CLASS IS STILL DEPENDENT ON THE CORRECTNESS OF THE USER INPUT (MUCH LIKE IN PREPARING A QUERY)                MAKE SURE THAT THE VARIABLES THAT ARE USED, PARAMETERS AND NAMES THAT ARE PASSED CORRESPONDS TO YOUR TABLE.				 */####CONNECTION DETAILS: INITIAL DATABASE CONFIGURATION ######################################################################################## defined('DB_SERVER') ? null : define("DB_SERVER", "localhost"); defined('DB_USER')   ? null : define("DB_USER"  , "internal_root"); defined('DB_PASS')   ? null : define("DB_PASS"  , "igeA8p3N"); defined('DB_NAME')   ? null : define("DB_NAME"  , "internal_interfacetree");###############################################################################################################################################class QUERY{		# DATABASE REQUIRED VARIABLES	private $dbh;		private static $instance;	    private $_conn; 		# THIS WILL BE THE FETCHED TABLE'S MAIN COLUMNS. IT CAN BE SET DYNAMICALLY WHEN AN INSTANCE IS CREATED	private $_columns = array();   		# RESULT OF THE FETCH 	protected $_result = array(); 		# TABLE NAME	private $_table;                # JOIN CLAUSE        private $_join;        # QUERY KEYS 	private $_key;		# QUERY COLUMNS TO RETURN	private $_cols;                # QUERY GROUP BY        private $_group;        # QUERY ORDERS	private $_desc;	private $_asc;		# QUERY LIMIT	private $_limit;		# STRING AND KEY MODIFIER	private $_modifier = '37124RF70R35';    	# SUB CLAUSE 	private $_sub;		# FORMAT COLUMN HOLDER	private $_format;	 	# QUERY STRING HOLDER	private $_query_string = false;     public function __construct($assets = array())	 {		 		 #  CREATE THE CONNECTION TO THE DATABASE 		 $this->_conn = $this->dbh = new PDO('mysql:host=' . DB_SERVER . ';dbname='. DB_NAME, DB_USER, DB_PASS);		 $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		 		 if(!empty($assets)){		  $this->_table  = array_key_exists('TABLE' ,$assets)   ? $assets['TABLE']   : false; # VALUE                  $this->_join   = array_key_exists('JOIN', $assets)    ? $assets['JOIN']    : false; # MULTI DIMENSIONAL ARRAY  		  $this->_cols   = array_key_exists('COLS'  ,$assets)   ? $assets['COLS']    : false; # CAN BE AN ARRAY OR A VALUE		  $this->_key    = array_key_exists('KEY'   ,$assets)   ? $assets['KEY']     : false; # ARRAY		  $this->_sub    = array_key_exists('SUB_KEY' ,$assets) ? $assets['SUB_KEY'] : false; # STRING                  $this->_group  = array_key_exists('GROUP' ,$assets)   ? $assets['GROUP']   : false; # STRING		  $this->_desc   = array_key_exists('DESC', $assets)    ? $assets['DESC']    : false; # CAN BE AN ARRAY OR A VALUE		  $this->_asc    = array_key_exists('ASC', $assets)     ? $assets['ASC']     : false; # CAN BE AN ARRAY OR A VALUE		  $this->_limit  = array_key_exists('LIMIT', $assets)   ? $assets['LIMIT']   : false; # VALUE		  $this->_format = array_key_exists('FORMAT', $assets)  ? $assets['FORMAT']  : false; # VALUE		  		   				  if($this->_table && ($this->_key || $this->_join))		   {		     $this->PROCESS_TABLE();		   } 		  else		   {			 $this->SET_COLUMNS();   		   }			   		 }	 }                          # FUNCTION NAME: PROCESS_JOIN_CLAUSE        # PARAM        : array to be processed        # DESCRIPTION  : THIS FUNCTION WILL PROCESS THE JOIN ARRAY         private function PROCESS_JOIN_CLAUSE($arrs = array()){             $join_type  = isset($arrs['TYPE']) ? $arrs['TYPE'] . ' JOIN ' : ' INNER JOIN ';             $join_table = $arrs['TABLE'];             $join_on    = $arrs['ON'];                          $str        = ' '.$join_type .  $join_table .' ON '. $join_on;             return $str;         }                 private function PROCESS_GROUP_BY_CLAUSE($clause){            $str = ' GROUP BY ' . $clause . ' ';            return $str;        } 	 	#FUNCTION NAME: PROCESS_COLUMNS_ARRAY	# PARAM       : array to be processed	# DESCRIPTION : THIS FUNCTION WILL PROCESS THE ARRAY AND CONVERT IT TO A STRING	#               TYPE OF POSSIBLE ARRAY PARAMS: 	#               REGULAR PARAM: array('ID','Name','Gender')                       	#               DYNAMIC PARAM FOR (CONCAT AS) KEYWORD : array('ID','Name'=>'FirstName,LastName','Gender') 	private function PROCESS_COLUMNS_ARRAY($arrs = array())	{         $str = '';        foreach($arrs as $key => $arr){                 $str .= !is_numeric($key) ? 'CONCAT('.$arr.') AS ' . $key . ',' : $arr .',';            } 	               return rtrim($str,',');	}		#FUNCTION NAME: PROCESS_KEYS_ARRAY	# PARAM       : array to be processed	# DESCRIPTION : THIS FUNCTION WILL PROCESS THE ARRAY AND CONVERT IT TO A STRING	#               TYPE OF POSSIBLE ARRAY PARAMS: 	#               REGULAR PARAM: array('ID','Name','Gender')                       	#               DYNAMIC PARAM FOR (CONCAT AS) KEYWORD : array('ID','Name'=>'FirstName,LastName','Gender') 	private function PROCESS_KEYS_ARRAY($arrs = array())	{      $str = ' WHERE ';	 	 if(!is_array($arrs) && $arrs){		    $str .= '1'; 		 }     else{			 foreach($arrs as $key => $arr){				  $str .= $key .' = :' . $key . ' AND ';			 } 	 	 }	 return rtrim($str,'AND ');	}		#FUNCTION NAME: PROCESS_ORDER_ARRAY	# PARAM       : array to be processed	# DESCRIPTION : THIS FUNCTION WILL PROCESS THE ARRAY AND CONVERT IT TO A STRING	#               TYPE OF POSSIBLE ARRAY PARAMS: 	private function PROCESS_ORDER_ARRAY()	{		$str = ' ORDER BY ';		if($this->_asc)		{			$this->_asc = is_array($this->_asc) ? $this->_asc : explode(',', $this->_asc); 						 foreach($this->_asc as $key => $arr){    	       $str .= !is_numeric($key) ? ' CONCAT(' . $arr . ') ASC' : $arr . ' ASC';  			 }		}		else if($this->_desc)		{			$this->_desc = is_array($this->_desc) ? $this->_desc : explode(',', $this->_desc);					  	foreach($this->_desc as $key => $arr){    	       $str .= !is_numeric($key) ? ' CONCAT(' . $arr . ') DESC' : $arr . ' DESC';  			 }		}		return $str;	}		#FUNCTION NAME: PROCESS_LIMIT_CLAUSE	# PARAM       : NONE	# DESCRIPTION : THIS FUNCTION WILL PROCESS THE LIMIT CLAUSE BASED ON THE VALUE PASSED BY THE USER 	#               PARAM: 'LIMIT'=>'0,10' | 'LIMIT'=>'10'                       	private function PROCESS_LIMIT_CLAUSE()	{		$str=' LIMIT ';		$str .= $this->_limit ? $this->_limit : ''; 		return $str; 	   		}		# DESCRIPTION : THIS FUNCTION DETECTS IF THE CLASS INSTANCE REQUIRES A SPECIFIC SET[S] OF COLUMN[S] IN THE TABLE AND LOADS THEM AUTOMATICALLY	#               FIRST IF{} BLOCK FETCHES SPECIFIC COLUMN[S] ELSE{} BLOCK SETS ALL COLUMN[S]	private function SET_COLUMNS()	{	 $this->_cols = is_array($this->_cols) ? $this->_cols : ($this->_cols ? explode(',',$this->_cols) : false); 	  		 if($this->_cols){ 	    foreach($this->_cols as $key => $col){		   $this->_columns[trim($key)] = trim($col);			}	  }	  else{                 $prepared = $this->_conn->prepare("SHOW COLUMNS FROM " . $this->_table);		                 $prepared->execute();		while($row = $prepared->fetch())                {                    $this->_columns[$row['Field']] = '';                }	  }	}   # DESCRIPTION : FETCHES THE TABLE COLUMNS BASED ON THE DEFAULT PARAMETERS PASSED TO THE INITIAL CLASS INSTANCE   private function PROCESS_TABLE()   {	  # SET THE COLUMNS 	  $this->SET_COLUMNS();	   	  # PROCESS THE CLAUSES --------------------------------------------------------------------------------          $join    = $this->_join                          ? $this->PROCESS_JOIN_CLAUSE($this->_join)     :'';  # JOIN CLAUSE           $columns = $this->_cols                          ? $this->PROCESS_COLUMNS_ARRAY($this->_columns):'*'; # COLUMNS CLAUSE          $keys    = $this->_key                           ? $this->PROCESS_KEYS_ARRAY($this->_key)       :'';  # KEY CLAUSE           $sub     = $this->_sub && is_string($this->_sub) ? ' ' . $this->_sub . ' '                      :'';  # SUB_KEY ONLY IF KEY IS DEFINED	  $group   = $this->_group                         ? $this->PROCESS_GROUP_BY_CLAUSE($this->_group):'';  # GROUP CLAUSE          $order   = ($this->_asc || $this->_desc)         ? $this->PROCESS_ORDER_ARRAY()                 :'';  # ORDER CLAUSE 	  $limit   = $this->_limit                         ? $this->PROCESS_LIMIT_CLAUSE()                :'';  # LIMIT CLAUSE	            	  # SET THE QUERY ---------------------------------------------------------------------------------------	  $query    = 'SELECT ' . $columns . ' FROM '.$this->_table . $join . $keys . $sub . $group . $order . $limit;                    //echo $query . '<br />';          	  # ASSIGN QUERY STRING	  $this->_query_string = $query;	  	  # PREPARE THE QUERY	  $prepared = $this->_conn->prepare($query);	  	    	  # EXECUTE THE QUERY AND BIND THE KEY IF THERE IS A KEY PASSED 	  ((!is_array($this->_key) && $this->_key)  || ((!is_array($this->_key) && $this->_key) && $this->_join) || ($this->_join && !(is_array($this->_key) && $this->_key))  ) ? $prepared->execute() : $prepared->execute($this->_key);                # ^ WITHOUT A KEY                           ^ WITHOUT A KEY BUT WITH JOIN                                   ^ WITH JOIN AND WITH KEY 	          # FETCH ALL RESULTS 	  $result   =  $prepared->fetchAll(PDO::FETCH_ASSOC); 	           	  foreach($result as $key => $values){		  foreach($values as $keyVal => $value)		  {                     # FORMAT THE COLUMNS IF FORMATTING IS SPECIFIED                      if(is_array($this->_format) && in_array($keyVal,array_keys($this->_format))){                             $value = eval('return(' . $this->_format[$keyVal] .  ');');                     }                     		     $this->_result[$key][$keyVal] = trim($value); 		  }	  } 	 return $result;   }      private function PROCESS_DATA_SET($ARRS=array())   {	   $str = '';	   if(!empty($ARRS))	   {		 foreach($ARRS as $key => $arr){			 $str .= str_replace($this->_modifier,'',$key) . '=:'. $key . ',';		 }   	   }	   return rtrim($str,',');   }    			private function INSERT_QUERY($ARRS = array())	{			  $data = $this->PROCESS_DATA_SET($ARRS);		  $query    = 'INSERT INTO ' . $this->_table . ' SET ' . $data; 		  	  # ASSIGN QUERY STRING	  $this->_query_string = $query;	  	  # PREPARE THE QUERY	  $prepared = $this->_conn->prepare($query);     	  $result = $prepared->execute($ARRS);      	  return $result; 	}		private function UPDATE_QUERY($ARRS = array())	{	   	# WE NEED TO ALTER ARRAY TO PREVENT A POTENTIAL DUPLICATE ON THE KEYS AND THE COLUMNS TO BE MODIFIED		$alterARRS = array();		foreach($ARRS as $key => $val){			$alterARRS[$key.$this->_modifier] = $val;		}				# SET THE CLAUSES		$data = $this->PROCESS_DATA_SET($alterARRS);		$keys = $this->_key ? $this->PROCESS_KEYS_ARRAY($this->_key):'';	  	    # MERGE THE VARIABLES	    $bindARRs = array_merge($alterARRS,$this->_key);		    # RUN THE QUERY 	    $query = 'UPDATE ' . $this->_table . ' SET ' . $data . $keys;				# ASSIGN QUERY STRING	  	$this->_query_string = $query;				# PREPARE THE QUERY		$prepared = $this->_conn->prepare($query);				# BIND THE PARAMS 		$result = $prepared->execute($bindARRs);		return $result;	}                private function DELETE_QUERY()        {            $result = false;            $keys = $this->_key ? ( is_array($this->_key) ? $this->PROCESS_KEYS_ARRAY($this->_key) : false )    : false;            if($keys)            {                $query = 'DELETE FROM ' . $this->_table . $keys;                $prepared = $this->_conn->prepare($query);                $result = $prepared->execute($this->_key);								$this->_query_string = $query;            }            return $result;        }		private function RUN_QUERY($clause,$params)	{		$query    = $clause;		$prepared = $this->_conn->prepare($query);		$prepared->execute($params);				return $prepared; 	}#----------------------------------------------------------------------------------------------------------------------------------------##-PUBLIC FUNCTIONS DEFINED  HERE---------------------------------------------------------------------------------------------------------#	#----------------------------------------------------------------------------------------------------------------------------------------#		        public function fetch($key,$place=0){			$result = !empty($this->_result) ? $this->_result[$place][$key] :false; //'NOTICE: NO RESULT(S) FOUND';			return $result;		   }                public function fetchRow($place=0){            $result = !empty($this->_result) ? $this->_result[$place] : false; //'NOTICE:  NO RESULT(S) FOUND';            return $result;        }        public function fetchAll(){		   $result = !empty($this->_result) ? $this->_result : false; //'NOTICE: NO RESULT(S) FOUND';		   return $result;		    }				public function lastId(){		  	return $this->_conn->lastInsertId();       		}			public function save($data=array()){		  $result =  $this->_key && is_array($this->_key) && !empty($this->_result) ?  $this->UPDATE_QUERY($data) : $this->INSERT_QUERY($data);    			  return $result;			}                public function delete(){            $result = $this->DELETE_QUERY();            return $result;        }        public function numRows(){            return count($this->_result);        }                		public function run($clause,$params=array()){			return $this->RUN_QUERY($clause,$params);		}				public function showLastQuery(){			return $this->_query_string ? $this->_query_string : false; 		}}?>