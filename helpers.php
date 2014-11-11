<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 07/12/13
 * Time: 02:43
 */

require_once 'lib/Dailymotion.php';
require_once 'config.php';

function getpropositions($nb_propositions)
{
    $config = config();

    // Connexion base de données
    $link = mysql_connect($config['db']['server'], $config['db']['username'], $config['db']['password'])
    or die("Impossible de se connecter : " . mysql_error());
    $db_selected = mysql_select_db($config['db']['name'], $link);
    if (!$db_selected) {
        die ('Impossible de sélectionner la base de données : ' . mysql_error());
    }
    mysql_query("SET NAMES 'utf8'");

    $sql = "SELECT * FROM videos ORDER BY RAND() LIMIT ".$nb_propositions;
    $reponse = mysql_query($sql);


    //----- Dailymotion object instanciation -----//
    $api = new Dailymotion();
    $api->setGrantType(
        Dailymotion::GRANT_TYPE_PASSWORD,
        $config['dailymotion']['apiKey'],
        $config['dailymotion']['apiSecret'],
        $scope = array('manage_videos'),
        array(
            'username' => $config['dailymotion']['user'],
            'password' => $config['dailymotion']['password']
        )
    );


    //Transformation du resultat de la requete en tableau
    // et récupérationdes données de Dailymotion
    $result = array();
    while ($video = mysql_fetch_array($reponse, MYSQL_ASSOC))
    {
        $thumbnail = $api->get('/videos', array(
            'fields' => 'id,thumbnail_120_url',
            'ids' => $video['id_daily'],
        ));
        $result[$video['vide_id']] = array(
            'id_daily' => $video['id_daily'],
            'vide_name' => $video['vide_name'],
            'vide_nbvue' => $video['vide_nbvue'],
            'vide_paroles' => $video['vide_paroles'],
            'vide_created_by' => $video['vide_created_by'],
            'vide_created_at' => substr($video['vide_created_at'],0,10),
            'thumbnail_120_url' => $thumbnail['list']['0']['thumbnail_120_url'],
        );
    }

    return $result;
}


function getvideo($id)
{
    $config = config();

    // Connexion base de données
    $link = mysql_connect($config['db']['server'], $config['db']['username'], $config['db']['password'])
    or die("Impossible de se connecter : " . mysql_error());
    $db_selected = mysql_select_db($config['db']['name'], $link);
    mysql_query("SET NAMES 'utf8'");
    if (!$db_selected) {
        die ('Impossible de sélectionner la base de données : ' . mysql_error());
    }

    $reponse = mysql_query("SELECT * from videos WHERE id_daily = '".$id."'");


    return mysql_fetch_assoc($reponse);
}


function getlist($tag)
{
    $config = config();

    // Connexion base de données
    $link = mysql_connect($config['db']['server'], $config['db']['username'], $config['db']['password'])
    or die("Impossible de se connecter : " . mysql_error());
    $db_selected = mysql_select_db($config['db']['name'], $link);
    if (!$db_selected) {
        die ('Impossible de sélectionner la base de données : ' . mysql_error());
    }
    mysql_query("SET NAMES 'utf8'");

    $sql = "SELECT * from videos WHERE vide_tag LIKE '%".$tag."%' ORDER BY vide_nbvue DESC";
    $reponse = mysql_query($sql);


    //----- Dailymotion object instanciation -----//
    $api = new Dailymotion();
    $api->setGrantType(
        Dailymotion::GRANT_TYPE_PASSWORD,
        $config['dailymotion']['apiKey'],
        $config['dailymotion']['apiSecret'],
        $scope = array('manage_videos'),
        array(
            'username' => $config['dailymotion']['user'],
            'password' => $config['dailymotion']['password']
        )
    );


    //Transformation du resultat de la requete en tableau
    // et récupérationdes données de Dailymotion
    $result = array();
    while ($video = mysql_fetch_array($reponse, MYSQL_ASSOC))
    {
		$thumbnail = $api->get('/videos', array(
				'fields' => 'id,thumbnail_120_url',
				'ids' => $video['id_daily'],
			));
        $result[$video['vide_id']] = array(
            'id_daily' => $video['id_daily'],
            'vide_name' => $video['vide_name'],
            'vide_nbvue' => $video['vide_nbvue'],
            'vide_paroles' => $video['vide_paroles'],
            'vide_created_by' => $video['vide_created_by'],
            'vide_created_at' => substr($video['vide_created_at'],0,10),
            'thumbnail_120_url' => $thumbnail['list']['0']['thumbnail_120_url'],
        );
    }

    return $result;
}


function getSearchList($tag)
{

    $config = config();

    // Connexion base de données
    $link = mysql_connect($config['db']['server'], $config['db']['username'], $config['db']['password'])
    or die("Impossible de se connecter : " . mysql_error());
    $db_selected = mysql_select_db($config['db']['name'], $link);
    if (!$db_selected) {
        die ('Impossible de sélectionner la base de données : ' . mysql_error());
    }
    mysql_query("SET NAMES 'utf8'");

    $sql = "SELECT * from videos
        WHERE vide_tag LIKE '%".$tag."%'
        OR vide_name LIKE '%".$tag."%'
        OR vide_paroles LIKE '%".$tag."%'
        OR vide_created_by LIKE '%".$tag."%'
        ORDER BY vide_nbvue DESC";
    $reponse = mysql_query($sql);


    //----- Dailymotion object instanciation -----//
    $api = new Dailymotion();
    $api->setGrantType(
        Dailymotion::GRANT_TYPE_PASSWORD,
        $config['dailymotion']['apiKey'],
        $config['dailymotion']['apiSecret'],
        $scope = array('manage_videos'),
        array(
            'username' => $config['dailymotion']['user'],
            'password' => $config['dailymotion']['password']
        )
    );


    //Transformation du resultat de la requete en tableau
    // et récupérationdes données de Dailymotion
    $result = array();
    while ($video = mysql_fetch_array($reponse, MYSQL_ASSOC))
    {
        $thumbnail = $api->get('/videos', array(
            'fields' => 'id,thumbnail_120_url',
            'ids' => $video['id_daily'],
        ));
        $result[$video['vide_id']] = array(
            'id_daily' => $video['id_daily'],
            'vide_name' => $video['vide_name'],
            'vide_nbvue' => $video['vide_nbvue'],
            'vide_paroles' => $video['vide_paroles'],
            'vide_created_by' => $video['vide_created_by'],
            'vide_created_at' => substr($video['vide_created_at'],0,10),
            'thumbnail_120_url' => $thumbnail['list']['0']['thumbnail_120_url'],
        );
    }

    return $result;
}


function incrementerLeNombreDeVues($id)
{
    $config = config();

    // Connexion base de données
    $link = mysql_connect($config['db']['server'], $config['db']['username'], $config['db']['password'])
    or die("Impossible de se connecter : " . mysql_error());
    $db_selected = mysql_select_db($config['db']['name'], $link);
    mysql_query("SET NAMES 'utf8'");
    if (!$db_selected) {
        die ('Impossible de sélectionner la base de données : ' . mysql_error());
    }

    $sql = "UPDATE videos set vide_nbvue = vide_nbvue + 1 WHERE vide_id = '".$id."'";
    $reponse = mysql_query($sql);


    return $reponse;
}


function getcategories()
{
    $config = config();

    // Connexion base de données
    $link = mysql_connect($config['db']['server'], $config['db']['username'], $config['db']['password'])
    or die("Impossible de se connecter : " . mysql_error());
    $db_selected = mysql_select_db($config['db']['name'], $link);
    if (!$db_selected) {
        die ('Impossible de sélectionner la base de données : ' . mysql_error());
    }

    mysql_query("SET NAMES 'utf8'");

    $sql = "SELECT * from categories";
    $reponse = mysql_query($sql);


    //Transformation du resultat de la requete en tableau
    // et récupérationdes données de Dailymotion
    $result = array();
    while ($category = mysql_fetch_array($reponse, MYSQL_ASSOC))
    {
        $result[$category['cate_id']] = array(
            'cate_title' => $category['cate_title'],
            'cate_description' => $category['cate_description'],
        );
    }

    return $result;
}


function getcategory($cat)
{
    foreach (getcategories() as $category)
    {
        if ($category['cate_title'] == $cat)
            return $category;
    }

    return null;
}


function addMovie()
{
    try
    {
    $config = config();
    $movedfile = 'upload/'.time().'.avi';
    move_uploaded_file($_FILES['video']['tmp_name'], $movedfile);

    //----- Dailymotion object instanciation -----//
    $api = new Dailymotion();
    $api->setGrantType(
        Dailymotion::GRANT_TYPE_PASSWORD,
        $config['dailymotion']['apiKey'],
        $config['dailymotion']['apiSecret'],
        $scope = array('manage_videos'),
        array(
            'username' => $config['dailymotion']['user'],
            'password' => $config['dailymotion']['password']
        )
    );

    // Connexion base de données
    $link = mysql_connect($config['db']['server'], $config['db']['username'], $config['db']['password'])
    or die("Impossible de se connecter : " . mysql_error());
    $db_selected = mysql_select_db($config['db']['name'], $link);
    if (!$db_selected) {
        die ('Impossible de sélectionner la base de données : ' . mysql_error());
    }

    // Ajout à Dailymotion
    $url = $api->uploadFile($movedfile);
    $result = $api->post(
        '/videos',
        array('fields' => 'id,url',
            'tags' => $_POST['categorie'],
            'url'     => $url,
            'title'     => $_POST['titre'],
            'published' => true,
            'private'   => false,
            'channel'   => 'kids')
    );


    //Ajout en BD
    $sql = 'INSERT INTO videos (vide_id, vide_name, vide_url, vide_url_dailymotion, vide_nbvue, vide_rate, vide_published, vide_description, vide_paroles, vide_virtual_name, vide_created_by, vide_created_at, vide_updated_at, id_daily, vide_tag) VALUES (NULL, "'.mysql_real_escape_string($_POST['titre']).'", \'index.php?uc=rechercher&action=consulter&idDly='.$result['id'].'\', \''.$result['url'].'\', \'0\', \'0\', \'1\', \'\', "'.mysql_real_escape_string($_POST['paroles']).'", \'\', "'.mysql_real_escape_string($_POST['auteur']).'", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, \''.$result['id'].'\',\''.mysql_real_escape_string($_POST['categorie']).'\')';
    $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
    mysql_close();

    return true;
    }
    catch (Exception $e)
    {
        log_error($e);
        mysql_close();
        return false;
    }

}


function log_error($errtxt){
    $file = fopen('log.txt','a+');
    fseek($file,SEEK_END);
    $nouverr = $errtxt."\r\n";
    fputs($file,$nouverr);
    fclose($file);
}

?>
