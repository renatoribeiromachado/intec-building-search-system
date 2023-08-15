<?php

abstract class Conn {

    private static $Host = HOST;
    private static $User = USER;
    private static $Pass = PASS;
    private static $Dbsa = DBSA;
    private static $Connect = null;
    
    private static $HostCrm = HOSTCrm;
    private static $UserCrm = USERCrm;
    private static $PassCrm = PASSCrm;
    private static $DbsaCrm = DBSACrm;
    private static $ConnectCrm = null;

    private static function Conectar() {
        try {
            if (self::$Connect == null):
                $dsn = 'mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa;
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
                self::$Connect = new PDO($dsn, self::$User, self::$Pass, $options);
            endif;
        } catch (PDOException $e) {
            var_dump($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Connect;
    }

    private static function ConectarCrm() {
        try {
            if (self::$ConnectCrm == null) {
                $dsn = 'mysql:host=' . self::$HostCrm . ';dbname=' . self::$DbsaCrm;
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
                self::$ConnectCrm = new PDO($dsn, self::$UserCrm, self::$PassCrm, $options);
            }
        } catch (PDOException $e) {
            var_dump($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        self::$ConnectCrm->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$ConnectCrm;
    }

    /** Retorna um objeto PDO Singleton Pattern. */
    protected static function getConn() {
        return self::Conectar();
    }

    protected static function getConnCrm() {
        return self::ConectarCrm();
    }

}
