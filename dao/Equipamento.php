<?php

/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/16/17
 * Time: 6:01 PM
 */
class Equipamento {


    /**
     * @var integer
     */
    private $id;
    /**
     * @var Sala
     */
    private $sala;
    /**
     * @var Container
     */
    private $container;
    /**
     * @var Usuario
     */
    private $responsavel;
    /**
     * @var TipoEquipamento
     */
    private $tipo;
    /**
     * @var string
     */
    private $descricao;
    /**
     * @var string
     */
    private $patrimonio;
    /**
     * @var string
     */
    private $numserie;
    /**
     * @var EstadoEquipamento
     */
    private $estado;
    /**
     * @var string
     */
    private $obs;
    /**
     * @var string
     */
    private $foto;

    /**
     * Equipamento constructor.
     * @param int $id
     * @param Sala $sala
     * @param Container $container
     * @param Usuario $responsavel
     * @param TipoEquipamento $tipo
     * @param string $descricao
     * @param string $patrimonio
     * @param string $numserie
     * @param EstadoEquipamento $estado
     * @param string $obs
     * @param string $foto
     */
    public function __construct($id, $sala, $container, $responsavel, $tipo, $descricao, $patrimonio, $numserie, $estado, $obs, $foto) {
        require_once (__DIR__.'/Sala.php');
        require_once (__DIR__.'/Container.php');
        require_once (__DIR__.'/../lib/Usuario.php');
        require_once (__DIR__.'/TipoEquipamento.php');
        require_once (__DIR__.'/EstadoEquipamento.php');
        $this->id = $id;
        $this->sala = is_object($sala) ? $sala : Sala::getById($sala);
        $this->container = !isset($container) ? null : is_object($container) ? $container : Container::getById($container);
        $this->responsavel = is_object($responsavel) ? $responsavel : new Usuario($responsavel);
        $this->tipo = is_object($tipo) ? $tipo : TipoEquipamento::getById($tipo);
        $this->descricao = $descricao;
        $this->patrimonio = $patrimonio;
        $this->numserie = $numserie;
        $this->estado = is_object($estado) ? $estado : EstadoEquipamento::getById($estado);
        $this->obs = $obs;
        $this->foto = $foto;
    }

    /**
     * @return Equipamento[]
     */
    public static function getAll() {
        require_once(__DIR__."/../lib/ConexaoBD.php");
        $sql = 'SELECT * FROM equipamento';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $equipamentos = array();
        foreach ($rows as $row) {
            $equipamentos[] = new Equipamento(
                $row['id'],
                $row['id_sala'],
                $row['id_container'],
                $row['responsavel'],
                $row['id_tipoeqpt'],
                $row['descricao'],
                $row['patrimonio'],
                // $numserie, $estado, $obs, $foto) {
                $row['numserie'],
                $row['id_estadoeqpt'],
                $row['obs'],
                $row['foto']
            );
        }
        return $equipamentos;
    }


    /**
     * @param $id
     * @return Equipamento
     */
    public static function getById($id) {
        require_once(__DIR__."/../lib/ConexaoBD.php");
        $sql = 'SELECT id_sala, id_container, responsavel, id_tipoeqpt, descricao ';
        $sql .= 'patrimonio, numserie, id_estadoeqpt, obs, foto, FROM container WHERE id = ?';
        $conn = ConexaoBD::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute(array($id));
        $ret = $statement->fetchObject();
        return new Equipamento($id,
            $ret->id_sala,
            $ret->id_container,
            $ret->responsavel,
            $ret->id_tipoeqpt,
            $ret->descricao,
            $ret->patrimonio,
            $ret->numserie,
            $ret->id_estadoeqpt,
            $ret->obs,
            $ret->foto
        );
    }

    public function save() {
        require_once(__DIR__."/../lib/ConexaoBD.php");
        require_once(__DIR__."/Sala.php");
        $conn = ConexaoBD::getConnection();
        if ($conn->inTransaction()) {
            return false;
        }
        $conn->beginTransaction();
        if (isset($this->id)) { //update
            //TODO: UPDATE
        } else { //insert
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $sql = 'INSERT INTO equipamento (id_sala,id_container,responsavel,id_tipoeqpt,descricao,patrimonio,numserie,id_estadoeqpt,obs,foto)';
            $sql .= 'values (?,?,?,?,?,?,?,?,?,?)';
            $statement = $conn->prepare($sql);
            $execOk = $statement->execute(array(
                $this->sala->getId(),
                isset($this->container) ? $this->container->getId() : null,
                $this->responsavel->getUid(),
                $this->tipo->getId(),
                $this->descricao,
                $this->patrimonio,
                $this->numserie,
                $this->estado->getId(),
                $this->obs,
                $this->foto
            ));
            if (!$execOk) {
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

    public function getImagePath() {
        require_once(__DIR__.'/../ConfigClass.php');
        $ret = ConfigClass::diretorioImagens . '/' . $this->foto;
        return $ret;
    }

    public function asJSON() {
        require_once (__DIR__.'/Sala.php');
        require_once (__DIR__.'/Container.php');
        require_once (__DIR__.'/../lib/Usuario.php');
        require_once (__DIR__.'/TipoEquipamento.php');
        require_once (__DIR__.'/EstadoEquipamento.php');
        //$id, $sala, $container, $responsavel, $tipo, $descricao, $patrimonio, $numserie, $estado, $obs, $foto
        $json = '{ "id": "' . $this->id . '",';
        $json .= '"sala": ' . $this->sala->asJSON() . ',';
        $json .= '"container": ' . $this->container->asJSON() . ',';
        $json .= '"responsavel": ' . $this->responsavel . ',';
        $json .= '"tipo": ' . $this->tipo->asJSON() . ',';
        $json .= '"descricao": "' . $this->descricao . '",';
        $json .= '"patrimonio": "' . $this->patrimonio . '",';
        $json .= '"numserie": "' . $this->numserie . '",';
        $json .= '"estado": ' . $this->estado->asJSON() . ',';
        $json .= '"obs": "' . $this->obs . '",';
        $json .= '"foto": "' . $this->getImagePath() . '"}';
        return $json;
    }



}