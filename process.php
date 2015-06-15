<?php
	include("../config/config.inc.php");
	
	function getadminusers($auid='',$start='',$limitstr='')
	{
		$sql = "select * from adminusers";
		if($auid != '')
			$sql .= " where auid=".$auid;
		if($limitstr != '')
			$sql .= " limit ".$start.",".$limitstr;	
		$rs = mysql_query($sql);
		if($rs && mysql_num_rows($rs)>0)
			return($rs);
		return false;
	}
	
	function manageadminusers($fname,$lname,$username,$password,$email,$auid='')
	{
	
		if($auid != '')
		{
		mysql_query("update adminusers set fname='$fname',lname='$lname',username='$username',password='$password',email='$email' where auid=$auid");
			if(mysql_affected_rows()>0)
				return true;
		}
		else
		{
			mysql_query("insert into adminusers (fname,lname,username,password,email) values('$fname','$lname','$username',$password,'$email')");
			if(mysql_affected_rows()>0)
				return true;
		}
		return false;
	}
	
	?>