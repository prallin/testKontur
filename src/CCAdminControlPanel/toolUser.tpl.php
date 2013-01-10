<table class="table table-striped table-bordered table-hover">
    <caption><h4>Users</h4></caption>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Acronym</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <?php if($user != null):?>
    <tbody>
        <?php foreach($user as $val):?>
        <tr>
            <td><?=$val['id']?></td>
            <td><?=$val['name']?></td>
            <td><?=$val['acronym']?></td>
            <td><?=$val['email']?></td>
             <td><a href='<?=create_url("acp/edituser/{$val['id']}")?>'><i class="icon-edit"></i></a></td>
             <td><a href='<?=create_url("acp/deleteuser/{$val['id']}")?>'><i class="icon-remove"></i></a></td>   
        </tr>
        <?php endforeach; ?>
        
        
    </tbody>
<?php else:?>
     <tbody>  
        <tr>
            <td>No User exists.</td>
        </tr>
      </tbody>
<?php endif;?>
    
    <caption align="bottom"><a href="acp/createuser"><i class="icon-plus-sign"></i> Add User</a></caption>
</table>
