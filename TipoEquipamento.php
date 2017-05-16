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
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;
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

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg(string $img)
    {
        $this->img = $img;
    }

    /**
     * @return TipoEquipamento[]
     */
    public static function getAll() {
        require_once ("lib/ConexaoBD.php");
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
     * @return static json
     */
    public function asJSON() {
        $json = '{ "id": "' . $this->id . '",';
        $json .= '"nome": "' . $this->nome . '",';
        $json .= '"descricao": "' . $this->descricao . '",';
        $json .= '"descricao": "' . $this->getImagePath() . '"}';
        return $json;
    }

    public function getImagePath() {
        require_once ('ConfigClass.php');
        $ret = ConfigClass::diretorioImagens . '/' . $this->img;
        return $ret;
    }

    public function save() {
        require_once ("lib/ConexaoBD.php");
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