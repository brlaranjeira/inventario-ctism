<?php

/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/16/17
 * Time: 4:07 PM
 */
class EstadoEquipamento {

    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $descricao;

    /**
     * EstadoEquipamento constructor.
     * @param int $id
     * @param string $descricao
     */
    public function __construct($id, $descricao) {
        $this->id = $id;
        $this->descricao = $descricao;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @return EstadoEquipamento[]
     */
    public static function getAll() {
        require_once(__DIR__."/../lib/ConexaoBD.php");
        $sql = 'SELECT * FROM estadoeqpt';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $estados = array();
        foreach ($rows as $row) {
            $estados[] = new EstadoEquipamento($row['id'],$row['descricao']);
        }
        return $estados;
    }


    /**
     * @param $id
     * @return EstadoEquipamento
     */
    public static function getById( $id ) {
        require_once (__DIR__."/../lib/ConexaoBD.php");
        $sql = 'SELECT descricao FROM estadoeqpt WHERE id = ?';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute(array($id));
        $ret = $statement->fetchObject();
        return new EstadoEquipamento($id,$ret->descricao);
    }

    public function asJSON() {
        $json = '{ "id": "' . $this->id . '",';
        $json .= '"descricao": "' . $this->descricao . '"}';
        return $json;
    }


}