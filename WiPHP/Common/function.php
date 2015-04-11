<?php
/*
 * 截取字符串
 */
function cutstr($str,$begin=0,$length=250,$charset='utf-8')
{
	return mb_substr($str,$begin,$length,$charset);
}

/*
 * 比较两个值是否相等
 */
function equal($first,$second)
{
	if($first == $second)
	{
		return true;
	}
	else 
	{
		return false;
	}
}

/*
 * 自动生成url地址，并直接打印输出
 */
function createUrl($s,$a,$v=null,$m=null)
{
	if($m==null)
		$m = APP_NAME;
	if($a==null)
		$a = 'index';
	if($v==null)
		echo $url = __APP__."/$m/$s/$a";
	else 
		echo $url = __APP__."/$m/$s/$a?$v";
}

/*
 * 自动生成url地址，不打印输出
 */
function getUrl($s,$a,$v=null,$m=null)
{
	if($m==null)
		$m = APP_NAME;
	if($a==null)
		$a = 'index';
	if($v==null)
		return $url = __APP__."/$m/$s/$a";
	return $url = __APP__."/$m/$s/$a?$v";
}

/*
 * 链接跳转
 */
function jumpUrl($url)
{
	echo "<script>location.href='$url';</script>";
}

/** 
* 将中文编码
* @param array $data
* @returnstring
*/
function ch_json_encode($data) {
    $ret = ch_urlencode($data);
    $ret =json_encode($ret);
    return urldecode($ret);
}
function ch_urlencode($data) {
    if (is_array($data) || is_object($data)) {
        foreach ($data as $k => $v) {
            if (is_scalar($v)) {
                if (is_array($data)) {
                    $data[$k] = urlencode($v);
                } elseif (is_object($data)) {
                    $data->$k =urlencode($v);
                }
            } elseif (is_array($data)) {
                $data[$k] = ch_urlencode($v);//递归调用该函数
            } elseif (is_object($data)) {
                $data->$k = ch_urlencode($v);
            }
        }
    }
    return$data;
}

/*
 * 格式化json数据
 */
function json_format($json)
{
     $result = '' ;
     $pos = 0 ;
     $strLen = strlen($json) ;
     $indentStr = '    ' ;
     $newLine = "\r\n" ;
     $prevChar = '' ;
     $outOfQuotes = true ;
     for($i=0 ; $i<=$strLen ; $i++) {
        // Grab the next character in the string.
        $char = substr($json, $i, 1) ;
        // Are we inside a quoted string?
        if ($char=='"' && $prevChar!='\\') {
           	$outOfQuotes = !$outOfQuotes;
           	// If this character is the end of an element,
        	// output a new line and indent the next line.
        }else if(($char=='}' || $char==']') && $outOfQuotes) {
            $result .= $newLine;
            $pos--;
            for($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }
        // Add the character to the result string.
        $result .= $char;
        // If the last character was the beginning of an element,
        // output a new line and indent the next line.
        if(($char==',' || $char=='{' || $char=='[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char=='{' || $char=='[') {
                 $pos++ ;
             }
             for($j=0; $j<$pos; $j++) {
                 $result .= $indentStr ;
             }
         }
         $prevChar = $char ;
     }

     print $result;
     die();
     return $result ;
}

/**
* 格式化打印数组
*/
function p_array($expression)
{
    echo '<pre>';
    print_r($expression);
    echo  '</pre>';
}

/**
* 格式化打印Json格式数据
*/
function p_json($json)
{
    echo '<pre>';
    echo json_format($json);
    echo '</pre>';
}

function url_get_contents($url)
{
    //header('Content-Type:text/html;charset=utf-8');
    $file = fopen($url, "rb");  
    //只读2字节  如果为(16进制)1f 8b (10进制)31 139则开启了gzip ;
    $bin = fread($file, 2); 
    fclose($file);  
    $strInfo = @unpack("C2chars", $bin);  
    $typeCode = intval($strInfo['chars1'].$strInfo['chars2']);  
    $isGzip = 0;  
    switch ($typeCode)  
    {
        case 31139:      
          //网站开启了gzip
            $isGzip = 1;
            break;
        default:  
            $isGzip = 0;
    }  
    $url = $isGzip ? "compress.zlib://".$url:$url; // 三元表达式
    $response = file_get_contents($url); //获得米尔军事网数据
    return $response;
}

function gzip_decode($data) { 
    $len = strlen($data); 
    if ($len < 18 || strcmp(substr($data,0,2),"\x1f\x8b")) { 
        return null;  // Not GZIP format (See RFC 1952) 
    } 
    $method = ord(substr($data,2,1));  // Compression method 
    $flags  = ord(substr($data,3,1));  // Flags 
    if ($flags & 31 != $flags) { 
        // Reserved bits are set -- NOT ALLOWED by RFC 1952 
        return null; 
    }  
    // NOTE: $mtime may be negative (PHP integer limitations) 
    $mtime = unpack("V", substr($data,4,4)); 
    $mtime = $mtime[1]; 
    $xfl   = substr($data,8,1); 
    $os    = substr($data,8,1); 
    $headerlen = 10; 
    $extralen  = 0; 
    $extra     = ""; 
    if ($flags & 4) { 
        // 2-byte length prefixed EXTRA data in header 
        if ($len - $headerlen - 2 < 8) { 
            return false;    // Invalid format 
        } 
        $extralen = unpack("v",substr($data,8,2)); 
        $extralen = $extralen[1]; 
        if ($len - $headerlen - 2 - $extralen < 8) { 
          return false;    // Invalid format 
        } 
        $extra = substr($data,10,$extralen); 
        $headerlen += 2 + $extralen; 
    } 

    $filenamelen = 0; 
    $filename = ""; 
    if ($flags & 8) { 
        // C-style string file NAME data in header 
        if ($len - $headerlen - 1 < 8) { 
            return false;    // Invalid format 
        } 
        $filenamelen = strpos(substr($data,8+$extralen),chr(0)); 
        if ($filenamelen === false || $len - $headerlen - $filenamelen - 1 < 8) { 
            return false;    // Invalid format 
        } 
        $filename = substr($data,$headerlen,$filenamelen); 
        $headerlen += $filenamelen + 1; 
    } 

    $commentlen = 0; 
    $comment = ""; 
    if ($flags & 16) { 
        // C-style string COMMENT data in header 
        if ($len - $headerlen - 1 < 8) { 
            return false;    // Invalid format 
        } 
        $commentlen = strpos(substr($data,8+$extralen+$filenamelen),chr(0)); 
        if ($commentlen === false || $len - $headerlen - $commentlen - 1 < 8) { 
            return false;    // Invalid header format 
        } 
        $comment = substr($data,$headerlen,$commentlen); 
        $headerlen += $commentlen + 1; 
    } 

    $headercrc = ""; 
    if ($flags & 1) { 
        // 2-bytes (lowest order) of CRC32 on header present 
        if ($len - $headerlen - 2 < 8) { 
            return false;    // Invalid format 
        } 
        $calccrc = crc32(substr($data,0,$headerlen)) & 0xffff; 
        $headercrc = unpack("v", substr($data,$headerlen,2)); 
        $headercrc = $headercrc[1]; 
        if ($headercrc != $calccrc) { 
            return false;    // Bad header CRC 
        } 
        $headerlen += 2; 
    } 

    // GZIP FOOTER - These be negative due to PHP's limitations 
    $datacrc = unpack("V",substr($data,-8,4)); 
    $datacrc = $datacrc[1]; 
    $isize = unpack("V",substr($data,-4)); 
    $isize = $isize[1]; 

    // Perform the decompression: 
    $bodylen = $len-$headerlen-8; 
    if ($bodylen < 1) { 
        // This should never happen - IMPLEMENTATION BUG! 
        return null; 
    } 
    $body = substr($data,$headerlen,$bodylen); 
    $data = ""; 
    if ($bodylen > 0) { 
        switch ($method) { 
            case 8: 
                // Currently the only supported compression method: 
                $data = gzinflate($body); 
                break; 
            default: 
                // Unknown compression method 
                return false; 
        } 
    } else { 
        // I'm not sure if zero-byte body content is allowed. 
        // Allow it for now...  Do nothing... 
    } 

    // Verifiy decompressed size and CRC32: 
    // NOTE: This may fail with large data sizes depending on how 
    //       PHP's integer limitations affect strlen() since $isize 
    //       may be negative for large sizes. 
    if ($isize != strlen($data) || crc32($data) != $datacrc) { 
        // Bad format!  Length or CRC doesn't match! 
        return false; 
    } 
    return $data; 
}