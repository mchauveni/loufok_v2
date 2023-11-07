<?php

class Joueur extends Model
{
    protected $tableName = APP_TABLE_PREFIX.'joueur';
    protected $tableContribution = APP_TABLE_PREFIX.'contribution';
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function findOrdered(int $id): ?array
    {
        $sql = "SELECT *
        FROM `{$this->tableName}` j
        JOIN `{$this->tableContribution}` c ON j.id = c.id_joueur
        WHERE c.id_loufokerie = :id
        ORDER BY j.nom_plume ASC";
        $sth = $this->query($sql, [':id' => $id]);
        if ($sth && $sth->rowCount()) {
            return $sth->fetchAll();
        }

        return null;
    }
}