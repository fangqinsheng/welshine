<?php 
	defined('IN_ADMIN') or exit('No permission resources.');
	include $this->admin_tpl('header','admin');
?>
<div class="pad_10">
<div class="table-list">


<form name="myform" id="myform" action="?m=order&c=logistics&a=edit" method="post" >
<input type="hidden" name="buttontype" id="buttontype" value="edit" />
<table width="100%" cellspacing="0"  class="table-list">
    <thead>
        <tr>
	        <th width="10%">序 号</th>
	        <th width="30%">名 称</th>
	        <th width="10%">费 用</th>
			<th >说 明</th>
        </tr>
    </thead>
    <tbody>
 <?php foreach($logistics_data as $info){ ?> 
 <?php $n++;?>
	<tr>
		<td align="center"><?php echo $info['logistics_id']?><input type="hidden" name="logistics_id[]" value="<?php echo $info['logistics_id']?>" /></td>
		<td align="center"><input type="text" name="name[]" value="<?php echo $info['name']?>" size="20" /></td>
		<td align="center"><input type="text" name="fee[]" value="<?php echo $info['fee']?>" size="6" /></td>
		<td align="center"><input type="text" name="desc[]" value="<?php echo $info['desc']?>" size="60" /></td>
	</tr>
	<?php }?>
    </tbody>
</table>
<div class="btn">
	<input name="upbut" type="submit" class="button" value="保存" ><!-- onClick="$('#buttontype').val('edit');$('#myform').submit();" -->
</div> 
</form>   

</div>
</div>
</body>
</html>
