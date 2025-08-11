<?php
class EspeciesController
{
    private function data()
    {
        return [
            ["id" => 1, "nombre" => "Pez Payaso", "habitat" => "Arrecife", "descripcion" => "Pez tropical de arrecife, convive con anémonas.", "imagen" => "../Img/pez-payaso.jpg"],
            ["id" => 2, "nombre" => "Caballito de mar", "habitat" => "Agua salada", "descripcion" => "Cría en bolsa del macho, muy sensible a parámetros.", "imagen" => "../Img/caballito_mar.jpg"],
            ["id" => 3, "nombre" => "Pez Betta", "habitat" => "Agua dulce", "descripcion" => "Territorial, requiere agua templada y poca corriente.", "imagen" => "../Img/pez_betta.jpg"],
            ["id" => 4, "nombre" => "Pez Ángel", "habitat" => "Arrecife", "descripcion" => "Colorido y pacífico; prefiere arrecifes con muchas cuevas.", "imagen" => "../Img/pez_angel.jpg"],
            ["id" => 5, "nombre" => "Pez Guppy", "habitat" => "Agua dulce", "descripcion" => "Muy resistente y vivíparo; ideal para principiantes.", "imagen" => "../Img/pez_guppy.jpg"],

        ];
    }

    public function index()
    {
        $titulo = "Especies Marinas";
        $especies = $this->data();
        include '../Pestanas/especies.php';
    }

    public function buscar($q = '', $habitat = '')
    {
        $titulo = "Especies Marinas";
        $q = mb_strtolower(trim($q));
        $habitat = mb_strtolower(trim($habitat));
        $all = $this->data();
        $especies = array_values(array_filter($all, function ($e) use ($q, $habitat) {
            $txt = mb_strtolower($e['nombre'] . ' ' . $e['habitat'] . ' ' . $e['descripcion']);
            $okQ = $q === '' || mb_strpos($txt, $q) !== false;
            $okH = $habitat === '' || mb_strtolower($e['habitat']) === $habitat;
            return $okQ && $okH;
        }));
        include '../Pestanas/especies.php';
    }
}
