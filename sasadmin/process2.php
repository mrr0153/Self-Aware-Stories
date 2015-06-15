<?php

function getthemecategories($cid='',$start='',$limitstr='')
	{
		$sql = "select * from sas_themecategories ";
		if($cid != '')
			$sql .= " where cat_id=".$cid;
		if($limitstr != '')
			$sql .= " limit ".$start.",".$limitstr;
		$rs = mysql_query($sql);
		if($rs && mysql_num_rows($rs)>0)
			return($rs);
		return false;
	}
	function getthemes($prod_id='',$start='',$limitstr='')
	{
		$sql = "select * from sas_themes ";
		if($prod_id != '')
			$sql .= " where prod_id=".$prod_id;
		if($limitstr != '')
			$sql .= " limit ".$start.",".$limitstr;
		$rs = mysql_query($sql);
		if($rs && mysql_num_rows($rs)>0)
			return($rs);
		return false;
	}
    function getcharacters($id='',$start='',$limitstr='')
	{
		$sql = "select * from sas_characters ";
		if($id != '')
			$sql .= " where id=".$id;
		if($limitstr != '')
			$sql .= " limit ".$start.",".$limitstr;
		$rs = mysql_query($sql);
		if($rs && mysql_num_rows($rs)>0)
			return($rs);
		return false;
	}
	
	function manageprofiles($name,$title,$imagepath,$description,$pid,$cid,$status,$id='')
	{  /* echo "<script>alert(".$id.'---'.$name.'---'.$title.'---'.$imagepath.'---'.$description.'---'.$pid.'---'.$cid.'---'.$status.")</script>"; */
		if($id != '')
		{  
			mysql_query("update sas_characters set name='$name', title='$title', photopath='$imagepath', description='$description',pid='$pid',cid='$cid',status='$status' where id='$id'");
			if(mysql_affected_rows()>0)
				return true;
		}
		else
		{
			mysql_query("insert into sas_characters (name,title,photopath,description,pid,cid,status) values('$name','$title','$imagepath','$description','$pid','$cid','$status')");
			if(mysql_affected_rows()>0)
				return true;
		}
		return false;
	}
	
	function manageprofilesdetails($name,$title,$imagepath,$description,$pid,$pcid,$status,$id='')
	{  echo "<script>alert(".$id.'---'.$name.'---'.$title.'---'.$imagepath.'---'.$description.'---'.$pid.'---'.$cid.'---'.$status.")</script>";
		if($id != '')
		{  
			mysql_query("update sas_chars set char_name='$name', title='$title', photopath='$imagepath', description='$description',prod_id='$pid',cat_id='$pcid',status='$status' where id='$id'");
			if(mysql_affected_rows()>0)
				return true;
		}
		else
		{
			mysql_query("insert into sas_chars (char_name,title,photopath,description,prod_id,cat_id,status) values('$name','$title','$imagepath','$description','$pid','$pcid','$status')");
			if(mysql_affected_rows()>0)
				return true;
		}
		return false;
	}
	 function getcharacterdetails($id='',$start='',$limitstr='')
	{
		$sql = "select * from sas_chars ";
		if($id != '')
			$sql .= " where id=".$id;
		if($limitstr != '')
			$sql .= " limit ".$start.",".$limitstr;
		$rs = mysql_query($sql);
		if($rs && mysql_num_rows($rs)>0)
			return($rs);
		return false;
	}
	?>