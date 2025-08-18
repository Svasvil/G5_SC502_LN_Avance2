<?php
class Database {
    public static function connect() {
        return new mysqli('localhost', 'root', 'Fvasvil123', 'ProyectoAmbienteWebG5');
    }
}