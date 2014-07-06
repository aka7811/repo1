<div class="container   ">
 

 
<div class="row">
<?php echo form_open('pages/create') ?>
<?php echo validation_errors(); ?>
	<div class="form-group <?php if(form_error('title')!="") echo "has-error"  ?>">
	<label for="title" >Τίτλος</label>
	<input class="form-control"  type="input" name="title"  placeholder="Δώστε Τίτλο" value="<?php echo set_value('title'); ?>"/><br />
	</div>
	
	<div class="form-group <?php if(form_error('text')!="") echo "has-error"  ?>">
	<label    for="text">Κείμενο</label>
	<textarea class="form-control"  name="text"  placeholder="Γράψτε το Κείμενο" value="<?php echo set_value('text'); ?>"></textarea><br />
	</div>
	
	<div class="form-group <?php if(form_error('category')!="") echo "has-error"  ?> ">
	<label  for="category">Κατηγορία</label>
	<select  class="form-control"  name="category"   >
		<?php foreach ($categories as $cat): ?>

						<option value='<?php echo $cat['id']?>'> <h1><?php echo $cat['name']?></h1></option>
						 

					<?php endforeach ?>
					
			
	</select></div>		
	<input type="submit" name="submit"  class="btn btn-default  " value="Υποβολή" />

</form>
</div>


 

</div>