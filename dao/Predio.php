<?php

/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 4:24 PM
 */
class Predio {

    private $id;
    private $nome;
    private $descricao;

    public function __construct( $id, $nome, $descricao ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @return Sala[] todas as salas do predio
     */
    public function getSalas() {
        require_once(__DIR__."/../lib/ConexaoBD.php");
        require_once(__DIR__."/Sala.php");
        $sql = 'SELECT * FROM sala WHERE id_predio = ?';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute(array($this->id));
        $rows = $statement->fetchAll();
        $salas = array();
        foreach ($rows as $row) {
            $salas[] = new Sala ($row['id'],$row['id_predio'],$row['nro'],$row['descricao']);
        }
        return $salas;
    }

    /**
     * @return Predio[] todos os predios
     */
    public static function getAll() {
        require_once(__DIR__."/../lib/ConexaoBD.php");
        $sql = 'SELECT * FROM predio';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $predios = array();
        foreach ($rows as $row) {
            $predios[] = new Predio($row['id'],$row['nome'],$row['descricao']);
        }
        return $predios;
    }

    public function asJSON() {
        $json = '{ "id": "' . $this->id . '",';
        $json .= '"nome": "' . $this->nome . '",';
        $json .= '"descricao": "' . $this->descricao . '"}';
        return $json;
    }

    public static function getById($id) {
        require_once(__DIR__."/../lib/ConexaoBD.php");
        $sql = 'SELECT nome, descricao FROM predio WHERE id = ?';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute(array($id ));
        $ret = $statement->fetchObject();
        return new Predio($id,$ret->nome,$ret->descricao);
    }

    public function save() {
        require_once(__DIR__."/../lib/ConexaoBD.php");
        $conn = ConexaoBD::getConnection();
        if ($conn->inTransaction()) {
            return false;
        }
        $conn->beginTransaction();
        if (isset($this->id)) { //update
            //TODO: UPDATE
        } else { //insert
            $sql = 'INSERT INTO predio (nome,descricao) values (?,?)';
            $statement = $conn->prepare($sql);
            if (!$statement->execute(array($this->nome,$this->descricao))) {
                $conn->rollBack();
                return false;
            }
            $this->id = $conn->lastInsertId();
            if ($conn->commit()) {
                return $this->id;
            }
            $conn->rollBack();
            return false;
        }
    }

}