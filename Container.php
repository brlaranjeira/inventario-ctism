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


}