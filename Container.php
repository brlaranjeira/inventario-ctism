<?php

/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 7:01 PM
 */
class Container
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var Sala
     */
    private $sala;
    /**
     * @var string
     */
    private $cod;
    /**
     * @var string
     */
    private $descricao;

    /**
     * container constructor.
     * @param int $id
     * @param Sala $sala
     * @param string $cod
     * @param string $descricao
     */
    public function __construct($id, $sala, $cod, $descricao) {
        require_once ('Sala.php');
        $this->id = $id;
        $this->sala = is_object($sala) ? $sala : Sala::getById($sala);
        $this->cod = $cod;
        $this->descricao = $descricao;
    }


    /**
     * @return Container[]
     */
    public static function getAll() {
        require_once ("lib/ConexaoBD.php");
        $sql = 'SELECT * FROM container';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $containers = array();
        foreach ($rows as $row) {
            $containers[] = new Container($row['id'],$row['id_sala'],$row['cod'],$row['descricao']);
        }
        return $containers;
    }

    /**
     * @param $ctism_inventario_container
     * @return Container
     */
    public static function getById($id) {
        require_once ("lib/ConexaoBD.php");
        $sql = 'SELECT id_sala, cod, descricao FROM container WHERE id = ?';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute(array($id));
        $ret = $statement->fetchObject();
        return new Container($id,$ret->id_sala,$ret->cod,$ret->descricao);
    }

    /**
     * @return string
     */
    public function asJSON() {
        require_once ('Sala.php');
        //$id, $predio, $nro, $descricao
        $json = '{ "id": "' . $this->id . '",';
        $json .= '"sala": ' . $this->sala->asJSON() . ',';
        $json .= '"cod": "' . $this->cod . '",';
        $json .= '"descricao": "' . $this->descricao . '"}';
        return $json;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Sala
     */
    public function getSala(): Sala
    {
        return $this->sala;
    }

    /**
     * @param Sala $sala
     */
    public function setSala(Sala $sala)
    {
        $this->sala = $sala;
    }

    /**
     * @return string
     */
    public function getCod(): string
    {
        return $this->cod;
    }

    /**
     * @param string $cod
     */
    public function setCod(string $cod)
    {
        $this->cod = $cod;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }

    public function save() {
        require_once ("lib/ConexaoBD.php");
        require_once ("Sala.php");
        $conn = ConexaoBD::getConnection();
        if ($conn->inTransaction()) {
            return false;
        }
        $conn->beginTransaction();
        if (isset($this->id)) { //update
            //TODO: UPDATE
        } else { //insert
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $sql = 'INSERT INTO container (id_sala,cod,descricao) values (?,?,?)';
            $statement = $conn->prepare($sql);
            if (!$statement->execute(array($this->sala->getId(),$this->cod,$this->descricao))) {
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