<?php
/**
 * @purpose 正则表达式常用的匹配项
 * @author zhangheng
 * @created 2014-04-27 16:00
 * @updated 2015-03-03 18:00
 */
namespace Tools;

class RegEx
{
	/**
	 * @purpose 正则匹配
	 * @param string $pattern 模式
	 * @param string $string 要比配的字符串
	 * @return bool
	 */
	public static function match($pattern, $string)
	{
		return preg_match($pattern, (string)$string);
	}


	/**
	 * @purpose 匹配是否是银行卡号
	 * @param string $card        	
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 * @created 2018-04-24 09:39
	 */
	public static function bankCard($card, $empty=false)
	{
		if ( true===$empty && !isset($card{0}) )
		{
			return true;
		}
		return self::match('/^[1-9][0-9]{15,18}$/', $card);
	}


	/**
	 * @purpose 匹配是否是二代身份证号
	 * @param string $card
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function card($card, $empty=false)
	{
		if ( true===$empty && !isset($card{0}) )
		{
			return true;
		}
		return self::match('/^[1-9][0-9]{5}((19)|(20))[0-9]{2}((0[1-9])|(1[0-2]))((0[1-9])|([1,2][0-9])|(3[0-1]))[0-9]{3}[0-9xX]$/', $card);
	}

	
	/**
	 * @purpose 匹配是否是全字符 即ASCII编码
	 * @param string $string        	
	 * @return bool
	 * @author zhangheng
	 */
	public static function char($string)
	{
		return self::match('/^[\x00-\x7f]+$/', $string);
	}

	
	/**
	 * @purpose 匹配是否全汉字
	 * @param string $string
     * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function chinese($string, $empty=false)
	{
        if ( true===$empty && !isset($string{0}) )
        {
            return true;
        }
		return self::match('/^[\x80-\xff]+$/', $string);
	}

	
	/**
	 * @purpose 匹配是否是(年-月-日)长日期格式
	 * @param string $date        	
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function date($date, $empty=false)
	{
		if ( true===$empty && !isset($date{0}) )
		{
			return true;
		}
		return self::match('/^((19)|(20))[0-9]{2}-(([1-9])|(0[1-9])|(1[0-2]))-(([1-9])|(0[1-9])|([1,2][0-9])|(3[0-1]))$/', $date);
	}

	
	/**
	 * @purpose 匹配是否是(年-月-日 时:分:秒)长日期时间格式
	 * @param string $datetime        	
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function datetime($datetime, $empty=false)
	{
		if ( true===$empty && !isset($datetime{0}) )
		{
			return true;
		}
		return self::match('/^((19)|(20))[0-9]{2}-(([1-9])|(0[1-9])|(1[0-2]))-(([1-9])|(0[1-9])|([1,2][0-9])|(3[0-1])) (([0-9])|([0-1][0-9])|(2[0-3])):(([0-9])|([0-5][0-9])):(([0-9])|([0-5][0-9]))$/', $datetime);
	}

	
	/**
	 * @purpose 匹配是否是电子邮箱格式，无长度限制
	 * @param string $email
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function email($email, $empty=false)
	{
		if ( true===$empty && !isset($email{0}) )
		{
			return true;
		}
		return self::match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email);
	}

	
	/**
	 * @purpose 判断是否是一个合法的图片url路径
	 * @param string $url 图片URL
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 * @created 2014-09-29 09:36
	 */
	public static function image($url, $empty=false)
	{
		if ( true===$empty && !isset($url{0}) )
		{
			return true;
		}
		return self::match('/^http(s)?:\/\/[\w\-\.\/\:]+(.jpg)|(.jpeg)|(.gif)|(.png)|(.bmp)|(.swf)$/', $url);
	}

	
	/**
	 * @purpose 匹配是否是int型数字，正数、负数、0
	 * @param int | string $number
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function integer($number, $empty=false)
	{
		$number = (string)$number;
		if ( true===$empty && !isset($number{0}) )
		{
			return true;
		}
		return self::match('/^[-]?[\d]+$/', $number);
	}

	
	/**
	 * @purpose 匹配是否是IPv4
	 * @param string $ip        	
	 * @return bool
	 * @author zhangheng
	 */
	public static function ip($ip)
	{
		return self::match('/^[1-9][\d]{0,2}(.((0)|([1-9][\d]{0,2}))){3}$/', $ip);
	}

	
	/**
	 * @purpose 验证是否符合函数命名规则
	 * @param string $methodName 函数名
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 * @created 2014-09-27 16:53
	 */
	public static function method($methodName, $empty=false)
	{
		if ( true===$empty && !isset($methodName{0}) )
		{
			return true;
		}
		return self::match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $methodName);
	}

	
	/**
	 * @purpose 匹配是否是中国移动、联通、电信手机号码
	 * @param string $mobile        	
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function mobile($mobile, $empty=false)
	{
		if ( true===$empty && !isset($mobile{0}) )
		{
			return true;
		}
		return self::match('/^1(([3,6,8][0-9]{9})|(4[5,7][0-9]{8})|(5[0,1,2,3,5,6,7,8,9][0-9]{8})|(7(([0,5][0,4,5,6,7,8,9][0-9]{7})|([1,3,6,7,8][0-9]{8})))|(9[8,9][0-9]{8}))$/', $mobile);
	}

	/**
	 * @purpose 匹配是否是(年-月)日期格式
	 * @param string $month
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 * @created 2015-03-14 17:48
	 */
	public static function month($month, $empty=false)
	{
		if ( true===$empty && !isset($month{0}) )
		{
			return true;
		}
		return self::match('/^((19)|(20))[0-9]{2}-(([1-9])|(0[1-9])|(1[0-2]))$/', $month);
	}

	
	/**
	 * @purpose 匹配是否是int型正整数数字
	 * @param int | string $number
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 * @updated 2014-10-30 15:26
	 */
	public static function number($number, $empty=false)
	{
		$number = (string)$number;
		if ( true===$empty && !isset($number{0}) )
		{
			return true;
		}
		return self::match('/^[\d]+$/', $number);
	}


	/**
	 * @purpose 匹配是否是IMEI移动设备串号
	 * @param string $imei
	 * @return bool
	 * @author wangyuhu
	 * @updated 2015-03-03 11:52
	 */
	public static function imei($imei)
	{
		return self::match('/^[0-9a-zA-Z\-]{10,40}$/', $imei);
	}

	
	/**
	 * @purpose 匹配是否是float数字型数字，整数、小数(小数点1~6位)、正数、负数、0
	 * @param int | float | string $number
	 * @return bool
	 * @author zhangheng
	 */
	public static function numeric($number, $empty=false)
	{
		$number = (string)$number;
		if ( true===$empty && !isset($number{0}) )
		{
			return true;
		}
		return self::match('/(^[-]?[\d]+(\.[\d]{1,15})?$)|(^([-]?[\d]*)?\.[\d]{1,15}$)/', $number);
	}

	
	/**
	 * @purpose 匹配是否是邮政编码，6位数字
	 * @param string $postcode
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function postcode($postcode, $empty=false)
	{
		if ( true===$empty && !isset($postcode{0}) )
		{
			return true;
		}
		return self::match('/^[\d]{6}$/', $postcode);
	}

	
	/**
	 * @purpose 匹配是否是QQ号码
	 * @param string $qq
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function qq($qq, $empty=false)
	{
		if ( true===$empty && !isset($qq{0}) )
		{
			return true;
		}
		return self::match('/^[1-9][\d]{4,9}$/', $qq);
	}

	
	/**
	 * @purpose SQL注入检测
	 * @param string $pattern 正则表达式
	 * @param string | array 检测的值
	 * @return bool
	 * @author zhangheng
	 * @created 2014-09-04 19:03
	 */
	private static function injection($pattern, $parameter)
	{
		if ( is_array($parameter) )
		{
			foreach ( $parameter as $param )
			{
				if ( self::match($pattern, $param) )
				{
					return true;
				}
			}
			return false;
		}
		else
		{
			return self::match($pattern, $parameter);
		}
	}

	
	/**
	 * @purpose 匹配是否含有SQL注入字符
	 * @param string | array $parameter GET参数
	 * @return bool
	 * @author zhangheng
	 */
	public static function sqlGet($parameter)
	{
		return self::injection("/'|\\bsleep\((\\d+)\);|<[^>]*?>|^\\+\/v(8|9)|\\b(and|or)\\b[\\w\\s]{2,6}?(>|<|=|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\s*javascript\\b:|\\s+on[a-z]+\\b\\s*=|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE|SCHEMA)/is", $parameter);
	}

	
	/**
	 * @purpose 匹配是否含有SQL注入字符
	 * @param string | array $parameter POST参数
	 * @return bool
	 * @author zhangheng
	 */
	public static function sqlPost($parameter)
	{
		return self::injection("/\\bsleep\((\\d+)\);|^\\+\/v(8|9)|\\b(and|or)\\b[\\w\\s]{2,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\s*javascript\\b:|\\s+on[a-z]+\\b\\s*=|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE|SCHEMA)/is", $parameter);
	}

	
	/**
	 * @purpose 匹配是否含有SQL注入字符
	 * @param string | array $parameter COOKIE参数
	 * @return bool
	 * @author zhangheng
	 */
	public static function sqlCookie($parameter)
	{
		return self::injection("/\\bsleep\((\\d+)\);|\\b(and|or)\\b[\\w\\s]{2,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\s*javascript\\b:|\\s+on[a-z]+\\b\\s*=|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE|SCHEMA)/is", $parameter);
	}

	
	/**
	 * @purpose 匹配是否是座机电话号码，区号-电话号[-分机号]
	 * @param string $tel        	
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function tel($tel, $empty=false)
	{
		if ( true===$empty && !isset($tel{0}) )
		{
			return true;
		}
		return self::match('/^0[1-9][0-9]{1,2}-[1-9][0-9]{6,7}(-[0-9]{1,4})?$/', $tel);
	}

	
	/**
	 * @purpose 匹配是否是免费电话号码，400或800电话
	 * @param string $tel
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function telFree($tel, $empty=false)
	{
		if ( true===$empty && !isset($tel{0}) )
		{
			return true;
		}
		return self::match('/^(400)|(800)[\d]{7}$/', $tel);
	}

	
	/**
	 * @purpose 匹配是否是(时:分:秒)长时间格式
	 * @param string $time
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function time($time, $empty=false)
	{
		if ( true===$empty && !isset($time{0}) )
		{
			return true;
		}
		return self::match('/^(([0-9])|([0-1][0-9])|(2[0-3])):(([0-9])|([0-5][0-9])):(([0-9])|([0-5][0-9]))$/', $time);
	}

	
	/**
	 * @purpose 匹配是否是url
	 * @param string $url
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 */
	public static function url($url, $empty=false)
	{
		if ( true===$empty && !isset($url{0}) )
		{
			return true;
		}
		return self::match('/^(\b(http(s)?:\/\/)(([a-z0-9\-]+\.)+)([a-z0-9]+\b)((\/?[\w\-\.\%\&\?\{\}\@\#=]*)*))|((file:\/\/\/)[\w-]+)/i', $url);
	}

	
	/**
	 * @purpose 匹配是否符合农机360网用户名规则
	 * @param string $username
	 * @return bool
	 * @author zhangheng
	 */
	public static function username($username)
	{
		return self::match('/^[a-zA-Z0-9]{4,16}$/', $username) && !self::number($username);
	}


	/**
	 * @purpose 匹配是否符合bangid规则
	 * @param string $bangid
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 * @create 2015-09-09 17:52
	 */
	public static function bangid($bangid, $empty=false)
	{
		if ( true===$empty && !isset($bangid{0}) )
		{
			return true;
		}
		return self::match('/^[a-zA-Z0-9_]{1,20}$/', $bangid);
	}

	
	/**
	 * @purpose 匹配是否符合农机360网密码规则
	 * @param string $password
	 * @return bool
	 * @author zhangxp
	 */
	public static function password($password)
	{
		return self::match('/^[A-Za-z0-9\_]{6,16}$/', $password);
	}

	
	/**
	 * @purpose 匹配是否符合农机360网用户KEY规则
	 * @param string $key        	
	 * @return bool
	 * @author zhangheng
	 */
	public static function userKey($key, $empty=false)
	{
		if ( true===$empty && !isset($key{0}) )
		{
			return true;
		}
		return self::match('/^[A-Za-z0-9]{32}$/', $key);
	}

	
	/**
	 * @purpose 匹配是否是正常年份
	 * @param int | string $year
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 * @created 2014-10-30 15:37
	 */
	public static function year($year, $empty=false)
	{
		$year = (string)$year;
		if ( true===$empty && !isset($year{0}) )
		{
			return true;
		}
		return self::match('/^((19)|(20))[0-9]{2}$/', $year);
	}

	
	/**
	 * @purpose 匹配是否符合SQL语句数字in条件查询格式，例：5,12,33
	 * @param string $string
	 * @param bool $empty 是否允许为空，默认不允许
	 * @return bool
	 * @author zhangheng
	 * @updated 2014-11-01 19:01
	 */
	public static function formatNumberIn($string, $empty=false)
	{
		if ( true===$empty && !isset($string{0}) )
		{
			return true;
		}
		return self::match('/^[\d]+([\s]*,[\s]*[\d]+)*$/', $string);
	}
}