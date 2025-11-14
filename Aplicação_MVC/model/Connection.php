<?php 

class Connection {


        private static $instance = null;
    public static function getInstance() {
        if (!self::$instance) {


            try {
                // AJUSTE SEU USUÁRIO E SENHA AQUI: 
                $host = 'localhost';
                $dbname = 'projeto_bebidas';
                $user = 'root';
                $pass = '1234';

                // CONECTA AO MYSQL

                self::$instance = new PDO("mysql:host=$host;charset=utf8",$user,$pass );

                self::$instance->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);

                // CRIA O BANCO DE DADOS SE NÃO EXISTIR 

                self::$instance->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            self::$instance->exec("USE $dbname");

            } catch (PDOException $e) {
                die("Erro ao conectar ao MySQL: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}