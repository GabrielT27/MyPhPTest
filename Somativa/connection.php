<?php
class Connection {
    private static $instance = null;

    public static function getInstance() {
        if (!self::$instance) {
            try {
                $host = 'localhost';
                $user = 'root';
                $senha = 'senaisp';
                $dbname = 'BibliotecaSenai';

                // **PRIMEIRO conecta sem especificar o banco**
                self::$instance = new PDO(
                    "mysql:host=$host;charset=utf8",
                    $user,
                    $senha
                );

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // **CRIA o banco se não existir**
                self::$instance->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                
                // **AGORA seleciona o banco**
                self::$instance->exec("USE $dbname");

            } catch (PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
?>