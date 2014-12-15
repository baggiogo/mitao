<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/
function biz_url_ck( $BIZ_URLDB )
{
    global $db;
    global $_SERVER;
    global $HTTP_SERVER_VARS;
    global $PHP_SELF_TEMP;
    if ( !is_array( $BIZ_URLDB ) )
    {
        if ( 20090110 < date( "Ymd" ) )
        {
            exit( "为了保证你的系统运行更稳定，功能更强大，请到官方同步升级后，才可以继续使用，谢谢合作，如给你带来不便，敬请原谅！" );
        }
    }
    else
    {
        $BIZ_URLDB[] = "127.0.0.1";
        $BIZ_URLDB[] = "localhost";
        $BIZ_URLDB[] = "qibosoft.com";
        $PHP_SELF_TEMP = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $PHP_SELF = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : $PHP_SELF_TEMP;
        $HTTP_HOST = $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : $HTTP_SERVER_VARS['HTTP_HOST'];
        $WEBURL = $HTTP_HOST.$PHP_SELF;
        if ( !$WEBURL )
        {
            $allowuse = 1;
        }
        else
        {
            foreach ( $BIZ_URLDB as $key => $value )
            {
                if ( eregi( "^[-a-z0-9_\\.]*{$value}", $WEBURL ) )
                {
                    $allowuse = 1;
                }
            }
        }
        return 1;
    }
}

function info_ck( )
{
}

function module_ck( $type )
{
    global $pre;
    global $BIZ_MODULEDB;
    if ( !is_array( $BIZ_MODULEDB ) )
    {
        if ( 20090110 < date( "Ymd" ) )
        {
            exit( "为了保证你的系统运行更稳定，功能更强大，请到官方同步升级后，才可以继续使用，谢谢合作，如给你带来不便，敬请原谅！" );
        }
    }
}

if ( !function_exists( "AvoidGather" ) )
{
    exit( "F" );
}

unset( $BIZ_URLDB );

if ( 20100310 < date( "Ymd" ) )
{
}

$BIZ_URLDB[] = "qibosoft.com";
if ( $BIZID && $BIZ_URLDB )
{
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">";
    echo "你的授权ID是:<br>";
    echo md5( "{$BIZ_URLDB['0']}" );
    exit( );
}

$BIZ_MODULEDB[] = "fenlei";
$IS_BIZPhp168 = 1;
$IS_BIZ = 1;
biz_url_ck( $BIZ_URLDB );
?>