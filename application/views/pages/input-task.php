<div class="container   ">
 

 
<div class="row">
<?php echo form_open('pages/create') ?>
<?php echo validation_errors(); ?>
	<div class="form-group <?php if(form_error('title')!="") echo "has-error"  ?>">
	<label for="title" >������</label>
	<input class="form-control"  type="input" name="title"  placeholder="����� �����" value="<?php echo set_value('title'); ?>"/><br />
	</div>
	
	<div class="form-group <?php if(form_error('text')!="") echo "has-error"  ?>">
	<label    for="text">�������</label>
	<textarea class="form-control"  name="text"  placeholder="������ �� �������" value="<?php echo set_value('text'); ?>"></textarea><br />
	</div>
	
	<div class="form-group <?php if(form_error('category')!="") echo "has-error"  ?> ">
	<label  for="category">���������</label>
	<select  class="form-control"  name="category"   >
		<?php foreach ($categories as $cat): ?>

						<option value='<?php echo $cat['id']?>'> <h1><?php echo $cat['name']?></h1></option>
						 

					<?php endforeach ?>
					
			
	</select></div>		
	<input type="submit" name="submit"  class="btn btn-default  " value="�������" />

</form>
</div>


 

</div>