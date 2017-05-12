<?php

/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 5:22 PM
 */
class Sala {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var Predio
     */
    private $predio;

    /**
     * @var string
     */
    private $nro;

    /**
     * @var string
     */
    private $descricao;

    /**
     * Sala constructor.
     * @param $id
     * @param $idPredio
     * @param $nro
     * @param $descricao
     */
    public function __construct($id, $predio, $nro, $descricao) {
        $this->id = $id;
        require_once ('Predio.php');
        $this->predio = is_object($predio) ? $predio : Predio::getById($predio);
        $this->nro = $nro;
        $this->descricao = $descricao;
    }

    public static function getById($id)
    {
        require_once ("lib/ConexaoBD.php");
        $sql = 'SELECT id_predio, nro, descricao FROM sala WHERE id = ?';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute(array($id));
        $ret = $statement->fetchObject();
        return new Sala($id,$ret->id_predio,$ret->nro,$ret->descricao);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPredio()
    {
        return $this->predio;
    }

    /**
     * @param mixed $predio
     */
    public function setPredio($predio)
    {
        $this->predio = $predio;
    }

    /**
     * @return mixed
     */
    public function getNro()
    {
        return $this->nro;
    }

    /**
     * @param mixed $nro
     */
    public function setNro($nro)
    {
        $this->nro = $nro;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }


    /**
     * @return Sala[] todas as salas
     */
    public static function getAll() {
        require_once ("lib/ConexaoBD.php");
        $sql = 'SELECT * FROM sala';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $salas = array();
        foreach ($rows as $row) {
            $salas[] = new Sala ($row['id'],$row['id_predio'],$row['nro'],$row['descricao']);
        }
        return $salas;
    }

    /**
     * @return Container[]
     */
    public function getContainers() {
        require_once ("lib/ConexaoBD.php");
        require_once ("Container.php");
        $sql = 'SELECT * FROM container WHERE id_sala = ?';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute(array($this->id));
        $rows = $statement->fetchAll();
        $salas = array();
        foreach ($rows as $row) {
            $salas[] = new Container($row['id'],$row['id_sala'],$row['cod'],$row['descricao']);
        }
        return $salas;
    }

    public function asJSON() {
        require_once ('Predio.php');
        //$id, $predio, $nro, $descricao
        $json = '{ "id": "' . $this->id . '",';
        $json .= '"predio": ' . $this->predio->asJSON() . ',';
        $json .= '"nro": "' . $this->nro . '",';
        $json .= '"descricao": "' . $this->descricao . '"}';
        return $json;

    }

    public function save() {
        require_once ("lib/ConexaoBD.php");
        require_once ("Predio.php");
        $conn = ConexaoBD::getConnection();
        if ($conn->inTransaction()) {
            return false;
        }
        $conn->beginTransaction();
        if (isset($this->id)) { //update
            //TODO: UPDATE
        } else { //insert
            $sql = 'INSERT INTO sala (id_predio,nro,descricao) values (?,?,?)';
            $statement = $conn->prepare($sql);
            if (!$statement->execute(array($this->predio->getId(),$this->nro,$this->descricao))) {
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