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
     * @return Predio[] todos os predios
     */
    public static function getAll() {
        require_once ("lib/ConexaoBD.php");
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


}