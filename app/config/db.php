<?php
class Database {
    public static function connect() {
        return new mysqli('localhost', 'root', '123', 'ProyectoAmbienteWebG5');
    }
}