<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>


<?php
    $Status = $blueprint->dbGet('blueannoucements', 'status');
    $Hideable = $blueprint->dbGet('blueannoucements', 'hideable');
    $Icon = $blueprint->dbGet('blueannoucements', 'icon');
    $Text = $blueprint->dbGet('blueannoucements', 'text');
    $TextColour = $blueprint->dbGet('blueannoucements', 'fontcolor');
    $AlertBodyColour = $blueprint->dbGet('blueannoucements', 'alertbodycolour');  
?>

@if("$Status" == "true")
<div class="alert">
    @if("$Hideable" == "true")
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    @endif
    @if("$Icon" == "true")
    <div class="alert-icon">📢</div>
    @endif
    <?php echo $Text?>
    </div>
@endif
<p class="PteroFooter"><a rel="noopener nofollow noreferrer" href="https://pterodactyl.io" target="_blank" class="PageContentBlock___StyledA-sc-kbxq2g-4 eOGAqX">Pterodactyl®</a>&nbsp;© 2015 - 2023</p>


<style id="footer">

.alert {
  padding: 20px;
  background-color: {{$AlertBodyColour}}; 
  color: {{$TextColour}};
  margin-bottom: 15px;
  text-align: center;
  top: 0;
  margin: auto;
  width: 48%;
  padding: 10px;
  border-radius: 15px;
  justify-contect: center;
}

.closebtn {
  margin-left: 15px;
  margin-right: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}
.alert-icon {
  margin-left: 15px;
  height: 5;
  float: left;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: white;
  opacity: 5;
}

.PteroFooter{
    text-align: center;
    --tw-text-opacity: 1;
    padding-top: 10px;
    color: hsla(211,12%,43%,var(--tw-text-opacity));
    font-size: 0.75rem;
    line-height: 1rem;
}

.dcHyfd{
   display: none;
}
</style>