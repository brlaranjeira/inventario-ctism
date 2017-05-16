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
        require_once ('Sala.php');
        require_once ('Container.php');
        require_once ('lib/Usuario.php');
        require_once ('TipoEquipamento.php');
        require_once ('EstadoEquipamento.php');
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

    public function save() {
        require_once("lib/ConexaoBD.php");
        require_once("Sala.php");
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
            if (!$statement->execute(array(
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
            ))) {
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