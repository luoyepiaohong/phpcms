<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>

<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    <?php if(isset($big_menu)) echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>　';?>
    <?php echo admin::submenu($_GET['menuid'],$big_menu); ?><span>|</span><a href="javascript:artdialog('setting','?m=poster&c=space&a=setting','<?php echo L('module_setting')?>',540,320);void(0);"><em><?php echo L('module_setting')?></em></a>
    </div>
</div>

<div class="pad-lr-10">
<form name="myform" action="?m=poster&c=poster&a=listorder" method="post" id="myform">
<div class="table-list">
    <table width="100%" cellspacing="0" class="contentWrap">
        <thead>
            <tr>
            <th width="30" align="center" class="myselect">
                    <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable" value="" id="check_box" onclick="selectall('id[]');" />
                        <span></span>
                    </label></th>
			<th width="35">ID</th>
			<th width="70"><?php echo L('listorder')?></th>
			<th align="center"><?php echo L('poster_title')?></th>
			<th width="70" align="center"><?php echo L('poster_type')?></th>
			<th width='200' align="center"><?php echo L('for_postion')?></th>
			<th width="50" align="center"><?php echo L('status')?></th>
			<th width='50' align="center"><?php echo L('hits')?></th>
			<th width="130" align="center"><?php echo L('addtime')?></th>
			<th width="110" align="center"><?php echo L('operations_manage')?></th>
            </tr>
        </thead>
        <tbody>
 <?php 
if(is_array($infos)){
	foreach($infos as $info){
		$space = $this->s_db->get_one(array('spaceid'=>$info['spaceid']), 'name');
?>   
	<tr>
	<td align="center" class="myselect">
                    <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" name="id[]" value="<?php echo $info['id']?>" />
                        <span></span>
                    </label></td>
	<td align="center"><?php echo $info['id']?></td>
	<th width="70"><input type="text" size="5" name="listorder[<?php echo $info['id']?>]" value="<?php echo $info['listorder']?>" id="listorder"></th>
	<td><?php echo $info['name']?></td>
	<td align="center"><?php echo $types[$info['type']]?></td>
	<td align="center"><?php echo $space['name']?></td>
	<td align="center"><?php if($info['disabled']) { echo L('stop'); } elseif((strtotime($info['enddate'])<SYS_TIME) && (strtotime($info['enddate'])>0)) { echo L('past'); } else { echo L('start'); }?></td>
	<td align="center"><?php echo $info['clicks']?></td>
	<td align="center"><?php echo format::date($info['addtime'], 1);?></td>
	<td align="center"><a href="index.php?m=poster&c=poster&a=edit&id=<?php echo $info['id'];?>&pc_hash=<?php echo $_SESSION['pc_hash'];?>&menuid=<?php echo $_GET['menuid']?>" ><?php echo L('edit')?></a>|<a href="?m=poster&c=poster&a=stat&id=<?php echo $info['id']?>&spaceid=<?php echo $_GET['spaceid'];?>"><?php echo L('stat')?></a></td>
	</tr>
<?php 
	}
}
?>
</tbody>
    </table>
  
    <div class="btn"><label for="check_box"><?php echo L('selected_all')?>/<?php echo L('cancel')?></label>
    	<input name='submit' type='submit' class="button" value='<?php echo L('listorder')?>'>&nbsp;
        <input name='submit' type='submit' class="button" value='<?php echo L('start')?>' onClick="document.myform.action='?m=poster&c=poster&a=public_approval&passed=0'">&nbsp;
        <input name='submit' type='submit' class="button" value='<?php echo L('stop')?>' onClick="document.myform.action='?m=poster&c=poster&a=public_approval&passed=1'">&nbsp;
		<input name="button" type="button" class="button" value="<?php echo L('delete')?>" onClick="Dialog.confirm('<?php echo L('confirm', array('message' => L('selected')))?>',function(){document.myform.action='?m=poster&c=poster&a=delete';$('#myform').submit();});">&nbsp;&nbsp;</div>  </div>
 <div id="pages"><?php echo $this->db->pages;?></div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
<!--
function edit(id, name) {
	artdialog('edit','?m=poster&c=poster&a=edit&id='+id,'<?php echo L('edit_ads')?>--'+name,600,430);
}
//-->
</script>