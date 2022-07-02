<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once('..\vendor\autoload.php');
 use Laudis\Neo4j\Authentication\Authenticate;
 use Laudis\Neo4j\ClientBuilder;
use LDAP\Result;

    $client = ClientBuilder::create()
    ->withDriver(
        'aura',
        'neo4j+s://763f7c38.databases.neo4j.io:7687',
        Authenticate::basic('neo4j', 'bdffmQb45XNTW45ZkpvdCse-DjT9-kfHRl4Ll-HoYzE')
    )
    ->build();

    
    session_start();
    if (empty($_SESSION["id"])) {
      header('Location: ../login.php');
    }
    
?>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Bonjour <?php echo $_SESSION["name"]?></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="../logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="assets/img/find_user.png" class="user-image img-responsive" />
                    </li>


                   



                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Les auteurs recommendee pour vous</h2>   
                        
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Advanced Tables
                        </div>
                        <div class="panel-body">
                        <form role="form" method="post" action="recommande.php" id="up" enctype="multipart/form-data">
                        
                                        <div class="form-group">
                                            <label for="disabledSelect">Tag </label>
                                            <select id="disabledSelect" class="form-control" name="tag">
                                            <?php
                                            
                                                $id = intval($_SESSION["id"]);
                                                $results = $client->run('MATCH (aut1:Auteur {Autno: $id})-[:ecrire]->(livre1:Livre)-[:concerne]->(tag:Tag) return distinct tag.tname as tag',['id' => $id]);

                                                // A row is a CypherMap
                                                foreach ($results as $result) {
                                                // Returns a Node
                                                   
                                                echo '<option value='.$result->get('tag').'>'.$result->get('tag').'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>occurrence</label>
                                            <input class="form-control" type="number" name="occ"/>
                                            
                                        </div>
                                        <button name="search" type="submit" class="btn btn-primary">chercher</button><br>
                        </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>occurrence</th>
                                            <th>Tag</th>

                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(isset($_POST['search'],$_POST['tag'],$_POST['occ'])){
                                            
                                            $tag= $_POST['tag'];
                                            $occ = intval($_POST['occ']);
                                            $results = $client->run('MATCH (aut1:Auteur {Autno: $id})-[:ecrire]->(livre1:Livre)-[:concerne]->(tag:Tag{tname: $tag})<-[:concerne]-(livre2:Livre)<-[:ecrire]-(aut2:Auteur) WHERE aut1<> aut2 AND NOT (aut1)-[:ecrire]->(:Livre)<-[:ecrire]-(aut2) RETURN  aut2.aname as name,count(*)>=$occ as occ, count(*) as  occurrence ORDER BY occurrence DESC',['id' => $id, 'tag'=> $tag, 'occ'=> $occ]);

                                            // A row is a CypherMap
                                            foreach ($results as $result) {
                                                // Returns a Node
                                               
                                                
                                                if ($result->get('occ') == 'true') {
                                                    echo '<tr class="odd gradeX">
                                                    <td>'.$result->get('name').'</td>
                                                    <td>'.$result->get('occurrence').'</td>
                                                    <td>'.$tag.'</td>';
                                                }
                                                
                                               
                                                   
                                                
                                            }}
                                                
                                                   
                                                
                                            
                                            
                                        ?>
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
