<div class="container" ng-app>
<div class="row" ng-controller="Controller">	
<div class="col-md-12" >



 	<div ng-show="after_success">Επιτυχία  <button ng-click="reset()"> Κλείσιμο </button></div>
		 

		<form name="the_form" ng-show="!after_success" novalidate>
			<div class="form-group " ng-class="{'has-error':the_form.user_email.$invalid&&the_form.user_email.$dirty}">
				<label for="price" class="control-label"><?php echo "t6yhu56t" ?></label>
			
				<input
				  class="form-control"
				  type="email"
				  
				  required
				  name="user_email"
				  ng-model="user_email"
				  placeholder="e-mail"
				  number
				  ng-change="hide_failure()"
	 
				  />
				
				<div  class="control-label" ng-show="the_form.user_email.$dirty && the_form.user_email.$invalid"> 
		    		<div class="control-label" ng-show="the_form.user_email.$error.required">Δώστε email</div>
		    		<div class="control-label" ng-show="the_form.user_email.$error.email">Δεν είναι email</div>
		    		
		    		
	    		</div>

			 
			</div>
			
			 
			<div class="form-group" ng-show="failure" ng-class="{'has-error':true}" >
			
				<div  class="control-label" > 
					<div class="control-label">Αποτυχία</div>
		    		<div class="control-label" ng-show="!is_user">Το email δεν αντιστοιχεί σε χρήστη</div>
		    		<div class="control-label" ng-show="is_already">Το φαρμακείο έχει ήδη καταχωρηθεί</div>
		    		<div class="control-label" ng-show="is_other_role">Ο χρήστης σε άλλο ρόλο</div>
		    		
		    		
	    		</div> 
			
			</div>


			<div><input type="submit" name="submit" ng-click="check_user_email(user_email)"   ng-disabled="the_form.$invalid"   class="btn btn-primary  " value="Υπάρχει" /></div>
		</form>
 


	 
	</div>
</div>

<script>
  function Controller($scope,$http) {
    
    $scope.user_email = ""; 
    
    $scope.check_user_email=function(email_to_check){
	  $scope.ajaxon=true;

      $http.post('http://ka77575.eu/index.php/farmakeia/create_j',{"user_email":email_to_check }).success(function(data) {
      $scope.ajaxon=false;
      //alert(data["can_be"]);
      $scope.is_user=data["is_user"];
      $scope.is_already=data["is_already"];
      $scope.is_other_role=data["is_other_role"];
      $scope.failure=!data["can_be"];

       if(!$scope.failure)
       {
       	$scope.after_success = true;
       	
       	//the_form.$setPristine();
       }
       
	
		 
     });
  };

   $scope.reset=function()
   {
 		  	$scope.user_email = ""; 
   			$scope.the_form.$setPristine();
   			$scope.after_success=false;
   			$scope.failure=false;
   }
    $scope.hide_failure=function()
   {
 		  
   			$scope.failure=false;
   }

    
 
  
  }
</script>


 
</div>