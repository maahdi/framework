<?php
include_once _DIR_.'ORM/requete/requete.php';

class Repository{

    private $table;
    private $repositoryFinder;

    public function setTable($table){
        $this->table = $table;
    }

    public function getRepositoryFinder($repo){
        $this->repositoryFinder = $repo;
    }
    //
    //$orderBy = nomDuChamp
    //
    public function findAll($table, $orderBy){
        $requete = new Requete('select');
        $requete->liste(array('*'));
        $requete->liste(array($table), 'from');
        $requete->liste(array($orderBy),'order by');
        $requete->setAscOrder();
        $retour = $requete->query();
        unset($requete);
        return $retour;
    }

    public function &getAll(){
        $join = false;
        //       $directory = glob(_DIR_.'Projet/*/classes/'.$class.'.php');
        //       if ($directory != false){
        //           include $directory[0];
        $data = &$this->getYaml();
        $requete = new Requete();
        foreach ($data['champs'] as $valeur){
            if (array_key_exists('primary',$valeur)){
                $primary = $valeur['title'];
            }
            if (array_key_exists('relation',$valeur)){
                $join = true;
                $tableJointe = $valeur['title'];
                $foreignKey = $valeur['joinOne'];
            }else{
                $champs[] = $valeur['title'];
            }
        }
        $requete->liste($champs,'select');
        $requete->liste(array($data['nom']), 'from');
        $rslt = $requete->queryPrepare($champs);
        $champs[] = $tableJointe;
        $primaryKey = array();
        foreach ($rslt as $valeur){
            foreach($champs as $champ){
                if ($join && $champ == $tableJointe){
                    $requete->liste(array($this->table.'.'.$foreignKey),'select');
                    $requete->liste(array($this->table, $tableJointe), 'from');
                    $requete->where($tableJointe.'.'.$foreignKey, $this->table.'.'.$foreignKey);
                    $requete->where($primary, $valeur->$primary);
                    $ids = $requete->query();
                    foreach ($ids as $id){
                        $liste[$valeur->$primary][$champ] = $this->repositoryFinder->getAnotherRepo($tableJointe)->getOne($id->$foreignKey);
                    }
                }else{
                    $liste[$valeur->$primary][$champ] = $valeur->$champ;                   
                }
                $primaryKey[] = $valeur->$primary;
            }
        }
        foreach ($primaryKey as $valeur){
            $return[$valeur] = new $data['nom']($liste[$valeur]);
        }
        unset($requete);
        return $return;
    }


    private function &getYaml(){
        $yaml = glob(_DIR_.'Projet/*/classes/'.$this->table.'.yaml');
        $data = yaml_parse_file($yaml[0],0);
        return $data;
    }

    public function getOne($id){
        $requete = new Requete();
        $data = &$this->getYaml();
        $join = false;
        foreach ($data['champs'] as $valeur){
            $champs [] = $valeur['title'];
        }
        foreach ($data['champs'] as $valeur){
            if (array_key_exists('primary', $valeur)){
                $primary = $valeur['title'];
            }
            if (array_key_exists('relation',$valeur)){
                $join = true;
                $tableJointe = $valeur['title'];
                $foreignKey = $valeur['joinOne'];
            }else{
                $champs[] = $valeur['title'];
            }
        }
        $requete->liste($champs,'select');
        $requete->liste(array($data['nom']), 'from');
        $requete->where($primary, $id);
        $rslt = $requete->queryPrepare($champs);
        $primaryKey = array();
        foreach ($rslt as $valeur){
            foreach($champs as $champ){
                $liste[$valeur->$primary][$champ] = $valeur->$champ;
                if ($join){
                    $requete->liste(array($this->table.'.'.$foreignKey),'select');
                    $requete->liste(array($this->table, $tableJointe), 'from');
                    $requete->where($tableJointe.'.'.$foreignKey, $this->table.'.'.$foreignKey);
                    $requete->where($primary, $valeur->$primary);
                    $ids = $requete->query();
                    foreach ($ids as $id){
                        $liste[$valeur->$primary][$champ] = &$this->repositoryFinder->getAnotherRepo($tableJointe)->getOne($id);
                        //
                        $joinKeys[] = $valeur['title'];
                    }
                }
                $primaryKey[] = $valeur->$primary;
            }
        }

        foreach ($primaryKey as $valeur){
            $return[$valeur] = new $data['nom']($liste[$valeur]);
        }
        unset($requete);
        return $return;
    }


    //
    //On lui donne la table, le champ de la recherche et le champ recherché
    //
    public function findBy($table, $where, $whereSearch){
        $requete = new Requete('select');
        $requete->liste(array('*'));
        $requete->liste(array($table), 'from');
        $requete->where('?', '?');
        $rslt = $requete->queryPrepare(array($where,$whereSearch));
        unset($requete);
        if (!$rslt){
            return false;
        }else{
            return $rslt;
        }
    }
}
