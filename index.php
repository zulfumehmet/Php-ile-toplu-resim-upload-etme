<?

$parametreler = strtolower($_SERVER['QUERY_STRING']); //Adres satırından gelen tüm sorguları aldık.
$yasaklar="%¿¿'¿¿`¿¿insert¿¿concat¿¿delete¿¿join¿¿update¿¿select¿¿\"¿¿\\¿¿<¿¿>¿¿tablo_adim¿¿kolon_adim"; //Buraya tablo adlarınızı da ekleyiniz. Her ekleme sonrasını ¿¿ ile ayırmalısınız.
$yasakla=explode('¿¿',$yasaklar);
$sayiver=substr_count($yasaklar,'¿¿');
$i=0;
while ($i<=$sayiver) {
if (strstr($parametreler,$yasakla[$i])) {
header("location:http://www.zulfumehmet.com/"); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}
 
$i++;	
}
 
if (strlen($parametreler)>=90) {
header("location:http://www.zulfumehmet.com/");
exit;	
}
// yukardaki komutlar sql injection onlemek maksatli
include 'functions.php'; // db baglantisini yapalim
?>

<?php $gelen_kod = $_GET["id"]; //atadigimiz id numarasini cagiralim index.php?id=xx hangi numara verdigimizi bilelim?>

<!DOCTYPE html>
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Resimler </title>
        <link rel="stylesheet" href="assets/css/styles.css" />
        <script src="assets/js/script.js"></script>
		<script src="assets/js/albumPreviews.js"></script>
        <script src="http://cdn.tutorialzine.com/misc/adPacks/v1.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	    <script type="text/javascript" src="jquery/jquery.js"></script>
	    
	    <style>
body,html{width:100%;height:100%;,margin:0; padding:0}
div.container{min-height:100%; height:auto !important; height:100%;}

/* test */
div.container{background:white;
    z-index:2;
}
#alan img {
    display: table-cell;
    vertical-align: middle;
}
#ana_div {
	height: auto;
	width: auto;
	margin-right: auto;
	margin-left: auto;
	background-color: #666666;
	z-index:1;
}

.div {
	float: left;
	height: auto;
	width: auto;
	margin: 10px;

}
input[type=button], input[type=submit], input[type=file] { 
 
    background-color: #346fed;
 
    border: none;
 
    color: white;
 
    padding: 18px 36px;
 
    margin: 5px 3px;
 
    cursor: pointer;
}
	    </style>
    </head>
    <body>
        
       
<script>
    function Goster()
    {
        document.getElementById("alan").hidden = false;
    }
</script>    
        
        
 <div hidden class="container" id="alan" >
            <center><img src="loading.gif" alt="yukleniyor" title="yukleniyor"/></center>
        </div>        
        
<div id="ana_div">
     
      
<div class="div" id="div"><p>Lütfen resim seçip Yükle butonuna tıklayınız. Resim Yükleme işleminin bitmesini bekleyiniz.</p>
<form action="aupload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="adi" value="<?php echo $gelen_kod; ?>">
<input type="file" name="image[]" accept="image/png, image/jpeg" multiple /><hr />
<input type="submit" name="submit" value="Yükle" onclick="Goster()" />
</div>
<!--Yukarilar susleme sanati ile alakali -->
<div class="div" id="div2"><?php
$query= $db -> prepare("SELECT * FROM resimler where ilanID='$gelen_kod'"); // resimler tablaosunda bulunan atadigimiz id ait bilgi varsa resimleri gostersin.
$query-> execute();
$musteriler = $query -> fetchAll(); ?>
  
<?php 
        foreach($musteriler as $dizi){
       ?>
       
       	<a href="sil.php?id=<?=$dizi["Id"]?>" class="album">
				   <img src="files/<?php echo $gelen_kod ?>/thumbnail/<?=$dizi["kucuk"]?>" alt="<?=$dizi["kucuk"]?>" />
				   <p class="button">Sil</p></a>
				
      
       <?php } 
       // dongu olusturup resimlerin hepsini siralamasini istedik. Arti olarak silmek icinde resmin idsini kullanacagiz
       ?></div>
</div>
 
</body>
</html>
