<?php

/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/15/17
 * Time: 3:34 PM
 */
class TipoEquipamento {


    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $nome;
    /**
     * @var string
     */
    private $descricao;
    /**
     * @var string path para imagem
     */
    private $img;

    /**
     * TipoEquipamento constructor.
     * @param int $id
     * @param string $nome
     * @param string $descricao
     * @param string $img
     */
    public function __construct($id, $nome, $descricao, $img) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->img = $img;
    }

    public static function getById( $id )
    {
        require_once(__DIR__."/../lib/ConexaoBD.php");
        $sql = 'SELECT nome, descricao, img FROM tipoeqpt WHERE id = ?';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute(array($id));
        $ret = $statement->fetchObject();
        return new TipoEquipamento($id,$ret->nome,$ret->descricao,$ret->img);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg( $img)
    {
        $this->img = $img;
    }

    /**
     * @return TipoEquipamento[]
     */
    public static function getAll() {
        require_once(__DIR__."/../lib/ConexaoBD.php");
        $sql = 'SELECT * FROM tipoeqpt';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $tipos = array();
        foreach ($rows as $row) {
            $tipos[] = new TipoEquipamento($row['id'],$row['nome'],$row['descricao'],$row['img']);
        }
        return $tipos;
    }

    /**
     * @return string json
     */
    public function asJSON() {
        $json = '{ "id": "' . $this->id . '",';
        $json .= '"nome": "' . $this->nome . '",';
        $json .= '"descricao": "' . $this->descricao . '",';
        $json .= '"img": "' . $this->getImagePath() . '"}';
        return $json;
    }

    public function getImagePath() {
        require_once(__DIR__.'/../ConfigClass.php');
        $ret = ConfigClass::diretorioImagens . '/' . $this->img;
        return $ret;
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
            $sql = 'INSERT INTO tipoeqpt (nome,descricao,img) values (?,?,?)';
            $statement = $conn->prepare($sql);
            if (!$statement->execute(array($this->nome,$this->descricao,$this->img))) {
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