<?php
    require_once('vendor\autoload.php');
    use Laudis\Neo4j\Authentication\Authenticate;
    use Laudis\Neo4j\ClientBuilder;
       $client = ClientBuilder::create()
       ->withDriver(
           'aura',
           'neo4j+s://763f7c38.databases.neo4j.io:7687',
           Authenticate::basic('neo4j', 'bdffmQb45XNTW45ZkpvdCse-DjT9-kfHRl4Ll-HoYzE')
       )
       ->build();

    session_start();
    if(isset($_POST['email'])){
        $results = $client->run('match (aut:Auteur{Autno:$id}) return aut.aname as name',['id' => intval( $_POST['email'] )]);
        
        if(count($results)!=0){
            foreach ($results as $result) {
            
            $_SESSION['id']=$_POST['email'];
            $name=''.$result->get('name');
            $_SESSION['name']=$name;}
            
            header('location:admin/recommande.php');
        }
        else{
            header('location:login.php');
            
        }
    }
    else{
        header('location:login.php');
    }