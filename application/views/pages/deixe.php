<div class="container">
<div class="row">	
<table class="table">

<tbody>
<?php foreach ($tasks as $task): ?>
	<tr><td>
    <?php echo $task->title ?></td>
    
       <td> <?php echo $task->text ?></td>
   
    <td><a href="/pages/task/<?php echo $task->slug ?>">Προβολή</a></td> 
	</tr> 
<?php endforeach ?>
	</tbody>
</table>
</div>
</div>