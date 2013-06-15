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
        $data = $this->getYaml();
        $requete = new Requete();
        foreach ($data['champs'] as $valeur){
            if (array_key_exists('primary',$valeur)){
                $primary = $valeur['title'];
            }
            if (array_key_exists('joinOne',$valeur)){
                $join = true;
                $tableJointe = $valeur['title'];
                $foreignKey = $valeur['joinOne'];
            }else{
                $champs[] = $valeur['title'];
            }
        }
        $requete->liste($champs,'select');
        $requete->liste(array($data['nom']), 'from');
        $requete->liste(array($primary), 'order by');
        $requete->setAscOrder();
        $rslt = $requete->query();
        if (isset($tableJointe)){
            $champs[] = $tableJointe;    
        }
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
                        $liste[$valeur->$primary][$champ] = &$this->repositoryFinder->getAnotherRepo($tableJointe)->getOne($id->$foreignKey);
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
        return $return;
    }


    public function save(&$objet){
        $requete = new Requete();
        $join = false;
        $data = &$this->getYaml();
        foreach ($data['champs'] as $valeur){
            if (array_key_exists('primary',$valeur)){
                $primary = $valeur['title'];
            }else if (array_key_exists('joinOne',$valeur)){
                $join = true;
                $tableJointe = $valeur['title'];
                $foreignKey = $valeur['joinOne'];
            }else{
                $champs[] = $valeur['title'];
            }
        }
        $requete->liste(array($this->table.' set '),'update');
        $nb = count($champs);
        $set = array();
        $exec = array();
        $string = '';
        foreach ($champs as $valeur){
            $set[] = $valeur.' = ?';
            $string = 'get'.ucfirst($valeur);
            $exec[] = $objet->$string();
        }
        $requete->liste($set);
        $string = '';
        if (isset($foreignKey)){
            $requete->liste(array($foreignKey.' = ?'),',');
            $string = 'get'.ucfirst($foreignKey);
            $exec[] = $objet->$string();
        }
        $requete->where($primary, '?');
        $string = '';
        $string = 'get'.ucfirst($primary);
        $exec[] = $objet->$string();
        $requete->queryPrepare($exec);
    }

    private function &getYaml(){
        $yaml = glob(_DIR_.'Projet/*/classes/'.$this->table.'.yaml');
        $data = yaml_parse_file($yaml[0],0);
        return $data;
    }

    public function &getOne($id){
        $requete = new Requete();
        $data = &$this->getYaml();
        $join = false;
        $joinMany = false;
        foreach ($data['champs'] as $valeur){
            if (array_key_exists('primary', $valeur)){
                $primary = $valeur['title'];
            }
            if (array_key_exists('joinOne',$valeur)){
                $join = true;
                $tableJointe = $valeur['title'];
                $foreignKey = $valeur['joinOne'];
            }else if (array_key_exists('joinMany', $valeur)){
                $joinMany = true;
                
            }else{
                $champs[] = $valeur['title'];
            }
        }
        $requete->liste($champs,'select');
        $requete->liste(array($data['nom']), 'from');
        $requete->where($primary, $id);
        $rslt = $requete->query();
        if (isset($foreignKey)){
            $champs[] = $tableJointe;
        }
        $primaryKey = array();
        foreach ($rslt as $valeur){
            $codeId = $valeur->$primary;
            foreach($champs as $champ){
                if ($join && $champ == $tableJointe){
                    $requete->liste(array($this->table.'.'.$foreignKey),'select');
                    $requete->liste(array($this->table, $tableJointe), 'from');
                    $requete->where($tableJointe.'.'.$foreignKey, $this->table.'.'.$foreignKey);
                    $requete->where($primary, $valeur->$primary);
                    $ids = $requete->query();
                    foreach ($ids as $key){
                        $liste[$valeur->$primary][$champ] = &$this->repositoryFinder->getAnotherRepo($tableJointe)->getOne($key->$foreignKey);
                    }
                }else{
                    $liste[$valeur->$primary][$champ] = $valeur->$champ;
                }
            }
        }
        $return = new $data['nom']($liste[$codeId]);
        unset($liste);
        unset($champs);
        unset($data);
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
