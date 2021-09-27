<?php
	function getFirstNChar($inputstring, $n, $cut)
	{	if (strlen($inputstring) <= $n) return $inputstring;
		if ($cut == 1) return substr($inputstring, 0, $n);
		
		$prev = strrpos( substr($inputstring, 0, $n), ' ');
		$next = strpos ( substr($inputstring, $n), ' ');
		
		if ($n - $prev < $next) return substr($inputstring, 0, $prev) . "...";

		return substr($inputstring, 0, $n + $next) . "...";
	}
	function adminpagin($list, $l=2){
		$strselectbox = '<select class="form-control" id="ddlPagging" name="ddlPagging" onchange="ddlPaggingChange()" style="width:120px;">';
        	for($i=1; $i<=$list->lastPage(); $i++)
        	{	
        		$strselectbox .= '<option '.(($list->currentPage()==$i)? 'selected' : '').' value="'.$list->url($i).'&l='.$l.'">Trang: '.$i.'/'.$list->lastPage().'</option>';
        	}
		$strselectbox .= '</select>';
		return $strselectbox;
	}
	function rewritefilename($strname, $path){
		$arrayfilename = explode('.', $strname);
		$extend	= array_pop($arrayfilename);
		$stringname = is_array($arrayfilename)? implode('_', $arrayfilename) : $arrayfilename;
		$stringname = \Str::slug($stringname, '-');
		$newname = $stringname.'.'.$extend;
		$i=1;
		while(Storage::exists($path.'/'.$newname))
		{
			$newname = $stringname.'_'.$i.'.'.$extend;
			$i++;
		}
		return $newname;
	}
	function uploadfile($path, $image){
		$filename = '';
		if (request()->hasFile($image))
		{	
			$filename = rewritefilename(request()->file($image)->getClientOriginalName(), $path);
         request()->file($image)->storeAs($path, $filename);
		}
		return $filename;	
	}
	function FunctionUpload($isDelete, $path, $image, $oldfile){
		$id = request()->Id;
		if($id==0) // thêm mới
		{
			$filename = uploadfile($path, $image);	
		}elseif($isDelete){ //edite
			Storage::delete($path.'/'.$oldfile);
			$filename = '';
		}else{
			if(request()->hasFile($image)){
				$filename = uploadfile($path, $image);
				Storage::delete($path.'/'.$oldfile);	
			}else{
				$filename = $oldfile;
			}
		}			
		return $filename;
	}
	function navigationbar($listfunc, $parent_id=0, $stt=0){
		$cate_child = array();
		$menu ='';
		foreach($listfunc as $key=>$func)
		{
			if($func['parent_id']==$parent_id)
			{
				$cate_child[] = $func;
				unset($listfunc[$key]); 	
			}
		}
		if($cate_child)
		{
			if($stt == 0)
			{
				$class ='class="nav navbar-nav"';
				$classcavaret = '<b class="caret"></b>';
				$classa 	= 'class="dropdown-toggle" data-toggle="dropdown"';
			}else{
				$class= 'class="dropdown-menu"';
				$classcavaret = '';
				$classa    = '';
			}
			$menu = '<ul '.$class.'>';
			foreach($cate_child as $key=>$item)
			{
				$flag = false;
				foreach($listfunc as $sub){
					if($sub['parent_id']== $item['id'])
					{
						$flag = true;
						break;
					}	
				}
				$classli = $item['parent_id']==0? 'class="root"' : ($flag? 'class="dropdown-submenu"' : '');
				$menu .= '<li '. $classli .'><a '.$classa.' tabindex="-1" href="'.(($item['linkpath']=='#')? '#' : route($item['linkpath'])).'">'.$item['function_name_vn'].$classcavaret.'</a>';
				$menu .= navigationbar($listfunc, $item['id'], ++$stt);
				$menu .= '</li>';
			}
			$menu .= '</ul>';	
		}
		return $menu;
	}
	function productMenu($listcat, $parent_id=0){
		$listarray = array();
		$string = '';
		foreach($listcat as $key=>$item)
		{
			if($item['parent_id']==$parent_id)
			{
				$listarray[] = $item;
				unset($listcat[$key]);
			}
		}
		if(count($listarray))
		{
			$string = '<ul>';
			foreach($listarray as $item)
			{
				$string .= '<li><a href="'.(($item['parent_id']==0)? '' : url('list-product/'.$item['re_name'].'-'.$item['id'])).'">'.$item['title'].'</a>';
				$string .= productMenu($listcat, $item['id']);
				$string .= '</li>';  	
			}
			$string .= '</ul>';	
		}
		return $string;
	}
	function RewriteUrlUnique($id, $str, $table, $fieldname, $language_id=0){
		$rewrite_name = \Str::slug($str, '-');
		$temp = $rewrite_name;
		$loop = true;
		$idx = 1;
		while($loop){
			if($language_id)
				$record = \DB::table($table)->where([[$fieldname, $temp], ['language_id', $language_id], ['id', '!=', $id]])->first();
			else
				$record = \DB::table($table)->where([[$fieldname, $temp], ['id', '!=', $id]])->first();
			if($record){
				$temp = $rewrite_name .'-'.$idx;
				$idx++;
			}else{
				$loop = false;
			}
		}			
		return $temp;
	}
?>