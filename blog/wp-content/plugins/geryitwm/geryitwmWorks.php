<?
$msg = $_GET["msg"];
$q = mysqli_query("SELECT * FROM ".$wpdb->prefix."works  order by ord desc");
while($r = mysqli_fetch_object($q)) {$wids[] = $r->wid;$ords[] = $r->ord;}
?>
<div id="geryitwm" class="wrap">
    <div class="icon32" id="icon-edit"><br/></div>
    <h2>Works</h2>
    <br class="clear"/>
    <? if($msg){?><div id="msg"><?=$msg;?></div><? }?>
    <ul class="widefat">
        <li class="cap">
            <ul>
                <li class="w5">Order</li>
                <li class="w10">Title</li>
                <li class="w5">Year</li>
                <li class="w20">Desc</li>
                <li class="w15">Tags</li>
                <li class="w15">Url</li>
                <li class="w25">Image</li>
                <li class="w5">Action</li>
            </ul>
        </li>
        
        <li class="add">
        	<form method="post" enctype="multipart/form-data" action="admin.php?page=geryitwm/index.php&act=add">
                <ul>
                    <li class="w5">&nbsp;</li>
                    <li class="w10"><textarea name="title"></textarea></li>
                    <li class="w5"><input type="text" name="year" maxlength="2" /></li>
                    <li class="w20"><input type="text" name="shortDes" /><br /><textarea name="des"></textarea></li>
                    <li class="w15"><textarea name="tags"></textarea></li>
                    <li class="w15"><input type="text" name="url" /></li>
                    <li class="w25">218x135px<br /><input type="file" name="img" /></li>
                    <li class="w5"><input type="submit" value="Add" /></li>
                </ul>
            </form>
        </li>
        
		<?
        $q = mysqli_query("SELECT * FROM ".$wpdb->prefix."works order by ord desc");
        for($i=0;$r=mysqli_fetch_assoc($q);$i++){
			?>
			<li <? if($i%2==1) echo 'class="liType2" ';?>>
                <form method="post" enctype="multipart/form-data" action="admin.php?page=geryitwm/index.php&act=edit">
                    <ul>
                        <li id="moveWorks" class="w5">
							<?=$r["ord"];?><br />
                            <? if($ords[$i+1]){?><a href="admin.php?page=geryitwm/index.php&act=move&newOrd=<?=$ords[$i+1];?>&currentWid=<?=$r['wid'];?>&effectedNewOrd=<?=$ords[$i];?>&effectedId=<?=$wids[$i+1];?>">&darr;</a><? }?> 
                            <? if($ords[$i-1]){?><a href="admin.php?page=geryitwm/index.php&act=move&newOrd=<?=$ords[$i-1];?>&currentWid=<?=$r['wid'];?>&effectedNewOrd=<?=$ords[$i];?>&effectedId=<?=$wids[$i-1];?>">&uarr;</a><? }?> 
                        </li>
                        <li class="w10"><textarea name="title"><?=$r["title"];?></textarea></li>
                        <li class="w5"><input type="text" name="year" value="<?=$r["year"];?>" maxlength="2" /></li>
                        <li class="w20"><input type="text" name="shortDes" value="<?=$r["shortDes"];?>" /><br /><textarea name="des"><?=$r["des"];?></textarea></li>
                        <li class="w15"><textarea name="tags"><?=$r["tags"];?></textarea></li>
                        <li class="w15"><input type="text" name="url" value="<?=$r["url"];?>" /></li>
                        <li class="w25"><img src="/images/works_full/<?=$r["img"];?>" width="" height="" alt="" /><br /><input type="file" name="img" /></li>
                        <li class="w5"><input type="submit" value="  Edit  " /><br /><input type="button" value="Del" onclick="window.location='admin.php?page=geryitwm/index.php&act=del&wid=<?=$r["wid"];?>' " /></li>
                    </ul>
                    <input type="hidden" name="wid" value="<?=$r["wid"];?>" />
                </form>
			</li>
        <? }?>
    </ul>
