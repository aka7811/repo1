 var trick=  angular.module('ajax_comp', [])
 
 . directive('myPagination', function() {
  return {
      restrict: 'AE',
      replace: 'true',
      templateUrl: '/angular-templates/pagination.tmpl',
      scope: {
      indexer: '='
    	}
  };
})

. directive('myAlert', function() {
  return {
      restrict: 'E',
      replace: 'true',
      templateUrl: '/angular-templates/alert.tmpl',
      scope: {
      message: '@'
    	}
  };
})
. directive('myErrorAlert', function() {
  return {
      restrict: 'E',
      replace: 'true',
      templateUrl: '/angular-templates/alert-error.tmpl',
      scope: {
      message: '@'
    	}
  };
})
. directive('myDeleter', function() {
  return {
      restrict: 'E',
      replace: 'true',
      templateUrl: '/angular-templates/deleter.tmpl',
      scope: {
      indexer: '='
    	}
  };
})
. directive('myIndexPanel', function() {
  return {
      restrict: 'E',
	  transclude:'true',
      replace: 'true',
      templateUrl: '/angular-templates/index-panel.tmpl',
      scope: {
      indexer: '=',
	  options: '&'
	  
    }
  };
})
. directive('myFilterPanel', function() {
  return {
      restrict: 'E',
	  transclude:'true',
      replace: 'true',
      templateUrl: '/angular-templates/filter-panel.tmpl',
      scope: {
      
	  options: '&'
	  
    }
  };
})
. directive('myEditPanel', function() {
  return {
      restrict: 'E',
	  transclude:'true',
      replace: 'true',
      templateUrl: '/angular-templates/edit-panel.tmpl',
      scope: {
      
	  options: '&'
	  
    }
  };
})
. directive('myClearableInput', function() {
  return {
      restrict: 'E',
	  
      replace: 'true',
      templateUrl: '/angular-templates/my-clearable-input.tmpl',
      scope: {
      model: '=',
	  options: '&'
	  
    }
  };
})
. directive('myTopNav', function() {
  return {
      restrict: 'E',
	  transclude:'true',
      replace: 'true',
       templateUrl: '/angular-templates/breadcrumbs.tmpl',
      scope: {options: '&' }
  };
})
. directive('quickNav', function() {
  return {
      restrict: 'E',
	  transclude:'true',
      replace: 'true',
       templateUrl: '/angular-templates/quicknav.tmpl',
      scope: {options: '&' }
  };
})
. directive('optionsPanel', function() {
  return {
      restrict: 'E',
	  transclude:'true',
      replace: 'true',
       templateUrl: '/angular-templates/options-panel.tmpl',
      scope: {options: '&' }
  };
})
  
 .factory("email_checker_comp", ['$http', function($http) {
   

  return function(address) {
    var ret= {
      user_email : "",         
      ajaxon : false
      
    };
    ret.submit = function(email_to_check) {
         
        self.ajaxon=true;

          $http.post(address,{user_email:email_to_check}).success(function(data) {
         
          ret.ajaxon=false;
           
          ret.is_user=data["is_user"];
          ret.is_already=data["is_already"];
          ret.is_other_role=data["is_other_role"];
          ret.failure=!data["can_be"];
          if(data["can_be"]===true)
          {
              $("#success-modal").modal('show');
              ret.user_email = ""; 
              ret.the_form.$setPristine();
              
               
          }
         
         });
      };
    ret.hide_failure=function()
   		{
 			ret.failure=false;
   		}

   	ret.setForm = function (form) {
            ret.the_form = form;
	}	
  
  return ret;
  }
}])

 .factory("index_comp", ['$http', function($http) {
   

  return function(address,delete_address) {
    var ret= {items : [],
		    rows : 0,
		    pattern_tmp_md : {},
		    current_pattern : {},
		    ajaxon : false,
		    offset_array:[],
		    delete_candidate:-1
		};
		ret. get_items = function(offset,pattern ) {
			  var self=ret;
			  self.ajaxon=true;

		      $http.post(address,{"offset":offset,"pattern":pattern }).success(function(data) {
		      
			      self.ajaxon=false;
				  self.current_pattern = pattern;
			      self.items = data["result"];
			      self.rows = data["result_count"];
			      var page_links =  Math.ceil(self.rows/4);
			      self.offset_array=[];
			      for(var i=0;i<page_links;i++)
			      {
			      	self.offset_array[i]={};
			      	self.offset_array[i].offset=4*i;
			      	self.offset_array[i].active=4*i==data["offset"];
			      }
			
				 
		     });};

		ret. make_delete_candidate=function(id)
		{
			ret.delete_candidate=id;
		}
		ret. cancel_delete_candidate=function()
		{
			ret.delete_candidate=-1;
		}
		ret. delete_call=function(id)
		{
			 var self=ret;
			 self.ajaxon=true;
			 self.delete_candidate=-1;
		      $http.post(delete_address,{"id":id }).success(function(data) {
		      
			      self.ajaxon=false;
				  self.get_items(0,{});
				  $("#success-modal").modal('show');
					
				 
		     });
		}


	return ret;
  }
}])

.factory("editor_comp", ['$http', function($http) {
   
// diefthinsi pou stelneis edit, diefthnsi piso, passare to scope na grafei kati, formatter
  return function(address,get_back_address,adjust_data) {
    var ret=
        {
        	item : {}
		    
		};
	
	ret.init_editor=function(value) {
		     ret.item.id=value;
             $http.post(get_back_address,{id:value}).success(
             	function(data)
             	{
             		ret.item=data["result"] ;
             		if(adjust_data) adjust_data(ret);
             	});



             	 
			    
			  };
	

	ret. submit = function() {
			$http.post(address,{id:ret.item.id, item:ret.item}).success(
             	function(data)
             	{
             		$("#success-modal").modal('show');
             		$http.post(get_back_address,{id:ret.item.id}).success(
	             	function(data)
	             	{
	             		ret.item=data["result"] ;
	             		if(adjust_data) adjust_data(ret);// self.item.price= parseFloat(self.item.price);
	             	});
             	});
		};
	

	return ret;
  }
}])


.filter('katastasiSintagis', function() {
    return function(input) {
      
      if(input==0||input=="0") return "Energi";
      if(input==1||input=="1") return "Akyromeni";
      if(input==2||input=="2") return "Olokliromeni";
      return input;
    };
  })		 
		 

 ;

 



 var myApp = angular.module('sintages', ['ajax_comp'])
 

 .controller('Sintagi_Create_Controller', ['$scope','$http', function($scope, $http) {
		     var self=this;
		     self.mode="teliko";
		     self.modes=["teliko","diagnoseis","asfalismenoi","farmaka"];
			 
			 self.diagnoseis=[];
			 self.slines=[];
			 self.asfalismenos=undefined;

			 self.add_diagnosi=function(diagnosi)
			 {
			 	self.diagnoseis.push(diagnosi);
			 		self.mode="teliko";
			 }
			 self.add_asfalismenos=function(asfalismenos)
			 {
			 	self.asfalismenos=asfalismenos;
			 	self.mode="teliko";
			 }
			 self.add_sline=function(farmako)
			 {
			 	self.slines.push({farmako:farmako,dosologia:0,amount:0});
			 	self.mode="teliko";
			 }
			 self.sub_sline=function(sline)
			 {
			 	var index= self.slines.indexOf(sline);
			 	if (index > -1) {
 				   self.slines.splice(index, 1);
				}
			 }
			 self.sub_asfalismenos=function()
			 {
			 	self.asfalismenos=undefined;
			 }
     
			 self.sub_diagnosi=function(diagnosi)
			 {
			 	var index= self.diagnoseis.indexOf(diagnosi);
			 	if (index > -1) {
 				   self.diagnoseis.splice(index, 1);
				}
			 }	
			self.total_price = function( ) {
				var total=0;
				for(var i=0;i<self.slines.length;i++)
				{
				total+=self.slines[i].farmako.price*self.slines[i].amount;
				}
				return "Συνολικό Κόστος: "+total;
			}
			 self.apply = function( ) {
			   
			  self.ajaxon=true;
			  //var sent_data=6;
			  var sent_data={diagnoseis:self.diagnoseis,slines:self.slines,asfalismenos:self.asfalismenos };
			  //var sent_data2=angular.toJson(sent_data);
		      $http.post("http://ka77575.eu/index.php/sintages/create_j",sent_data)
			  .success(function(data) {
		      
		      self.ajaxon=false;
		      $("#success-modal").modal('show');
			  self.diagnoseis=[];
			  self.slines=[];
			  self.asfalismenos=undefined;
				
				 
		     })
			 .error(function(data)
			 {
			  $("#error-modal").modal('show');
			 }
			 
			 
			 )
			 
			 
			 ;};


		  } 
		  ])



 .controller('Diagnoseis_Index_Controller', ['$scope','$http','index_comp', function($scope, $http, index_comp) {
		     
		     var self=this;
		 

             self.indexer=index_comp('http://ka77575.eu/index.php/diagnoseis/index_j');

		     

		     
		     

		     self.indexer.get_items (0,{} );



		     
		  
		  } 
		  ])

.controller('Asfalismenoi_Index_Controller', ['$scope','$http','index_comp', function($scope, $http, index_comp) {
		     
		     var self=this;
		 

             self.indexer=index_comp('http://ka77575.eu/index.php/asfalismenoi/index_j');

		     

		     
		     

		     self.indexer.get_items (0,{} );



		     
		  
		  } 
		  ])
.controller('Farmaka_Index_Controller', ['$scope','$http','index_comp', function($scope, $http, index_comp) {
		     
		     var self=this;
		 

             self.indexer=index_comp(
             	'http://ka77575.eu/index.php/farmaka/index_j',
             	'http://ka77575.eu/index.php/farmaka/delete_j'
             	);

		     

		     
		     

		     self.indexer.get_items (0,{} );



		     
		  
		  } 
		  ])
.controller('Farmaka_Index_Available_Controller', ['$scope','$http','index_comp', function($scope, $http, index_comp) {
		     
		     var self=this;
		 

             self.indexer=index_comp(
             	'http://ka77575.eu/index.php/farmaka/index_available_j'
             	 
             	);

		     

		     
		     

		     self.indexer.get_items (0,{} );



		     
		  
		  } 
		  ])


.controller('Farmaka_Edit_Controller', ['$scope','$http','editor_comp', function($scope, $http, editor_comp) {
		     
		     var self=this;
		 

             //
             self.editor=editor_comp(  
             'http://ka77575.eu/index.php/farmaka/edit_j',
             'http://ka77575.eu/index.php/farmaka/item_j',				
              
             function(comp){
             	comp.item.price= parseFloat(comp.item.price);
             }

             );
		 
		     



		     
		  
		  } 
		  ])

.controller('Farmaka_Create_Controller', ['$scope','$http','index_comp', function($scope, $http) {
		     
		     var self=this;
		 

             //
             self.item={name:"",price:0,available:"1"};
		 
		    

			  self.submit=function()
			  {
			  	$http.post('http://ka77575.eu/index.php/farmaka/create_j',{item:self.item}).success(
             	function(data)
             	{
             		$("#success-modal").modal('show');
             		  self.item={name:"",price:0,available:"1"};
             		  self.the_form.$setPristine();
             	});
			  }

			self.set_form = function (form) {
            self.the_form = form;
			}	

		     
		  
		  } 
		  ])

.controller('Giatroi_Index_Controller', ['$scope','$http','index_comp', function($scope, $http, index_comp) {
		     
		     var self=this;
		 

             self.indexer=index_comp('http://ka77575.eu/index.php/giatroi/index_j',
             	'http://ka77575.eu/index.php/giatroi/delete_j');

		     

		     
		     

		     self.indexer.get_items (0,{} );



		     
		  
		  } 
		  ])
.controller('Giatroi_Edit_Controller', ['$scope','$http','editor_comp', function($scope, $http, editor_comp) {
		     
		     var self=this;
		 

             //
             self.editor=editor_comp(  
             'http://ka77575.eu/index.php/giatroi/edit_j',
             'http://ka77575.eu/index.php/giatroi/item_j',				
              
             function(comp){
             	//comp.item.price= parseFloat(comp.item.price);
             }

             );
		 
		     




		     
		  
		  } 
		  ])



.controller('Farmakeia_Index_Controller', ['$scope','$http','index_comp', function($scope, $http, index_comp) {
		     
		     var self=this;
		 

             self.indexer=index_comp('http://ka77575.eu/index.php/farmakeia/index_j',
             	'http://ka77575.eu/index.php/farmakeia/delete_j');

		     

		     
		     

		     self.indexer.get_items (0,{} );



		     
		  
		  } 
		  ])

.controller('Farmakeia_Edit_Controller', ['$scope','$http','editor_comp', function($scope, $http, editor_comp) {
		     
		     var self=this;
		 

             //
             self.editor=editor_comp(  
             'http://ka77575.eu/index.php/farmakeia/edit_j',
             'http://ka77575.eu/index.php/farmakeia/item_j',				
              
             function(comp){
             	//comp.item.price= parseFloat(comp.item.price);
             }

             );
		 
		     




		     
		  
		  } 
		  ])

.controller('Farmakeia_Create_Controller', ['$scope','$http','email_checker_comp', function($scope, $http, email_checker_comp) {
		     
		     var self=this;
		 

             //
             self.checker=email_checker_comp(  
             'http://ka77575.eu/index.php/farmakeia/create_j'
              				
              
             

             );
		  } 
		  ])
.controller('Giatroi_Create_Controller', ['$scope','$http','email_checker_comp', function($scope, $http, email_checker_comp) {
		     
		     var self=this;
		 

             //
             self.checker=email_checker_comp(  
             'http://ka77575.eu/index.php/giatroi/create_j'
              				
              
             

             );
		  } 
		  ])
.controller('Farmakeia_Create_Controller', ['$scope','$http','email_checker_comp', function($scope, $http, email_checker_comp) {
		     
		     var self=this;
		 

             //
             self.checker=email_checker_comp(  
             'http://ka77575.eu/index.php/farmakeia/create_j'
              				
              
             

             );
		  } 
		  ])
 
.controller('Sintages_Of_Giatros_Controller', ['$scope','$http','index_comp', '$filter',function($scope, $http, index_comp, $filter) {
		     
		     var self=this;
		 

             self.indexer=index_comp('http://ka77575.eu/index.php/sintages/giatrou_j');

		     

		     
		     

		     self.indexer.get_items (0,{} );

		     self.lastdays=function(days)
		     {
		     	var now = new Date();
		     	var ten_ago= new Date();
		     	ten_ago.setDate(ten_ago.getDate() - days);
		     	now.setDate(now.getDate() );
		     	
				self.indexer.pattern_tmp_md.date_start=$filter("date")(ten_ago, 'yyyy-MM-dd');
				self.indexer.pattern_tmp_md.date_end=$filter("date")(now, 'yyyy-MM-dd');
		     }

		     
		  
		  } 
		  ])
		  
		  
		  

.controller('Sintages_Of_Farmakeio_Controller', ['$scope','$http','index_comp', '$filter', function($scope, $http, index_comp, $filter) {
		     
		     var self=this;
		 

             self.indexer=index_comp('http://ka77575.eu/index.php/sintages/farmakeiou_j');

		     

		     
		     

		     self.indexer.get_items (0,{} );
			 self.lastdays=function(days)
		     {
		     	var now = new Date();
		     	var ten_ago= new Date();
		     	ten_ago.setDate(ten_ago.getDate() - days);
		     	now.setDate(now.getDate() );
		     	
				self.indexer.pattern_tmp_md.date_start=$filter("date")(ten_ago, 'yyyy-MM-dd');
				self.indexer.pattern_tmp_md.date_end=$filter("date")(now, 'yyyy-MM-dd');
		     }


		     
		  
		  } 
		  ])

.controller('Sintages_Epikyrosi_Chooser_Controller', ['$scope','$http', function($scope, $http) {
		     
		     var self=this;
		 
		     self.item=undefined;
		     self.id=undefined;
			 self.not_commitable=false;	

             self.get_item=function(id){
			 self.item=undefined;
		     $http.post('http://ka77575.eu/index.php/sintages/item_uncommited_j',{id:id}).success(
	             	
	             	function(data)
	             	{
						if(data.status=="ok"){
	             		self.item=data["result"] ;
						self.not_commitable=false;	
						
						}
						else if(data.status=="not_commitable")
						{
							self.not_commitable=true;	
						}
	             	});

		     
		     };
			self.clear=function(){
		 
			if(self.item==undefined)self.not_commitable=false;	
			}
			
			self.epikyrose=function()
			  {
			  
			  	$http.post('http://ka77575.eu/index.php/sintages/epikyrose_j',{id:self.item.sintagi.id}).success(
             	function(data)
             	{
             		$("#success-modal").modal('show');
					self.item=undefined;
						self.clear();
					
             		/*$http.post('http://ka77575.eu/index.php/sintages/item_farmakeiou_j',{id:self.item.sintagi.id}).success(
	             	function(data)
	             	{
	             		self.item=data["result"] ;
						
	             	});*/
             	});
			  }
		     

  		

		     
		  
		  } 
		  ])

.controller('Sintagi_Item_From_Giatros_Controller', ['$scope','$http','index_comp', function($scope, $http, index_comp) {
		     
		     var self=this;
		 
		     $scope.init_sintagi_item = function(value) {
		     self.id=value;
             $http.post('http://ka77575.eu/index.php/sintages/item_giatrou_j',{id:value}).success(
             	function(data)
             	{
             		self.item=data["result"] ;
             	});



             	 
			    
			  }

			  self.akyrose=function()
			  {
			  	$http.post('http://ka77575.eu/index.php/sintages/akyrose_j',{id:self.id}).success(
             	function(data)
             	{
             		$("#success-modal").modal('show');
             		$http.post('http://ka77575.eu/index.php/sintages/item_giatrou_j',{id:self.id}).success(
	             	function(data)
	             	{
	             		self.item=data["result"] ;
	             	});
             	});
			  }
		     

		     
		     

		     



		     
		  
		  } 
		  ])

.controller('Sintagi_Item_From_Farmakeio_Controller', ['$scope','$http','index_comp', function($scope, $http, index_comp) {
		     
		     var self=this;
		 
		     $scope.init_sintagi_item = function(value) {
		     self.id=value;
             $http.post('http://ka77575.eu/index.php/sintages/item_farmakeiou_j',{id:value}).success(
             	
             	function(data)
             	{
             		self.item=data["result"] ;
             	});



             	 
			    
			  }

			   
		     

		     
		    self.epikyrose=function()
			  {
			  	$http.post('http://ka77575.eu/index.php/sintages/epikyrose_j',{id:self.id}).success(
             	function(data)
             	{
             		$("#success-modal").modal('show');
             		$http.post('http://ka77575.eu/index.php/sintages/item_farmakeiou_j',{id:self.id}).success(
	             	function(data)
	             	{
	             		self.item=data["result"] ;
	             	});
             	});
			  }
		     

		     



		     
		  
		  } 
		  ])




 ;
 


 